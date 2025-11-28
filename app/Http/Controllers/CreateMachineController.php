<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redis;
// validation
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Auth;
use Redirect;
use DB;

class CreateMachineController extends Controller
{
    function createMachine()
    {
        $plant      = DB::table('mst_plant')->where('is_active',1)->get();
        $wct        = DB::table('mst_line')->where('is_active',1)->get();
        $op_name    = DB::table('mst_machine_regis')->where('is_active',1)->get();

        $data = array(
            'plant'     => $plant,
            'wct'       => $wct,
            'op_name'   => $op_name,
            'icontitle' => 'createmachine',
            'title'     => 'Manage MAchine',
        );
     
        return view('Machine.create')->with($data);
    }

    function getWctByPlant(Request $request)
    {
        $id_plant = $request->id_plant;
        $wct      = DB::table('mst_line')->where('id_plant',$id_plant)->where('is_active',1)->get();

        return response()->json($wct);    
    }

    function getOpByWct(Request $request)
    {
        $id_wct     = $request->id_wct;
        $op_name    = DB::table('mst_machine_regis')->where('id_wct',$id_wct)->where('is_active',1)->get();

        return response()->json($op_name);    
        
    }

    function crudMachineList(Request $request)
    {
        $aksi = $request->aksi;
        
        if($aksi == 'add'){
            try {
                $validatedData = $request->validate([
                    'id_plant' => 'required',
                    'id_wct' => 'required',
                    'op_name' => 'required',
                    'asset_id' => 'required',
                    'machine_name' => 'required',
                    'ip_address' => 'required',
                    'port' => 'required',
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => 'error', 'message' => $firstError]);
            }

            $id_machine_regis   = $request->op_name;
            $asset_id           = $request->asset_id;
            $machine_name       = $request->machine_name;
            $ip_address         = $request->ip_address;
            $port               = $request->port;

            $data = array(
                'id_machine_regis'  => $id_machine_regis,
                'asset_id'          => $asset_id,
                'machine_name'      => $machine_name,
                'ip_address'        => $ip_address,
                'port'              => $port,
                'created_at'        => Carbon::now(),
                'created_by'        => Auth::user()->id,
                'is_active'         => 1,
            );

            try {
                $insert = DB::table('mst_list_machine')->insert($data);

                $resp = array(
                    'status' => 'success',
                    'message' => 'Data berhasil ditambahkan',
                );
                
            } catch (\Throwable $th) {
                $resp = array(
                    'status' => 'error',
                    'message' => $th->getMessage(),
                );
            }

            return response()->json($resp);


        }else if($aksi == 'edit'){
            try {
                $validatedData = $request->validate([
                    
                    'op_name' => 'required',
                    'asset_id' => 'required',
                    'machine_name' => 'required',
                    'ip_address' => 'required',
                    'port' => 'required',
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => 'error', 'message' => $firstError]);
            }

            $id_machine_regis   = $request->op_name;
            $asset_id           = $request->asset_id;
            $machine_name       = $request->machine_name;
            $ip_address         = $request->ip_address;
            $port               = $request->port;
            $id                 = $request->id;

            $data = array(
                'id_machine_regis'  => $id_machine_regis,
                'asset_id'          => $asset_id,
                'machine_name'      => $machine_name,
                'ip_address'        => $ip_address,
                'port'              => $port,
                'updated_at'        => Carbon::now()
            );

            $update = DB::table('mst_list_machine')->where('id',$id)->update($data);

            if($update){
                return response()->json(['status' => 'success', 'message' => 'Data berhasil diupdate']);
            }else {
                return response()->json(['status' => 'error', 'message' => 'Data gagal diupdate']);
            }
        }else {
            $id = $request->id;
            $delete = DB::table('mst_list_machine')->where('id',$id)->delete();

            if($delete){
                return response()->json(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            }else {
                return response()->json(['status' => 'error', 'message' => 'Data gagal dihapus']);
            }
            
        } 
    }

    function getMachineList(Request $request)
    {
        $id     = $request->id;
        $arr    = getMachineList($id);

        $resp = array(
            'status' => true,
            'message' => 'Data berhasil diambil',
            'arr'   => $arr,
            'id'    => $id,
        );

        return response()->json($resp);
    }
}
