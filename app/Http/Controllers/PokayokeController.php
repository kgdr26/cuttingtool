<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Auth;
use Redirect;
use DB;

class PokayokeController extends Controller
{

    function pokayokestep1(Request $request)
    {
        $id_list_machine = $request->id_list_machine;
        $id_list_machine = base64_decode($id_list_machine);
        if($id_list_machine != null && $id_list_machine != '' && $id_list_machine != 0) {
            $arr = DB::table('mst_list_machine')->where('id', $id_list_machine)->first();
            $asset_id = $arr->asset_id;
        }else {
            $asset_id = '';
        }
        
        $data = array(
            'id_list_machine'   => $id_list_machine,
            'asset_id'          => $asset_id,
            'icontitle'         => 'marking',
            'title'             => 'POKAYOKE',
        );

        return view('Pokayoke.pokayokestep1')->with($data);
    }

    function pokayokestep2(Request $request)
    {
        $id_list_machine = base64_decode(request()->id_list_machine);

        if($id_list_machine == null) {
            return redirect()->route('pokayokestep1');
        }

        $data = array(
            'id_list_machine' => $id_list_machine,
            'icontitle' => 'marking',
            'title'     => 'POKAYOKE',
        );

        return view('Pokayoke.pokayokestep2')->with($data);
    }

    function pokayokestep3()
    {
        $id_list_machine = base64_decode(request()->id_list_machine);
        $id_assy_old     = base64_decode(request()->id_assy_old);
        $tool_port       = base64_decode(request()->tool_port);

        if($id_list_machine == null || $id_assy_old == null || $tool_port == null) {
            return redirect()->route('pokayokestep1');
        }

        $data = array(
            'id_list_machine' => $id_list_machine,
            'id_assy_old'     => $id_assy_old,
            'tool_port'       => $tool_port,
            'icontitle'       => 'marking',
            'title'           => 'POKAYOKE',
        );

        return view('Pokayoke.pokayokestep3')->with($data);
    }

    function pokayokestep4()
    {
        $id_list_machine = base64_decode(request()->id_list_machine);
        $id_assy_old     = base64_decode(request()->id_assy_old);
        $tool_port       = base64_decode(request()->tool_port);
        $id_assy_new     = base64_decode(request()->id_assy_new);

        if($id_list_machine == null || $id_assy_old == null || $tool_port == null || $id_assy_new == null) {
            return redirect()->route('pokayokestep1');
        }

        $data = array(
            'id_list_machine' => $id_list_machine,
            'id_assy_old'     => $id_assy_old,
            'tool_port'       => $tool_port,
            'id_assy_new'     => $id_assy_new,
            'icontitle'       => 'marking',
            'title'           => 'POKAYOKE',
        );


        return view('Pokayoke.pokayokestep4')->with($data);
    }

    function pokayokestep5()
    {
        $id_list_machine = base64_decode(request()->id_list_machine);
        $id_assy_old     = base64_decode(request()->id_assy_old);
        $tool_port       = base64_decode(request()->tool_port);
        $id_assy_new     = base64_decode(request()->id_assy_new);
        $status          = base64_decode(request()->status);

        if($id_list_machine == null || $id_assy_old == null || $tool_port == null || $id_assy_new == null || $status == null) {
            return redirect()->route('pokayokestep1');
        }

        // insert into trx_machine_assy_tool and trx_assy
        $ins    = pokayokestep5process($id_list_machine, $id_assy_old, $tool_port, $id_assy_new, $status);

        $data   = array(
            'id_list_machine' => $id_list_machine,
            'id_assy_old'     => $id_assy_old,
            'tool_port'       => $tool_port,
            'id_assy_new'     => $id_assy_new,
            'status'          => $status,
            'icontitle'       => 'marking',
            'title'           => 'POKAYOKE',
        );

        return view('Pokayoke.pokayokestep5')->with($data);
    }


