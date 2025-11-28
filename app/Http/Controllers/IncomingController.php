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

class IncomingController extends Controller
{
    function imarkingholder()
    {
        $wct  = DB::table('mst_line')->where('is_active', 1)->get();
        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > Marking',
            'wct'       => $wct
        );

        return view('Incoming.imarkingholder')->with($data);
    }

    function getallmarkingholder(Request $request)
    {
        $id     = $request->id;
        $arr    = getallmarkingholder($id);
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getHolderRegisById(Request $request)
    {
        $id    = $request->id;
        $arr   = getAllHolderRegis($id);
        $resp  = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getMachineRegisterByIdWct(Request $request)
    {
        $id    = $request->id;
        $arr   = DB::table('mst_machine_regis')->where('id_wct', $id)->where('is_active', 1)->get();
        $resp  = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);

    }

    function getToolPortByIdmachineRegister(Request $request)
    {
        $id    = $request->id;
        $arr   = DB::table('mst_assy_tool_port_regis')->where('id_machine_regis', $id)->where('is_active', 1)->get();
        $resp  = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getQrHolder(Request $request)
    {
        $id_wct            = $request->id_wct;
        $id_machine_regis  = $request->id_machine_regis;
        $id_tool_port      = $request->id_tool_port;
        $id_holder_regis   = $request->id_holder_register;

        // reference
        $wct               = DB::table('mst_line')->where('id', $id_wct)->first();
        $id_wct            = $wct->id_wct;

        // get data from mst_machine_regis
        $data_machine_regis = DB::table('mst_machine_regis')->where('id', $id_machine_regis)->first();
        $op_name            = $data_machine_regis->op_name;

        // get data from mst_holder_regis
        $data_holder_regis = DB::table('mst_holder_regis')->where('id', $id_holder_regis)->first();
        $hes_no            = $data_holder_regis->hes_no;

        // get data from mst_assy_tool_port_regis
        $data_tool_port_regis   = DB::table('mst_assy_tool_port_regis')->where('id', $id_tool_port)->first();
        $tool_port              = $data_tool_port_regis->tool_port;

        // current year
        $year = date('Y');
        // get last 2 digit year
        $year = substr($year, -2);

        // get count data from mst_marking_holder
        $count = DB::table('mst_marking_holder')->where('id_holder_register',$request->id_holder_register)->where('id_wct', $request->id_wct)->where('status_qr_code',1)->count();
        $count = $count + 1;
		$count = sprintf("%03d", $count);

        // susunan qrcode holder
        $qr_code           = $id_wct.'.'.$hes_no.'.'.$year.'.'.$count.';'.$id_wct.$op_name.$tool_port;

        $resp = array(
            'status' => true,
            'qr_code' => $qr_code
        );

        return response()->json($resp);
    }

    function startMarking(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_wct'            => 'required',
                'id_machine_regis'  => 'required',
                'id_tool_port'      => 'required',
                'id_holder_register'   => 'required',
                'qr_code'           => 'required'
            ]);
        } catch (ValidationException $e) {
            $errors     = $e->validator->errors();
            $firstError = $errors->first();
            return response()->json(['status' => false, 'message' => $firstError]);
        }

        $id_wct             = $request->id_wct;
        $id_machine_regis   = $request->id_machine_regis;
        $id_tool_port       = $request->id_tool_port;
        $id_holder_regis    = $request->id_holder_register;
        $qr_code            = $request->qr_code;

        $data = array(
            'id_wct'                    => $id_wct,
            'id_machine_regis'          => $id_machine_regis,
            'id_assy_tool_port_regis'   => $id_tool_port,
            'id_holder_register'        => $id_holder_regis,
            'qr_code'                   => $qr_code,
            'created_at'                => Carbon::now(),
            'created_by'                => Auth::user()->id,
            'status_qr_code'            => 0, // 1 = done, 0 = process
            'is_active'                 => 1,
        );

        $insert = DB::table('mst_marking_holder')->insert($data);

        if($insert){
            return response()->json(['status' => true, 'message' => 'Process Marking Holder']);
        }else {
            return response()->json(['status' => false, 'message' => 'Failed Process Marking Holder']);
        }


    }

    function verifyHolderMarking(Request $request)
    {
        $id_holder_register = $request->id_holder_register;
        $qr_code            = $request->qr_code;

        // update status_qr_code = 1
        $update = DB::table('mst_marking_holder')->where('id_holder_register', $id_holder_register)->where('qr_code', $qr_code)->update(['status_qr_code' => 1]);

        if($update){
            return response()->json(['status' => true, 'message' => 'Success Verify Holder Marking,QR Code : '.$qr_code]);
        }else {
            return response()->json(['status' => false, 'message' => 'Failed Verify Holder Marking, QR Code : '.$qr_code]);
        }
    }

    function imarkingtool()
    {
        $wct  = DB::table('mst_line')->where('is_active', 1)->get();


        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > Marking',
            'wct'       => $wct
        );

        return view('Incoming.imarkingtool')->with($data);
    }

    function getAllMarkingTool(Request $request)
    {
        $id     = $request->id;
        $arr    = getallmarkingtool($id);
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getToolRegisById(Request $request)
    {
        $id    = $request->id;
        $arr   = getAllToolRegis($id);
        $resp  = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);

    }

    function getQrTool(Request $request)
    {
        $id_wct        = $request->id_wct;
        $id_tool_regis = $request->id_tool_regis;

        // reference
        $wct               = DB::table('mst_line')->where('id', $id_wct)->first();
        $id_wct            = $wct->id_wct;

        // get data from mst_tool_regis
        $data_tool_regis = DB::table('mst_tool_regis')->where('id', $id_tool_regis)->first();
        $hes_no          = $data_tool_regis->hes_no;

        // current year
        $year = date('Y');
        $year = substr($year, -2);

        // get count data from mst_marking_tool
        $count = DB::table('mst_marking_tool')->where('id_tool_regis',$request->id_tool_regis)->where('id_wct', $request->id_wct)->where('status_qr_code',1)->count();
        $count = $count + 1;
		$count = sprintf("%03d", $count);

        // susunan qrcode tool
        $qr_code           = $id_wct.'.'.$hes_no.'.'.$year.'.'.$count;

        $resp = array(
            'status' => true,
            'qr_code' => $qr_code
        );

        return response()->json($resp);
    }

    function startMarkingTool(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_wct'            => 'required',
                'id_tool_regis'     => 'required',
                'qr_code'           => 'required'
            ]);
        } catch (ValidationException $e) {
            $errors     = $e->validator->errors();
            $firstError = $errors->first();
            return response()->json(['status' => false, 'message' => $firstError]);
        }

        $id_wct             = $request->id_wct;
        $id_tool_regis      = $request->id_tool_regis;
        $qr_code            = $request->qr_code;

        $data = array(
            'id_wct'            => $id_wct,
            'id_tool_regis'     => $id_tool_regis,
            'qr_code'           => $qr_code,
            'created_at'        => Carbon::now(),
            'created_by'        => Auth::user()->id,
            'status_qr_code'    => 0, // 1 = done, 0 = process
            'is_active'         => 1,
        );

        $insert = DB::table('mst_marking_tool')->insert($data);

        if($insert){
            return response()->json(['status' => true, 'message' => 'Process Marking Tool']);
        }else {
            return response()->json(['status' => false, 'message' => 'Failed Process Marking Tool']);
        }
    }

    function verifyMarkingTool(Request $request)
    {
        $id_tool_regis = $request->id_tool_regis;
        $qr_code       = $request->qr_code;

        // update status_qr_code = 1
        $update = DB::table('mst_marking_tool')->where('id_tool_regis', $id_tool_regis)->where('qr_code', $qr_code)->update(['status_qr_code' => 1]);

        if($update){
            return response()->json(['status' => true, 'message' => 'Success Verify Tool Marking,QR Code : '.$qr_code]);
        }else {
            return response()->json(['status' => false, 'message' => 'Failed Verify Tool Marking, QR Code : '.$qr_code]);
        }
    }

    function iinspectionrecord()
    {
        $arr = getInspectionRecord();

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > INSPECTION RECORD',
        );

        return view('Incoming.iinspectionrecord')->with($data);
    }

    function getInspectionRecord(Request $request)
    {
        $qr_code    = $request->id;
        $arr        = getInspectionRecord($qr_code);

        $resp  = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function searchInspectionRecord(Request $request)
    {
        $qr_code    = $request->search;
        $arr        = getInspectionRecord($qr_code);

        $resp = array(
            'status' => true,
            'arr'   => $arr,
        );

        return response()->json($resp);
    }

    function updateInspectionRecord(Request $request)
    {
        $id_isp         = $request->id_isp;
        $isp_data       = $request->isp_data;
        $tahap_isp      = $request->tahap_isp;

        // make json from array
        $isp = array(
            $tahap_isp => $isp_data
        );
        $isp = json_encode($isp);



        try {
            $update = DB::table('mst_regrind_inspection_record')->where('id', $id_isp)->update(['inspection_record' => $isp]);
            // update mst_marking_tool stock to 1
            $update = DB::table('mst_marking_tool')->where('qr_code', $request->qr_code)->update(['is_stock' => 1]);

            return response()->json(['status' => true, 'message' => 'Success Update Inspection Record']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }

        // if($update){
        //     return response()->json(['status' => true, 'message' => 'Success Update Inspection Record']);
        // }else {
        //     return response()->json(['status' => false, 'message' => 'Failed Update Inspection Record']);
        // }
    }

    function igoodstockholder() : object {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > GOOD STOCK',
        );

        return view('Incoming.igoodstockholder')->with($data);
    }

    function getStokMarkingHolder(Request $request)
    {
        $arr = getStokMarkingHolder();
        $resp = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getDetailMarkingHolder(Request $request)
    {
        $id = $request->id;
        $arr = getDetailMarkingHolder($id);
        $resp = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getMarkingToolStock(Request $request)
    {
        $arr    = getMarkingToolStock();
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);

    }

    function igoodstocktool() : object
    {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > GOOD STOCK',
        );

        return view('Incoming.igoodstocktool')->with($data);
    }

    function igoodstocaccessories() : object {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > GOOD STOCK',
        );

        return view('Incoming.igoodstocaccessories')->with($data);
    }

    function getAccStock(Request $request)
    {
        $id     = $request->id;
        $arr    = getAccStock($id);
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getDetailGoodStock(Request $request)
    {
        $id     = $request->id;
        $arr    = getDetailGoodStock($id);
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function addaccstock(Request $request)
    {
        $id    = $request->id;
        $qty   = $request->qty;
        try {
            $update = DB::table('mst_accesories_regis')->where('id', $id)->update(
                [
                    'qty' => $qty
                ]
            );

            return response()->json(['status' => true, 'message' => 'Success Update Stock Accessories']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }

    }

    function iassy()
    {
        $plant  = DB::table('mst_plant')->where('is_active', 1)->get();
        $data   = array(
            'plant'     => $plant,
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > ASSY TOOL',
        );

        return view('Incoming.iassy')->with($data);
    }

    function getOpNameByWct(Request $request)
    {
        $id     = $request->id;
        $arr    = DB::table('mst_machine_regis')->where('id_wct', $id)->where('is_active', 1)->get();

        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function getToolPortByOpname(Request $request)
    {
        $id     = $request->id;
        $arr    = DB::table('mst_assy_tool_port_regis')->where('id_machine_regis', $id)->where('is_active', 1)->get();

        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function fetchHtmlAssy(Request $request)
    {
        $qr_code     = $request->qr_code;//qrcode holder
        $arr    = fetchHtmlAssy($qr_code);
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($arr);
    }

    function checkQrAssy(Request $request)
    {
        $qr_code     = $request->qr_code;//qrcode holder
        $type        = $request->type;
        $id          = $request->id;

        if($type == 'tool'){
            // get data from mst_marking_tool
            $data = DB::table('mst_marking_tool')->where('qr_code', $qr_code)->where('id_tool_regis',$id)->first();
            if($data){
                $resp = array(
                    'status' => true,
                    'type'  => 'tool',
                    'id'    => $id,
                );
            }else {
                $resp = array(
                    'status' => false,
                    'type'  => 'tool',
                    'id'    => $id,
                );
            }
        }else if($type == 'holder'){
            // get data from mst_marking_holder
            $data = DB::table('mst_marking_holder')->where('qr_code', $qr_code)->where('id_holder_register',$id)->first();
            if($data){
                $resp = array(
                    'status' => true,
                    'type'  => 'holder',
                    'id'    => $id,
                );
            }else {
                $resp = array(
                    'status' => false,
                    'type'  => 'holder',
                    'id'    => $id,
                );
            }

        }else {
            $data = DB::table('mst_accesories_regis')->where('part_no', $qr_code)->where('id_accesories',$id)->first();
            if($data){
                $resp = array(
                    'status' => true,
                    'type'  => 'acc',
                    'id'    => $id,
                );
            }else {
                $resp = array(
                    'status' => false,
                    'type'  => 'acc',
                    'id'    => $id,
                );
            }

        }

        return response()->json($resp);
    }

    function createAssy(Request $request)
    {
        $qr_tool   = $request->qr_tool;
        $qr_holder = $request->qr_holder;
        $qr_acc    = $request->qr_acc;

        //

        // return response()->json(
        //    $qr_holder[0]
        // );

        $qr_holder_single = $qr_holder[0];

        // get data id_plant, id_machine_regis, id_wct, id_assy_tool_port_regis
        $data_holder = DB::table('mst_marking_holder')->where('qr_code', $qr_holder_single)->first();

        // return response()->json($data_holder);
        $id_wct                     = $data_holder->id_wct;
        $id_machine_regis           = $data_holder->id_machine_regis;
        $id_assy_tool_port_regis    = $data_holder->id_assy_tool_port_regis;
        $data_plant                 = DB::table('mst_line')->where('id', $id_wct)->first();
        $id_plant                   = $data_plant->id_plant;
        $data_machine               = DB::table('mst_machine_regis')->where('id', $id_machine_regis)->first();
        $op_name                    = $data_machine->op_name;
        $data_tool_port_regis       = DB::table('mst_assy_tool_port_regis')->where('id', $id_assy_tool_port_regis)->first();
        $tool_port                  = $data_tool_port_regis->tool_port;

        // make json tool
        $json_tool      = json_encode($qr_tool);
        $json_holder    = json_encode($qr_holder);
        $json_acc       = json_encode($qr_acc);

        // 1.20.01.23.001
        // 1. (id_wct)
        // 20. (OP)
        // 01. (Tool Port)
        // 23. (Tahun Sekarang)
        // 0001 (Counting assy tool yang sudah di buat berdasarkan WCT dan OP di tahun itu)

        $count = DB::table('trx_assy')->where('id_wct', $id_wct)->where('id_machine_regis', $id_machine_regis)->count();
        $count = $count + 1;
        // sprintf 001
        $count = sprintf("%03d", $count);
        // only last 2 digit year
        $year = date('y');

        // pembentukan id_assy
        $id_assy = $id_wct.'.'.$op_name.'.'.$tool_port.'.'.date('y').'.'.$count;

        $data = array(
            'holder_qr_code'        => $qr_holder_single,
            'id_assy'               => $id_assy,
            'id_plant'              => $id_plant,
            'id_wct'                => $id_wct,
            'id_machine_regis'      => $id_machine_regis,
            'id_assy_tool_port_regis' => $id_assy_tool_port_regis,
            'json_tool'             => $json_tool,
            'json_holder'           => $json_holder,
            'json_acc'              => $json_acc,
            'status_assy'           => 1,// 1 sudah dibuat, 0 dihapuskan
            'created_at'            => Carbon::now(),
        );

        try {
            $insert = DB::table('trx_assy')->insert($data);
            return response()->json(['status' => true, 'message' => 'Success Create Assy Tool']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    function imeasure()
    {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > MEASURE',
        );

        return view('Incoming.imeasure')->with($data);
    }

    function getAssyMeasure(Request $request)
    {
        $arr    = getAssyMeasure();
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function trxAssyByQrHolder(Request $request)
    {
        $qr_code    = $request->qr_code;
        $arr        = trxAssyByQrHolder($qr_code);

        if($arr){
            $resp = array(
                'status' => true,
                'arr'   => $arr
            );
        }else {
            $resp = array(
                'status' => false,
                'arr'   => $arr
            );
        }

        return response()->json($resp);
    }

    function iassystock() : object {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (IDENTIFY) > ASSY STOCK',
        );

        return view('Incoming.iassystock')->with($data);
    }

    function getAssyStock(Request $request)
    {
        $arr    = getAssyStock();
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);
    }

    function saveZoller(Request $request)
    {
        $qr_holder    = $request->qr_holder;
        $qr_zoller    = $request->qr_zoller;
        $z_value      = $request->z_value;
        $x_value      = $request->x_value;
        $id_assy      = $request->id_assy;

        $arrUpdate = [
            'zoller_z_value' => $z_value,
            'zoller_x_value' => $x_value,
            'id_location'    => 1, //posisi di rtu center
        ];
        // 1.70.RS002;4;;;;;;2;Reamer 10H8;;130.069;4.996;;;;;;;;;;;;;;;;
        try {
            $update = DB::table('trx_assy')->where('id_assy', $id_assy)->update($arrUpdate);
            return response()->json(['status' => true, 'message' => 'Success Save Zoller']);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }

    }

    function getToRtuLine(Request $request)
    {
        $qr     = $request->qr_holder;
        $arr    = getToRtuLine($qr);
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);    
    }

    function sendRtuLine(Request $request)
    {
        $id_assy     = $request->id_assy;
        $arr         = sendRtuLine($id_assy);
        
        $resp   = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);        
    }

    function rtoolanalyze()
    {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (TOOL RETURN) > TOOL ANALYZE',
        );

        return view('Incoming.rtoolanalyze')->with($data);
    }

    function getToolAnalyze(Request $request)
    {
        $arr   = getToolAnalyze();
        $resp  = array(
            'status'    => true,
            'arr'       => $arr
        );
        
        return response()->json($resp);
    }

    function rdetailtoolanalyze(Request $request)
    {
        $qr_holder = base64_decode($request->qr_holder);

        if($request->qr_holder == null || $request->qr_holder == ''){
            // redirect with error
            return redirect()->route('rtoolanalyze')->with('error', 'QR Holder is required');
        }else {
            // check if qr holder is exist
            $check = DB::table('trx_assy')
            ->where('holder_qr_code', $qr_holder)
            ->where('id_location',3)
            ->orderBy('id','desc')
            ->first();

            if($check == null){
                // redirect with error
                return redirect()->route('rtoolanalyze')->with('error', 'QR Holder is not found');
            }

            $data = array(
                'icontitle' => 'marking',
                'title'     => 'INCOMING (TOOL RETURN) > TOOL ANALYZE',
                'qr_holder' => $qr_holder
            );

            return view('Incoming.rdetailtoolanalyze')->with($data);
        }
    }

    function getAssyInformation(Request $request)
    {
        $qr_holder = $request->qr_holder;
        $arr       = getAssyInformation($qr_holder);
        $resp      = array(
            'status' => true,
            'arr'   => $arr
        );

        return response()->json($resp);    
    }

    function detailToolAnalyze(Request $request)
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

        // ref tool type
        $ref_tool_type = DB::table('mst_tool')->get();
        $ref_tool_type = ToArr($ref_tool_type, 'id');

        // ref holder type
        $ref_holder_type = DB::table('mst_holder')->get();
        $ref_holder_type = ToArr($ref_holder_type, 'id');

        // ref acc type
        $ref_acc_type = DB::table('mst_accesories')->get();
        $ref_acc_type = ToArr($ref_acc_type, 'id');

        $arr_tool   = json_decode($trx_assy_tool->json_tool, true);
        $arr_holder = json_decode($trx_assy_tool->json_holder, true);
        $arr_acc    = json_decode($trx_assy_tool->json_acc, true);

        // get data tool
        $tool = [];
        foreach ($arr_tool as $key => $row) {
            if(array_key_exists($row, $ref_tool)) {
                $tool[$key]      = $ref_tool[$row];
                $actual_lifetime = DB::table('trx_assy')
                ->whereJsonContains('json_tool', $row)
                ->sum('total_inject');
                $tool[$key]['actual_lifetime'] = $actual_lifetime;
            }
        }
        foreach ($tool as $key => $row) {
            $tool[$key]['tool_type'] = $ref_tool_type[$row['id_tool']]['tool_type'];
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
        foreach ($holder as $key => $row) {
            $holder[$key]['holder_type'] = $ref_holder_type[$row['id_holder']]['holder_type'];
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

        foreach ($acc as $key => $row) {
            $acc[$key]['acc_type'] = $ref_acc_type[$row['id_accesories']]['accesories_type'];
        }

        // bat for reason
        $bat = DB::table('mst_bat')
        ->where('is_active', 1)
        ->get();

        $resp = [
            'status' => true,
            'tool' => $tool,
            'holder' => $holder,
            'acc' => $acc,
            'bat' => $bat
        ];

        return response()->json($resp);
    }

    function dismantle(Request $request)
    {
        $arr_tool       = $request->arr_tool;
        $arr_holder     = $request->arr_holder;
        $arr_acc        = $request->arr_acc;
        $qr_holder      = $request->qr_holder;
        $arr_bat        = $request->arr_bat;
        $id_assy        = $request->id_assy;

        // update to mst_marking_tool
        foreach ($arr_tool as $key => $row) {
            if($row['value'] == 'ng') {
                $update = DB::table('mst_marking_tool')->where('qr_code', $row['qr_code'])->update([
                    'is_stock' => 0,
                    'total_regrind_indexing' => DB::raw('total_regrind_indexing + 1'),
                    'id_location' => 4
                    
                ]);
            }else {
                $update = DB::table('mst_marking_tool')->where('qr_code', $row['qr_code'])->update([
                    'is_stock' => 1,
                    'total_regrind_indexing' => DB::raw('total_regrind_indexing + 1'),
                    'id_location' => 1
                ]);
            }
        }

        // update to mst_marking_holder
        foreach ($arr_holder as $key => $row) {
            if($row['value'] == 'ng') {
                $update = DB::table('mst_marking_holder')->where('qr_code', $row['qr_code'])->update([
                    'is_stock' => 0,
                    'id_location' => 4
                ]);
            }else {
                $update = DB::table('mst_marking_holder')->where('qr_code', $row['qr_code'])->update([
                    'is_stock' => 1,
                    'id_location' => 1
                ]);
            }
        }

        // update to mst_accesories_regis
        foreach ($arr_acc as $key => $row) {
            if($row['value'] == 'ng') {
                $update = DB::table('mst_accesories_regis')->where('part_no', str_replace("id_bat_", "", $row['qr_code']))->update([
                    'qty' => DB::raw('qty - 1')
                ]);
            }
        }

        // insert into trx_analyze
        foreach ($arr_bat as $key => $row) {
            $data = [
                'id_assy'   => $id_assy,
                'qr_code'   => str_replace("id_bat_", "", $row['qr_code']),
                'id_bat'    => $row['id_bat'],
            ];
            $insert = DB::table('trx_analyze')->insert($data);
        }

        // update trx_analyze
        foreach ($arr_tool as $key => $row) {
            DB::table('trx_analyze')
            ->where('qr_code', $row['qr_code'])
            ->update([
                'value' => $row['value'],
                'type'  => 'tool'
            ]);

            // apabila regrind, insert trx_regrind
            $id_tool_regis = DB::table('mst_marking_tool')->where('qr_code', $row['qr_code'])->first()->id_tool_regis;
            // get judgement from mst_tool_regis
            $judgement = DB::table('mst_tool_regis')->where('id', $id_tool_regis)->first()->judgement;

            if($judgement == 'regrind') {
                $insp = DB::table('mst_regrind_inspection_record')
                ->where('id_register_tool', $id_tool_regis)
                ->first();

                $data = [
                    'id_assy'               => $id_assy,
                    'qr_code'               => $row['qr_code'],
                    'json_dimension'        => $insp->dimension,
                    'json_inspection_record'=> $insp->inspection_record,
                    'status'                => 0,
                ];

                $insert = DB::table('trx_regrind')->insert($data);
            }

        }

        foreach ($arr_holder as $key => $row) {
            DB::table('trx_analyze')
            ->where('qr_code', $row['qr_code'])
            ->update([
                'value' => $row['value'],
                'type'  => 'holder'
            ]);
        }

        foreach ($arr_acc as $key => $row) {
            DB::table('trx_analyze')
            ->where('qr_code', $row['qr_code'])
            ->update([
                'value' => $row['value'],
                'type'  => 'acc'
            ]);
        }

        DB::table('trx_assy')
        ->where('id_assy', $id_assy)
        ->update([
            'id_location' => 4
        ]);        

        return response()->json(['status' => true, 'message' => 'Success Dismantle']);
    }

    function rregrind()
    {
        $machine_regrind = DB::table('mst_machine_regrind')->where('is_active', 1)->get();

        $data = array(
            'machine_regrind'   => $machine_regrind,
            'icontitle'         => 'marking',
            'title'             => 'INCOMING (TOOL RETURN) > REGRINDING',
        );

        return view('Incoming.rregrind')->with($data);
    }

    function getRegrind(Request $request)
    {
        $arr = DB::select("SELECT * FROM trx_regrind WHERE status > 0 AND status < 3");

        // ref mst_tool_regis
        $tool_regis = DB::table('mst_tool_regis')->get();
        $tool_regis = ToArr($tool_regis, 'id');

        // ref mst_tool
        $tool = DB::table('mst_tool')->get();
        $tool = ToArr($tool, 'id');

        // ref mst_maker_tool
        $maker_tool = DB::table('mst_maker_tool')->get();
        $maker_tool = ToArr($maker_tool, 'id');

        // ref mst_material
        $material = DB::table('mst_material')->get();
        $material = ToArr($material, 'id');

        // ref mst_marking
        $marking = DB::table('mst_marking_program')->get();
        $marking = ToArr($marking, 'id');

        // marking_tool
        $marking_tool = DB::table('mst_marking_tool')->get();
        $marking_tool = ToArr($marking_tool, 'qr_code');

        foreach ($arr as $key => $row) {
            if(array_key_exists($row->qr_code, $marking_tool)) {
                $arr[$key]->id_tool_regis = $marking_tool[$row->qr_code]['id_tool_regis'];
                $arr[$key]->total_regrind_indexing = $marking_tool[$row->qr_code]['total_regrind_indexing'];
            }
        }

        foreach ($arr as $key => $row) {
            if(array_key_exists($row->id_tool_regis, $tool_regis)) {
                $arr[$key]->hes_no = $tool_regis[$row->id_tool_regis]['hes_no'];
                $arr[$key]->id_tool = $tool_regis[$row->id_tool_regis]['id_tool'];
                $arr[$key]->id_maker = $tool_regis[$row->id_tool_regis]['id_maker'];
                $arr[$key]->id_material = $tool_regis[$row->id_tool_regis]['id_material'];
                $arr[$key]->id_marking = $tool_regis[$row->id_tool_regis]['id_marking'];
                $arr[$key]->spesification = $tool_regis[$row->id_tool_regis]['spesification'];
                $arr[$key]->max_regrind = $tool_regis[$row->id_tool_regis]['max_regrind'];
                $arr[$key]->part_no = $tool_regis[$row->id_tool_regis]['part_no'];

            }
        }

        

        foreach ($arr as $key => $row) {
           if(array_key_exists($row->id_tool, $tool)) {
                $arr[$key]->tool_type = $tool[$row->id_tool]['tool_type'];
            }

            if(array_key_exists($row->id_maker, $maker_tool)) {
                $arr[$key]->maker_name = $maker_tool[$row->id_maker]['maker_name'];
            }

            if(array_key_exists($row->id_material, $material)) {
                $arr[$key]->material_type = $material[$row->id_material]['material_type'];
            }

            if(array_key_exists($row->id_marking, $marking)) {
                $arr[$key]->marking = $marking[$row->id_marking]['program_no'];
            }
        }
        
        return response()->json(['status' => true, 'arr' => $arr]);
        // ref
    }

    function checkRegrindStatus(Request $request)
    {
        $qr_code = $request->qr_code;
        // get maks regrind with status 0
        $arr = DB::table('trx_regrind')
        ->where('qr_code', $qr_code)
        ->where('status','>', 0)
        ->where('status','<', 4)
        ->orderBy('id', 'desc')
        ->first();

        if($arr){
            return response()->json(['status' => true, 'arr' => $arr]);
        }else {
            return response()->json(['status' => false, 'arr' => $arr]);
        }
    }

    function toolByQr(Request $request)
    {
        $qr_code = $request->qr_code;
        $arr = DB::select("SELECT a.*,b.* FROM mst_marking_tool a LEFT JOIN mst_tool_regis b ON a.id_tool_regis = b.id WHERE a.qr_code = '$qr_code'");

        // ref mst_tool
        $tool = DB::table('mst_tool')->get();
        $tool = ToArr($tool, 'id');

        // ref mst_tool_regis
        $tool_regis = DB::table('mst_tool_regis')->get();
        $tool_regis = ToArr($tool_regis, 'id');

        // ref mst_maker_tool
        $maker_tool = DB::table('mst_maker_tool')->get();
        $maker_tool = ToArr($maker_tool, 'id');

        // ref mst_material
        $material = DB::table('mst_material')->get();
        $material = ToArr($material, 'id');

        // ref mst_marking
        $marking = DB::table('mst_marking_program')->get();
        $marking = ToArr($marking, 'id');

        // marking_tool
        $marking_tool = DB::table('mst_marking_tool')->get();
        $marking_tool = ToArr($marking_tool, 'qr_code');

        foreach ($arr as $key => $row) {
            if(array_key_exists($row->qr_code, $marking_tool)) {
                $arr[$key]->id_tool_regis = $marking_tool[$row->qr_code]['id_tool_regis'];
                $arr[$key]->total_regrind_indexing = $marking_tool[$row->qr_code]['total_regrind_indexing'];
            }
        }

        foreach ($arr as $key => $row) {
            if(array_key_exists($row->id_tool_regis, $tool_regis)) {
                $arr[$key]->hes_no = $tool_regis[$row->id_tool_regis]['hes_no'];
                $arr[$key]->id_tool = $tool_regis[$row->id_tool_regis]['id_tool'];
                $arr[$key]->id_maker = $tool_regis[$row->id_tool_regis]['id_maker'];
                $arr[$key]->id_material = $tool_regis[$row->id_tool_regis]['id_material'];
                $arr[$key]->id_marking = $tool_regis[$row->id_tool_regis]['id_marking'];
                $arr[$key]->spesification = $tool_regis[$row->id_tool_regis]['spesification'];
                $arr[$key]->max_regrind = $tool_regis[$row->id_tool_regis]['max_regrind'];
                $arr[$key]->part_no = $tool_regis[$row->id_tool_regis]['part_no'];

            }
        }

        

        foreach ($arr as $key => $row) {
           if(array_key_exists($row->id_tool, $tool)) {
                $arr[$key]->tool_type = $tool[$row->id_tool]['tool_type'];
            }

            if(array_key_exists($row->id_maker, $maker_tool)) {
                $arr[$key]->maker_name = $maker_tool[$row->id_maker]['maker_name'];
            }

            if(array_key_exists($row->id_material, $material)) {
                $arr[$key]->material_type = $material[$row->id_material]['material_type'];
            }

            if(array_key_exists($row->id_marking, $marking)) {
                $arr[$key]->marking = $marking[$row->id_marking]['program_no'];
            }
        }



        return response()->json(['status' => true, 'arr' => $arr]);    
    }

    function startRegrind(Request $request)
    {
        $id_trx_regrind     = $request->id_trx_regrind;
        $machine_regrind    = $request->machine_regrind;
        $qr_code            = $request->qr_code;
        // update trx_regrind
        $update = DB::table('trx_regrind')
        ->where('id', $id_trx_regrind)
        ->update([
            'id_machine_regrind' => $machine_regrind,
            'status' => 1,
            'start_regrind' => Carbon::now(),
            'id_user_start' => Auth::user()->id
        ]);

        return response()->json(['status' => true, 'message' => 'Success Start Regrind']);    
    }

    function inspectionRecordByQr(Request $request)
    {
        $qr_code = $request->qr_code;
        // // get data id_tool_regis
        $id_tool_regis = DB::table('mst_marking_tool')->where('qr_code', $qr_code)->first()->id_tool_regis;

        $max_regrind = DB::table('mst_tool_regis')->where('id', $id_tool_regis)->first()->max_regrind;
        // get the latest data from trx_regrind
        $arr = DB::table('trx_regrind')
        ->where('qr_code', $qr_code)
        ->orderBy('id', 'desc')
        ->first();

        if($arr){
            $arr->max_regrind = $max_regrind;
            return response()->json(['status' => true, 'arr' => $arr]);
        }else {
            return response()->json(['status' => false, 'arr' => $arr]);
        }

    }

    function stopRegrind(Request $request)
    {
        $id_trx_regrind    = $request->id_trx_regrind;
        $qr_code           = $request->qr_code;
        $dimension         = $request->dimension;
        $inspection_record = $request->inspection_record;
        $status            = 2; //stop regrind
        $output            = array_map(null, ...$inspection_record);

        // update trx_regrind
        $update = DB::table('trx_regrind')
        ->where('id', $id_trx_regrind)
        ->update([
            'status'                 => $status,
            'end_regrind'            => Carbon::now(),
            'id_user_stop'           => Auth::user()->id,
            'json_dimension'         => $dimension,
            'json_inspection_record' => $output
        ]);

        // update mst_marking_tool untuk update total regrind indexing
        $update = DB::table('mst_marking_tool')
        ->where('qr_code', $qr_code)
        ->update([
            'total_regrind_indexing' => DB::raw('total_regrind_indexing + 1')
        ]);

        return response()->json(['status' => true, 'message' => 'Success Stop Regrind']);        
    }

    function qcRegrind(Request $request)
    {
        $id_trx_regrind    = $request->id_trx_regrind;
        $qr_code           = $request->qr_code;
        
        // update trx_regrind
        $update = DB::table('trx_regrind')
        ->where('id', $id_trx_regrind)
        ->update([
            'status'              => 3,
            'id_user_qc'          => Auth::user()->id,
            'time_qc'             => Carbon::now(),
        ]);

        return response()->json(['status' => true, 'message' => 'Success QC Regrind']);
    }
    
    function users()
    {

        $data = array(
            'icontitle' => 'incoming',
            'title'     => 'Users',
        );

        return view('Configuration.users')->with($data);
    }

    function getUser(Request $request)
    {
        $id  = $request->id;
        $arr = getuser($id);

        if($arr){
            $resp = array(
                'status' => true,
                'arr'   => $arr
            );
        }else {
            $resp = array(
                'status' => false,
                'arr'   => $arr
            );
        }

        return response()->json($resp);
    }

    function crudUser(Request $request)
    {
        $aksi = $request->aksi;
        if($aksi == 'add'){
            try {
                $validatedData = $request->validate([
                    'name'      => 'required',
                    'nrp'       => 'required',
                    'rfid'      => 'required',
                    'role'      => 'required',
                    'password'  => 'required',
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => 'error', 'message' => $firstError]);
            }

            $data = array(
                'name'      => $request->name,
                'nrp'       => $request->nrp,
                'rfid'      => $request->rfid,
                'role'      => $request->role,
                'password'  => bcrypt($request->password),
                'created_at'=> Carbon::now(),
            );

            // upload file if exist to public/user
            if($request->hasFile('img')) {
                $file           = $request->file('img');
                $filename       = $file->getClientOriginalName();
                $file->move('public/user', $filename);
                $data['user_photo'] = $filename;
            }else{
                $data['user_photo'] = 'default.jpg';
            }

            try {
                $insert = DB::table('users')->insert($data);
                return response()->json(['status' => true, 'message' => 'Success Add User']);
            } catch (\Throwable $th) {
                return response()->json(['status' => false, 'message' => $th->getMessage()]);
            }

        }else if($aksi == 'edit'){
            try {
                $validatedData = $request->validate([
                    'name'      => 'required',
                    'nrp'       => 'required',
                    'rfid'      => 'required',
                    'role'      => 'required',
                    'password'  => 'required',
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => 'error', 'message' => $firstError]);
            }

            $id_edit = $request->id_edit;
            // check old password
            $old_password = DB::table('users')->where('id', $id_edit)->first()->password;
            if($old_password != $request->password){
                $data = array(
                    'name'      => $request->name,
                    'nrp'       => $request->nrp,
                    'rfid'      => $request->rfid,
                    'role'      => $request->role,
                    'password'  => bcrypt($request->password),
                    'updated_at'=> Carbon::now(),
                );
            }else {
                $data = array(
                    'name'      => $request->name,
                    'nrp'       => $request->nrp,
                    'rfid'      => $request->rfid,
                    'role'      => $request->role,
                    'updated_at'=> Carbon::now(),
                );
            }

            // upload file if exist to public/user
            if($request->hasFile('img')) {
                $file           = $request->file('img');
                $filename       = $file->getClientOriginalName();
                $file->move('public/user', $filename);
                $data['user_photo'] = $filename;
            }

            try {
                $update = DB::table('users')->where('id', $id_edit)->update($data);
                return response()->json(['status' => true, 'message' => 'Success Edit User']);
            } catch (\Throwable $th) {
                return response()->json(['status' => false, 'message' => $th->getMessage()]);
            }

        }else {
            $id     = $request->id;
            $delete = DB::table('users')
            ->where('id', $id)
            ->update([
                'is_active' => 0
            ]);
            return response()->json(['status' => true, 'message' => 'Success Delete User']);
        }
    }

    function testincoming()
    {
		$arr = getMarkingToolStock();

        echo "<pre>";print_r($arr);exit;
    }
}