    function machineByQr(Request $request)
    {
        $qr_code = $request->qr_code;

        $machine = DB::table('mst_list_machine as a')
            ->select('a.*', 'b.*', 'c.id_plant', 'd.id_wct')
            ->leftJoin('mst_machine_regis as b', 'a.id_machine_regis', '=', 'b.id')
            ->leftJoin('mst_plant as c', 'b.id_plant', '=', 'c.id')
            ->leftJoin('mst_line as d', 'b.id_wct', '=', 'd.id')
            ->where('a.asset_id', $qr_code)
            ->first();

        if ($machine) {
            $resp = [
                'status' => true,
                'arr' => $machine
            ];
        } else {
            $resp = [
                'status' => false,
                'message' => 'Machine not found'
            ];
        }

        return response()->json($resp);
    }

    function getTrxAssyByQr(Request $request)
    {
        $qr_code = $request->qr_code;

        $mst_tool_port_regis = DB::table('mst_assy_tool_port_regis')->get();
        $tool_port           = ToArr($mst_tool_port_regis, 'id');

        $trx_assy = DB::table('trx_assy')
        ->where('holder_qr_code', $qr_code)
        ->first();

        if(array_key_exists($trx_assy->id_assy_tool_port_regis, $tool_port)) {
            $trx_assy->tool_port = $tool_port[$trx_assy->id_assy_tool_port_regis]['tool_port'];
        }

        if ($trx_assy) {
            $resp = [
                'status' => true,
                'arr' => $trx_assy
            ];
        } else {
            $resp = [
                'status' => false,
                'message' => 'Trx Assy not found'
            ];
        }

        return response()->json($resp);
    }

    function getTrxAssyToolByQr(Request $request)
    {
        $qr_code        = $request->qr_code;
        $trx_assy_tool  = DB::table('trx_assy')
        ->where('holder_qr_code', $qr_code)
        ->orderBy('id', 'desc')
        ->first();

        // join data mst_marking_tool with mst_tool_regis
        $ref_tool = DB::select("SELECT a.*, b.* FROM mst_marking_tool a LEFT JOIN mst_tool_regis b ON a.id_tool_regis = b.id ");
        $ref_tool = ToArr($ref_tool, 'qr_code');

        // join data mst_marking_holder with mst_holder_regis
        $ref_holder = DB::select("SELECT a.*, b.* FROM mst_marking_holder a LEFT JOIN mst_holder_regis b ON a.id_holder_register = b.id ");
        $ref_holder = ToArr($ref_holder, 'qr_code');

        // data mst_accesories_regis
        $ref_acc    = DB::table('mst_accesories_regis')->get();
        $ref_acc    = ToArr($ref_acc, 'part_no');

        $arr_tool   = json_decode($trx_assy_tool->json_tool, true);
        $arr_holder = json_decode($trx_assy_tool->json_holder, true);
        $arr_acc    = json_decode($trx_assy_tool->json_acc, true);

        // get data tool
        $tool = [];
        foreach ($arr_tool as $key => $row) {
            if(array_key_exists($row, $ref_tool)) {
                $tool[$key] = $ref_tool[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_tool', $row)
                ->sum('total_inject');
                $tool[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        // get data holder
        $holder = [];
        foreach ($arr_holder as $key => $row) {
            if(array_key_exists($row, $ref_holder)) {
                $holder[$key] = $ref_holder[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_holder', $row)
                ->sum('total_inject');
                $holder[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        // get data acc
        $acc = [];
        foreach ($arr_acc as $key => $row) {
            if(array_key_exists($row, $ref_acc)) {
                $acc[$key] = $ref_acc[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_acc', $row)
                ->sum('total_inject');
                $acc[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        $resp = [
            'status' => true,
            'tool' => $tool,
            'holder' => $holder,
            'acc' => $acc
        ];

        return response()->json($resp);
    }

    function machineListById(Request $request)
    {
        $id_list_machine = $request->id_list_machine;
        
        $machine = DB::table('mst_list_machine as a')
            ->select('a.*', 'b.*', 'c.id_plant', 'd.id_wct')
            ->leftJoin('mst_machine_regis as b', 'a.id_machine_regis', '=', 'b.id')
            ->leftJoin('mst_plant as c', 'b.id_plant', '=', 'c.id')
            ->leftJoin('mst_line as d', 'b.id_wct', '=', 'd.id')
            ->where('a.id', $id_list_machine)
            ->first();

        if ($machine) {
            $resp = [
                'status' => true,
                'arr' => $machine
            ];
        } else {
            $resp = [
                'status' => false,
                'message' => 'Machine not found'
            ];
        }

        return response()->json($resp);
    }

    function trxAssyByAssyId(Request $request)
    {
        $id_assy        = $request->id_assy;
        $trx_assy_tool  = DB::table('trx_assy')
        ->where('id_assy', $id_assy)
        ->orderBy('id', 'desc')
        ->first();

        // join data mst_marking_tool with mst_tool_regis
        $ref_tool = DB::select("SELECT a.*, b.* FROM mst_marking_tool a LEFT JOIN mst_tool_regis b ON a.id_tool_regis = b.id ");
        $ref_tool = ToArr($ref_tool, 'qr_code');

        // join data mst_marking_holder with mst_holder_regis
        $ref_holder = DB::select("SELECT a.*, b.* FROM mst_marking_holder a LEFT JOIN mst_holder_regis b ON a.id_holder_register = b.id ");
        $ref_holder = ToArr($ref_holder, 'qr_code');

        // data mst_accesories_regis
        $ref_acc    = DB::table('mst_accesories_regis')->get();
        $ref_acc    = ToArr($ref_acc, 'part_no');

        $arr_tool   = json_decode($trx_assy_tool->json_tool, true);
        $arr_holder = json_decode($trx_assy_tool->json_holder, true);
        $arr_acc    = json_decode($trx_assy_tool->json_acc, true);

        // get data tool
        $tool = [];
        foreach ($arr_tool as $key => $row) {
            if(array_key_exists($row, $ref_tool)) {
                $tool[$key] = $ref_tool[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_tool', $row)
                ->sum('total_inject');
                $tool[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        // get data holder
        $holder = [];
        foreach ($arr_holder as $key => $row) {
            if(array_key_exists($row, $ref_holder)) {
                $holder[$key] = $ref_holder[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_holder', $row)
                ->sum('total_inject');
                $holder[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        // get data acc
        $acc = [];
        foreach ($arr_acc as $key => $row) {
            if(array_key_exists($row, $ref_acc)) {
                $acc[$key] = $ref_acc[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_acc', $row)
                ->sum('total_inject');
                $acc[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        $resp = [
            'status'    => true,
            'tool'      => $tool,
            'holder'    => $holder,
            'acc'       => $acc
        ];

        return response()->json($resp);        
    }

    function pokayokeStep5check(Request $request)
    {
        // get the latest id_list_machine on trx_machine_assy_tool
        $id_list_machine = $request->id_list_machine;
        $id_assy_old     = $request->id_assy_old;
        $tool_port       = $request->tool_port;
        $id_assy_new     = $request->id_assy_new;

        $trx_machine_assy_tool = DB::table('trx_machine_assy_tool')
        ->where('id_list_machine', $id_list_machine)
        ->where('id_trx_assy_old', $id_assy_old)
        ->orderBy('id', 'desc')->first();

        //return response()->json($trx_machine_assy_tool);

        // check flag_desktop and total_inject
        if($trx_machine_assy_tool->flag_desktop == 2 && $trx_machine_assy_tool->total_inject > 0 ) {

            // update id_assy_old di trx_assy
            $updateAssyOld = DB::table('trx_assy')
            ->where('id_assy', $id_assy_old)
            ->update([
                'id_user_uninstall' => Auth::user()->id,
                'end_install'       => Carbon::now(),
                'id_location'       => 4,
                'actual_lifetime'   => $trx_machine_assy_tool->total_inject, //dalam inject, belum dikonversi dengan sigma process
            ]);

            // update id_assy_new di trx_assy
            $updateAssyNew = DB::table('trx_assy')
            ->where('id_assy', $id_assy_new)
            ->update([
                'id_user_install'   => Auth::user()->id,
                'start_install'     => Carbon::now(),
                'id_location'       => 3,
            ]);

            $id = $trx_machine_assy_tool->id;

            $updateTrxMachineAssy = DB::table('trx_machine_assy_tool')
            ->where('id', $id)
            ->update([
                'id_trx_assy_new'   => $id_assy_new,
                'id_user_uninstall' => Auth::user()->id,
                'flag_desktop'      => 2,//posisi close transaction
                'flag_transaction'  => 2,//posisi close transaction
                'end_install'       => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);


            // insert data baru di trx_machine_assy_tool
            $insertTrxMachineAssy = DB::table('trx_machine_assy_tool')->insert([
                'id_list_machine'   => $id_list_machine,
                'id_trx_assy_old'   => $id_assy_new,
                'id_user_install'   => Auth::user()->id,
                'flag_desktop'      => 0,
                'flag_transaction'  => 0,
                'start_install'     => Carbon::now(),
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            ]);

            if($updateAssyOld && $updateAssyNew && $insertTrxMachineAssy) {
                $resp = [
                    'status'        => true,
                    'status_check'  => 1,
                    'message'       => 'Success'
                ];
            }else {
                $resp = [
                    'status'        => false,
                    'status_check'  => 0,
                    'message'       => 'Failed'
                ];
            }

            return response()->json($resp);
        }else {
            $resp = [
                'status'        => true,
                'status_check'  => 0,
                'message'       => 'Waiting Cutting Tool to be installed'
            ];

            return response()->json($resp);
        }
    }

    function tespok()
    {
        $qr_code        = 'line001.001.24.1;line00110a01';
        $trx_assy_tool  = DB::table('trx_assy')
        ->where('holder_qr_code', $qr_code)
        ->orderBy('id', 'desc')
        ->first();

        // join data mst_marking_tool with mst_tool_regis
        $ref_tool = DB::select("SELECT a.*, b.* FROM mst_marking_tool a LEFT JOIN mst_tool_regis b ON a.id_tool_regis = b.id ");
        $ref_tool = ToArr($ref_tool, 'qr_code');

        // join data mst_marking_holder with mst_holder_regis
        $ref_holder = DB::select("SELECT a.*, b.* FROM mst_marking_holder a LEFT JOIN mst_holder_regis b ON a.id_holder_register = b.id ");
        $ref_holder = ToArr($ref_holder, 'qr_code');

        // data mst_accesories_regis
        $ref_acc    = DB::table('mst_accesories_regis')->get();
        $ref_acc    = ToArr($ref_acc, 'part_no');

        $arr_tool   = json_decode($trx_assy_tool->json_tool, true);
        $arr_holder = json_decode($trx_assy_tool->json_holder, true);
        $arr_acc    = json_decode($trx_assy_tool->json_acc, true);

        // get data tool
        $tool = [];
        foreach ($arr_tool as $key => $row) {
            if(array_key_exists($row, $ref_tool)) {
                $tool[$key] = $ref_tool[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_tool', $row)
                ->sum('total_inject');
                $tool[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        // get data holder
        $holder = [];
        foreach ($arr_holder as $key => $row) {
            if(array_key_exists($row, $ref_holder)) {
                $holder[$key] = $ref_holder[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_holder', $row)
                ->sum('total_inject');
                $holder[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        // get data acc
        $acc = [];
        foreach ($arr_acc as $key => $row) {
            if(array_key_exists($row, $ref_acc)) {
                $acc[$key] = $ref_acc[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_acc', $row)
                ->sum('total_inject');
                $acc[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }

        $resp = [
            'status' => true,
            'tool' => $tool,
            'holder' => $holder,
            'acc' => $acc
        ];

        return response()->json($resp);
    }
}
