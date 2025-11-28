<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

class MainController extends Controller
{

    function index()
    {
        $data = array(
            'icontitle' => 'Master Data',
            'title' => 'Home',
        );

        return view('Dashboard.list')->with($data);
    }

    // Master Data plant
    function mplant() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mplant')->with($data);

    }

    function addPlant(Request $request) : object
    {
        $id_plant   = $request->id_plant;
        $plant_name = $request->plant_name;
        $plant_desc = $request->plant_description;
        $id_user    = Auth::user()->id;

        try {
            $data = array(
                'id_plant'          => $id_plant,
                'plant_name'        => $plant_name,
                'plant_description' => $plant_desc,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_plant')->insert($data);
            $arr = getAllPlant();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    function getPlant(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllPlant($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function editPlant(Request $request): object
    {
        $id         = $request->id;
        $id_plant   = $request->id_plant;
        $plant_name = $request->plant_name;
        $plant_desc = $request->plant_description;
        $id_user    = Auth::user()->id;

        try {
            $data = array(
                'id_plant'          => $id_plant, // 'id_plant' => 'required|unique:mst_plant,id_plant,'.$id_plant.',id_plant
                'plant_name'        => $plant_name,
                'plant_description' => $plant_desc,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_plant')->where('id', $id)->update($data);
            $arr = getAllPlant();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    function deletePlant(Request $request) : object
    {
        $id = $request->id;
        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_plant')->where('id', $id)->update($data);
            $arr = getAllPlant();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    // master data line
    function mline() : object
    {
        $plant  = DB::table('mst_plant')->where('is_active', 1)->get();
        $data   = array(
            'plant'     => $plant,
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mline')->with($data);

    }

    function getAllLine(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllLine($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addLine(Request $request) : object
    {
        $id_plant   = $request->id_plant;
        $id_wct     = $request->id_wct;
        $line_name  = $request->line_name;
        $id_user    = Auth::user()->id;

        try {
            $data = array(
                'id_plant'          => $id_plant,
                'id_wct'            => $id_wct,
                'line_name'         => $line_name,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_line')->insert($data);
            $arr = getAllLine();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    function editLine(Request $request): object
    {
        $id         = $request->id;
        $id_plant   = $request->id_plant;
        $id_wct     = $request->id_wct;
        $line_name  = $request->line_name;
        $id_user    = Auth::user()->id;

        try {
            $data = array(
                'id_plant'          => $id_plant,
                'id_wct'            => $id_wct,
                'line_name'         => $line_name,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_line')->where('id', $id)->update($data);
            $arr = getAllLine();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    function deleteLine(Request $request) : object
    {
        $id = $request->id;
        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_line')->where('id', $id)->update($data);
            $arr = getAllLine();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    // master data model
    function mmodel() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mmodel')->with($data);

    }

    function getAllModel(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllModel($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addModel(Request $request) : object
    {
        $id_model   = $request->id_model;
        $model_name = $request->model_name;
        $id_user    = Auth::user()->id;

        // return if id_model || model_name is empty
        if (empty($id_model) || empty($model_name)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Model dan Nama Model tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return if id_model already exist
        $check = DB::table('mst_model')->where('id_model', $id_model)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Model sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'id_model'          => $id_model,
                'model_name'        => $model_name,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );

            DB::table('mst_model')->insert($data);
            $arr = getAllModel();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    function editModel(Request $request): object
    {
        $id         = $request->id_edit;
        $id_model   = $request->id_model;
        $model_name = $request->model_name;
        $id_user    = Auth::user()->id;

        // return if id_model || model_name is empty
        if (empty($id_model) || empty($model_name)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Model dan Nama Model tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return response()->json($request->all());

        try {
            $data = array(
                'id_model'          => $id_model,
                'model_name'        => $model_name,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_model')->where('id', $id)->update($data);
            $arr = getAllModel();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }
        return response()->json($all);
    }

    function deleteModel(Request $request)
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_model')->where('id', $id)->update($data);
            $arr = getAllModel();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // master data part
    function mpart() : object
    {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mpart')->with($data);

    }

    function getAllPart(Request $request) : Object
    {
        $id  = $request->id;
        $arr = getAllPart($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addPart(Request $request) : Object
    {
        $id_part   = $request->id_part;
        $part_name = $request->part_name;
        $id_user   = Auth::user()->id;

        // return if id_part || part_name is empty
        if (empty($id_part) || empty($part_name)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Part dan Nama Part tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return if id_part already exist
        $check = DB::table('mst_part')->where('id_part', $id_part)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Part sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'id_part'           => $id_part,
                'part_name'         => $part_name,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_part')->insert($data);
            $arr = getAllPart();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function editPart(Request $request) : object
    {
        $id         = $request->id_edit;
        $id_part    = $request->id_part;
        $part_name  = $request->part_name;
        $id_user    = Auth::user()->id;

        // return if id_part || part_name is empty
        if (empty($id_part) || empty($part_name)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Part dan Nama Part tidak boleh kosong',
            );
            return response()->json($all);
        }

        try {

            $data = array(
                'id_part'           => $id_part,
                'part_name'         => $part_name,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_part')->where('id', $id)->update($data);
            $arr = getAllPart();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }

        return response()->json($all);

    }

    function deletePart(Request $request) : object
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_part')->where('id', $id)->update($data);
            $arr = getAllPart();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // Master Data Holder
    function mholder() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mholder')->with($data);

    }

    function getAllHolder(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllHolder($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addHolder(Request $request) : object
    {
        $id_holder      = $request->id_holder;
        $holder_type    = $request->holder_type;
        $id_user        = Auth::user()->id;

        // return if id_holder || holder_type is empty
        if (empty($id_holder) || empty($holder_type)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Holder dan Tipe Holder tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return if id_holder already exist
        $check = DB::table('mst_holder')->where('id_holder', $id_holder)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Holder sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'id_holder'         => $id_holder,
                'holder_type'       => $holder_type,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_holder')->insert($data);
            $arr = getAllHolder();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status' => 'error',
                'message' => $th->getMessage(),
            );
        }

        return response()->json($all);

    }

    function editHolder(Request $request) : object
    {
        $id             = $request->id_edit;
        $id_holder      = $request->id_holder;
        $holder_type    = $request->holder_type;
        $id_user        = Auth::user()->id;

        // return if id_holder || holder_type is empty
        if (empty($id_holder) || empty($holder_type)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Holder dan Tipe Holder tidak boleh kosong',
            );
            return response()->json($all);
        }

        try {

            $data = array(
                'id_holder'         => $id_holder,
                'holder_type'       => $holder_type,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_holder')->where('id', $id)->update($data);
            $arr = getAllHolder();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function deleteHolder(Request $request) : object
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_holder')->where('id', $id)->update($data);
            $arr = getAllHolder();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // Master Data Tool
    function mtool() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mtool')->with($data);

    }

    function getAllTool(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllTool($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addTool(Request $request) : object
    {
        $id_tool        = $request->id_tool;
        $tool_type      = $request->tool_type;
        $id_user        = Auth::user()->id;

        // return if id_tool || tool_name is empty
        if (empty($id_tool) || empty($tool_type)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Tool dan Nama Tool tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return if id_tool already exist
        $check = DB::table('mst_tool')->where('id_tool', $id_tool)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Tool sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'id_tool'           => $id_tool,
                'tool_type'         => $tool_type,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_tool')->insert($data);
            $arr = getAllTool();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);

    }

    function editTool(Request $request) : object
    {
        $id             = $request->id_edit;
        $id_tool        = $request->id_tool;
        $tool_type      = $request->tool_type;
        $id_user        = Auth::user()->id;

        // return if id_tool || tool_name is empty
        if (empty($id_tool) || empty($tool_type)) {
            $all = array(
                'status'    => 'error',
                'message'   => 'ID Tool dan Nama Tool tidak boleh kosong',
            );
            return response()->json($all);
        }

        try {

            $data = array(
                'id_tool'           => $id_tool,
                'tool_type'         => $tool_type,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_tool')->where('id', $id)->update($data);
            $arr = getAllTool();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function deleteTool(Request $request) : object
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_tool')->where('id', $id)->update($data);
            $arr = getAllTool();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // Master Data Material
    function mmaterial() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mmaterial')->with($data);

    }

    function getAllMaterial(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllMaterial($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addMaterial(Request $request) : object
    {
        $id_material    = $request->id_material;
        $material_type  = $request->material_type;
        $id_user        = Auth::user()->id;

        // return if id_material || material_type is empty
        if (empty($id_material) || empty($material_type)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Material dan Type Material tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return if id_material already exist
        $check = DB::table('mst_material')->where('id_material', $id_material)->where('is_active',true)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Material sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'id_material'       => $id_material,
                'material_type'     => $material_type,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_material')->insert($data);
            $arr = getAllMaterial();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function editMaterial(Request $request) : object
    {
        $id             = $request->id_edit;
        $id_material    = $request->id_material;
        $material_type  = $request->material_type;
        $id_user        = Auth::user()->id;

        // return if id_material || material_type is empty
        if (empty($id_material) || empty($material_type)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Material dan Type Material tidak boleh kosong',
            );
            return response()->json($all);
        }

        try {

            $data = array(
                'id_material'       => $id_material,
                'material_type'     => $material_type,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_material')->where('id', $id)->update($data);
            $arr = getAllMaterial();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function deleteMaterial(Request $request) : object
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_material')->where('id', $id)->update($data);
            $arr = getAllMaterial();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // Master Data Accessories
    function maccessories() : object
    {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.maccessories')->with($data);

    }

    function addAcc(Request $request) : object
    {
        try {
            $validatedData = $request->validate([
                'id_acc' => 'required',
                'acc_type' => 'required',
            ]);
        } catch (ValidationException $e) {
            $errors     = $e->validator->errors();
            $firstError = $errors->first();
            return response()->json(['status' => 'error', 'message' => $firstError]);
        }

        $id_acc         = $request->id_acc;
        $acc_type       = $request->acc_type;
        $id_user        = Auth::user()->id;

        // return if id_acc already exist
        $check = DB::table('mst_accesories')->where('id_accesories', $id_acc)->where('is_active',true)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Accessories sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'id_accesories'            => $id_acc,
                'accesories_type'          => $acc_type,
                'created_by'               => $id_user,
                'created_at'               => Carbon::now(),
                'updated_at'               => Carbon::now(),
            );
            DB::table('mst_accesories')->insert($data);
            $arr = getAllAcc();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function getAllAcc(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllAcc($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function editAcc(Request $request) : object
    {
        try {
            $validatedData = $request->validate([
                'id_edit'   => 'required',
                'id_acc'    => 'required',
                'acc_type'  => 'required',
            ]);
        } catch (ValidationException $e) {
            $errors     = $e->validator->errors();
            $firstError = $errors->first();
            return response()->json(['status' => 'error', 'message' => $firstError]);
        }

        $id             = $request->id_edit;
        $id_acc         = $request->id_acc;
        $acc_type       = $request->acc_type;
        $id_user        = Auth::user()->id;

        try {

            $data = array(
                'id_accesories'            => $id_acc,
                'accesories_type'          => $acc_type,
                'created_by'               => $id_user,
                'updated_at'               => Carbon::now(),
            );
            DB::table('mst_accesories')->where('id', $id)->update($data);
            $arr = getAllAcc();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function deleteAcc(Request $request) : object
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_accesories')->where('id', $id)->update($data);
            $arr = getAllAcc();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // Master Data Bat
    function mbat() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mbat')->with($data);

    }

    function getAllBat(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllBat($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addBat(Request $request) : object
    {
        $bat_desc       = $request->bat_desc;
        $id_user        = Auth::user()->id;

        // return if id_bat || bat_desc is empty
        if (empty($bat_desc)) {
            $all = array(
                'status' => 'error',
                'message' => 'Bat Description tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return if id_bat already exist
        $check = DB::table('mst_bat')->where('bat_desc', $bat_desc)->where('is_active',true)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'Bat sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'bat_desc'          => $bat_desc,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_bat')->insert($data);
            $arr = getAllBat();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function editBat(Request $request) : object
    {
        $id             = $request->id_edit;
        $bat_desc       = $request->bat_desc;
        $id_user        = Auth::user()->id;

        // return if id_bat || bat_desc is empty
        if (empty($bat_desc)) {
            $all = array(
                'status' => 'error',
                'message' => 'Bat Description tidak boleh kosong',
            );
            return response()->json($all);
        }

        try {

            $data = array(
                'bat_desc'          => $bat_desc,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_bat')->where('id', $id)->update($data);
            $arr = getAllBat();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function deleteBat(Request $request) : object
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_bat')->where('id', $id)->update($data);
            $arr = getAllBat();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // Master Data Tolerance
    function mtolerance() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mtolerance')->with($data);

    }

    function getAllTol(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllTol($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function addTol(Request $request) : object
    {
        $id_tol         = $request->id_tol;
        $tol_type       = $request->tol_type;
        $tol_length     = $request->tol_length;
        $id_user        = Auth::user()->id;

        // return if id_tol || tol_desc is empty
        if (empty($id_tol) || empty($tol_length) || empty($tol_type) ) {
            $all = array(
                'status' => 'error',
                'message' => 'Semua field tidak boleh kosong',
            );
            return response()->json($all);
        }

        // return if id_tol already exist
        $check = DB::table('mst_tolerance')->where('id_tolerance', $id_tol)->where('is_active',true)->first();
        if (!empty($check)) {
            $all = array(
                'status' => 'error',
                'message' => 'ID Tolerance sudah terdaftar',
            );
            return response()->json($all);
        }

        try {
            $data = array(
                'id_tolerance'      => $id_tol,
                'tolerance_type'    => $tol_type,
                'tolerance_length'    => $tol_length,
                'created_by'        => $id_user,
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_tolerance')->insert($data);
            $arr = getAllTol();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function editTol(Request $request) : object
    {
        $id             = $request->id_edit;
        $id_tol         = $request->id_tol;
        $tol_type       = $request->tol_type;
        $tol_length     = $request->tol_length;
        $id_user        = Auth::user()->id;

        // return if id_tol || tol_desc is empty
        if (empty($id_tol) || empty($tol_length) || empty($tol_type) ) {
            $all = array(
                'status' => 'error',
                'message' => 'Semua field tidak boleh kosong',
            );
            return response()->json($all);
        }

        try {

            $data = array(
                'id_tolerance'      => $id_tol,
                'tolerance_type'    => $tol_type,
                'tolerance_length'    => $tol_length,
                'created_by'        => $id_user,
                'updated_at'        => Carbon::now(),
            );
            DB::table('mst_tolerance')->where('id', $id)->update($data);
            $arr = getAllTol();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil disimpan',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    function deleteTol(Request $request) : object
    {
        $id = $request->id;

        try {
            // update is_active = 0
            $data = array(
                'is_active' => 0,
                'updated_at' => Carbon::now(),
            );
            DB::table('mst_tolerance')->where('id', $id)->update($data);
            $arr = getAllTol();
            $all = array(
                'status'    => 'success',
                'message'   => 'Data berhasil dihapus',
                'arr'       => $arr,
            );
        } catch (\Throwable $th) {
            $all = array(
                'status'   => 'error',
                'message'  => $th->getMessage(),
            );
        }

        return response()->json($all);
    }

    // Maker Tool
    function mmakertool() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mmakertool')->with($data);

    }

    function getAllMaker(Request $request)
    {
        $id  = $request->id;
        $arr = getAllMaker($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function crudMaker(Request $request)
    {
        $aksi = $request->aksi;
        if($aksi == 'add'){
            $id_maker       = $request->id_maker;
            $maker_name     = $request->maker_name;
            $suplier_name   = $request->suplier_name;
            $id_user        = Auth::user()->id;

            // return if id_maker || maker_name is empty
            if (empty($id_maker) || empty($maker_name)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'ID Maker dan Nama Maker tidak boleh kosong',
                );
                return response()->json($all);
            }

            // return if id_maker already exist
            $check = DB::table('mst_maker_tool')->where('id_maker', $id_maker)->where('is_active',true)->first();
            if (!empty($check)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'ID Maker sudah terdaftar',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'id_maker'          => $id_maker,
                    'maker_name'        => $maker_name,
                    'suplier_name'      => $suplier_name,
                    'created_by'        => $id_user,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                );
                DB::table('mst_maker_tool')->insert($data);
                $arr = getAllMaker();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

            return response()->json($all);
        }else if($aksi == 'edit'){
            $id             = $request->id;
            $id_maker       = $request->id_maker;
            $maker_name     = $request->maker_name;
            $suplier_name   = $request->suplier_name;
            $id_user        = Auth::user()->id;

            // return if id_maker || maker_name is empty
            if (empty($id_maker) || empty($maker_name)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'ID Maker dan Nama Maker tidak boleh kosong',
                );
                return response()->json($all);
            }

            try {

                $data = array(
                    'id_maker'          => $id_maker,
                    'maker_name'        => $maker_name,
                    'suplier_name'      => $suplier_name,
                    'created_by'        => $id_user,
                    'updated_at'        => Carbon::now(),
                );
                DB::table('mst_maker_tool')->where('id', $id)->update($data);
                $arr = getAllMaker();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

            return response()->json($all);
        }else{
            $id = $request->id;

            try {
                // update is_active = 0
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now(),
                );
                DB::table('mst_maker_tool')->where('id', $id)->update($data);
                $arr = getAllMaker();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil dihapus',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

            return response()->json($all);
        }
    }

    // MAKER MACHINE
    function mmakermachine() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mmakermachine')->with($data);

    }

    function getAllMakerMachine(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllMakerMachine($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function crudMakerMachine(Request $request) : object
    {
        $aksi               = $request->aksi;
        if($aksi == 'add'){
            $id_maker_machine       = $request->id_maker_machine;
            $machine_name           = $request->machine_name;
            $suplier_name           = $request->suplier_name;
            $id_user                = Auth::user()->id;

            // return if id_maker || maker_name is empty
            if (empty($id_maker_machine) || empty($machine_name) || empty($suplier_name)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Data tidak boleh kosong',
                );
                return response()->json($all);
            }

            // return if id_maker already exist
            $check = DB::table('mst_maker_machine')->where('id_maker_machine', $id_maker_machine)->where('is_active',true)->first();
            if (!empty($check)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'ID Maker sudah terdaftar',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'id_maker_machine'      => $id_maker_machine,
                    'machine_name'          => $machine_name,
                    'suplier_name'          => $suplier_name,
                    'created_by'            => $id_user,
                    'created_at'            => Carbon::now(),
                    'updated_at'            => Carbon::now(),
                );
                DB::table('mst_maker_machine')->insert($data);
                $arr = getAllMakerMachine();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

            return response()->json($all);
        }else if($aksi == 'edit'){
            $id                     = $request->id;
            $id_maker_machine       = $request->id_maker_machine;
            $machine_name           = $request->machine_name;
            $suplier_name           = $request->suplier_name;
            $id_user                = Auth::user()->id;

            // return if id_maker || maker_name is empty
            if (empty($id_maker_machine) || empty($machine_name) || empty($suplier_name)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Data tidak boleh kosong',
                );
                return response()->json($all);
            }

            try {

                $data = array(
                    'id_maker_machine'      => $id_maker_machine,
                    'machine_name'          => $machine_name,
                    'suplier_name'          => $suplier_name,
                    'created_by'            => $id_user,
                    'updated_at'            => Carbon::now(),
                );
                DB::table('mst_maker_machine')->where('id', $id)->update($data);
                $arr = getAllMakerMachine();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

            return response()->json($all);

        }else{

            $id = $request->id;

            try {
                // update is_active = 0
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now(),
                );
                DB::table('mst_maker_machine')->where('id', $id)->update($data);
                $arr = getAllMakerMachine();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil dihapus',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

            return response()->json($all);
        }
    }

    // Master Data Machine Regrind

    function mmachineregrind() : object
    {
        $plant = DB::table('mst_plant')->where('is_active', true)->get();

        $data = array(
            'plant'     => $plant,
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mmachineregrind')->with($data);

    }

    function getAllMachineRegrind(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllMachineRegrind($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function crudMachineRegrind(Request $request): object
    {
        $aksi                   = $request->aksi;

        if($aksi == 'add'){
            $id_plant           = $request->id_plant;
            $no_asset           = $request->no_asset;
            $machine_regrind    = $request->machine_name;
            $id_user            = Auth::user()->id;

            // return if id_plant || no_asset || machine_regrind is empty
            if (empty($id_plant) || empty($no_asset) || empty($machine_regrind)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Semua field tidak boleh kosong',
                );
                return response()->json($all);
            }

            // return if machine already registered from no_asset
            $check = DB::table('mst_machine_regrind')->where('no_asset', $no_asset)->where('is_active',true)->first();

            if (!empty($check)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'No Asset sudah terdaftar',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'id_plant'          => $id_plant,
                    'no_asset'          => $no_asset,
                    'machine_regrind'   => $machine_regrind,
                    'created_by'        => $id_user,
                    'created_at'        => Carbon::now(),
                    'updated_at'        => Carbon::now(),
                );
                DB::table('mst_machine_regrind')->insert($data);
                $arr = getAllMachineRegrind();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }else if($aksi == 'edit'){
            $id             = $request->id;
            $id_plant       = $request->id_plant;
            $no_asset       = $request->no_asset;
            $machine_regrind= $request->machine_name;
            $id_user        = Auth::user()->id;

            // return if id_plant || no_asset || machine_regrind is empty
            if (empty($id_plant) || empty($no_asset) || empty($machine_regrind)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Semua field tidak boleh kosong',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'id_plant'          => $id_plant,
                    'no_asset'          => $no_asset,
                    'machine_regrind'   => $machine_regrind,
                    'created_by'        => $id_user,
                    'updated_at'        => Carbon::now(),
                );
                DB::table('mst_machine_regrind')->where('id', $id)->update($data);
                $arr = getAllMachineRegrind();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }
        }else {
            $id = $request->id;

            try {
                // update is_active = 0
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now(),
                );
                DB::table('mst_machine_regrind')->where('id', $id)->update($data);
                $arr = getAllMachineRegrind();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil dihapus',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }

        return response()->json($all);
    }

    // Master Data Marking Program
    function mmarkingprogram() : object
    {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.mmarkingprogram')->with($data);

    }

    function getAllMarkingProgram(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllMarkingProgram($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function crudMarkingProgram(Request $request) : object
    {
        $aksi                   = $request->aksi;

        if($aksi == 'add'){
            $program_no = $request->program_no;
            $description    = $request->description;
            $id_user            = Auth::user()->id;

            // return if id_marking_program || marking_program is empty
            if (empty($program_no) || empty($description)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Semua field tidak boleh kosong',
                );
                return response()->json($all);
            }

            // return if id_marking_program already exist
            $check = DB::table('mst_marking_program')->where('program_no', $program_no)->where('is_active',true)->first();
            if (!empty($check)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Marking Program sudah terdaftar',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'program_no'    => $program_no,
                    'description'       => $description,
                    'created_by'            => $id_user,
                    'created_at'            => Carbon::now(),
                    'updated_at'            => Carbon::now(),
                );
                DB::table('mst_marking_program')->insert($data);
                $arr = getAllMarkingProgram();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }else if($aksi == 'edit'){
            $id                 = $request->id;
            $program_no         = $request->program_no;
            $description        = $request->description;
            $id_user            = Auth::user()->id;

            // return if id_marking_program || marking_program is empty
            if (empty($program_no) || empty($description)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Semua field tidak boleh kosong',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'program_no'    => $program_no,
                    'description'       => $description,
                    'created_by'            => $id_user,
                    'updated_at'            => Carbon::now(),
                );
                DB::table('mst_marking_program')->where('id', $id)->update($data);
                $arr = getAllMarkingProgram();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }else{
            $id = $request->id;

            try {
                // update is_active = 0
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now(),
                );
                DB::table('mst_marking_program')->where('id', $id)->update($data);
                $arr = getAllMarkingProgram();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil dihapus',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }

        return response()->json($all);
    }

    // master unit
    function munit() : object {

        $data = array(
            'icontitle' => 'masterdata',
            'title'     => 'Master Data',
        );

        return view('Masterdata.munit')->with($data);
    }

    function getAllUnit(Request $request) : object
    {
        $id  = $request->id;
        $arr = getAllUnit($id);

        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);
    }

    function crudUnit(Request $request) : object
    {
        $aksi                   = $request->aksi;

        if($aksi == 'add'){
            $description    = $request->description;
            $id_user        = Auth::user()->id;

            // return if id_unit || unit_desc is empty
            if (empty($description)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Semua field tidak boleh kosong',
                );
                return response()->json($all);
            }

            // return if id_unit already exist
            $check = DB::table('mst_unit')->where('description', $description)->where('is_active',true)->first();
            if (!empty($check)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Unit sudah terdaftar',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'description'           => $description,
                    'created_by'            => $id_user,
                    'created_at'            => Carbon::now(),
                    'updated_at'            => Carbon::now(),
                );
                DB::table('mst_unit')->insert($data);
                $arr = getAllUnit();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }else if($aksi == 'edit'){
            $id                 = $request->id;
            $description        = $request->description;
            $id_user            = Auth::user()->id;

            // return if id_unit || unit_desc is empty
            if (empty($description)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Semua field tidak boleh kosong',
                );
                return response()->json($all);
            }

            // return if id_unit already exist
            $check = DB::table('mst_unit')->where('description', $description)->where('is_active',true)->first();
            if (!empty($check)) {
                $all = array(
                    'status' => 'error',
                    'message' => 'Unit sudah terdaftar',
                );
                return response()->json($all);
            }

            try {
                $data = array(
                    'description'       => $description,
                    'created_by'        => $id_user,
                    'updated_at'        => Carbon::now(),
                );
                DB::table('mst_unit')->where('id', $id)->update($data);
                $arr = getAllUnit();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil disimpan',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }else{
            $id = $request->id;

            try {
                // update is_active = 0
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now(),
                );
                DB::table('mst_unit')->where('id', $id)->update($data);
                $arr = getAllUnit();
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data berhasil dihapus',
                    'arr'       => $arr,
                );
            } catch (\Throwable $th) {
                $all = array(
                    'status'   => 'error',
                    'message'  => $th->getMessage(),
                );
            }

        }

        return response()->json($all);
    }

    // End Master Data

    // Incoming
    function incoming() : object {

        $data = array(
            'icontitle' => 'incoming',
            'title'     => 'Incoming',
        );

        return view('Incoming.list')->with($data);
    }

    function tgate() : object {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (TRANSACTION) > GATE TRANSACTION',
        );

        return view('Incoming.tgate')->with($data);
    }

    function tabnormality() : object {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (TRANSACTION) > ABNORMALITY',
        );

        return view('Incoming.tabnormality')->with($data);
    }

    function tassytortuline() : object {

        $data = array(
            'icontitle' => 'marking',
            'title'     => 'INCOMING (TRANSACTION) > SEND TO RTU LINE',
        );

        return view('Incoming.tassytortuline')->with($data);
    }

    
    // End Incoming

    // Pkayoke
    // End Pokayoke`

    // Pkayoke First
    function tfirstpokayokestep1(Request $request){

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

        return view('Incoming.firstpokayokestep1')->with($data);
    }

    function tfirstpokayokestep2(Request $request)
    {
        $id_list_machine = base64_decode(request()->id_list_machine);

        $data = array(
            'id_list_machine' => $id_list_machine,
            // 'tool_port'       => $tool_port,
            'icontitle'       => 'marking',
            'title'           => 'POKAYOKE',
        );

        return view('Incoming.firstpokayokestep2')->with($data);
    }

    function tfirstpokayokestep3(Request $request)
    {
        $id_list_machine = base64_decode(request()->id_list_machine);
        $tool_port       = base64_decode(request()->tool_port);
        $id_assy_new     = base64_decode(request()->id_assy_new);

        if($id_list_machine == null || $tool_port == null || $id_assy_new == null) {
            return redirect()->route('tfirstpokayokestep1');
        }

        $data = array(
            'id_list_machine' => $id_list_machine,
            'tool_port'       => $tool_port,
            'id_assy_new'     => $id_assy_new,
            'icontitle'       => 'marking',
            'title'           => 'POKAYOKE',
        );

        return view('Incoming.firstpokayokestep3')->with($data);
    }

    function tfirstpokayokestep4(Request $request)
    {
        $id_list_machine = base64_decode(request()->id_list_machine);
        $tool_port       = base64_decode(request()->tool_port);
        $id_assy_new     = base64_decode(request()->id_assy_new);
        $status          = base64_decode(request()->status);

        if($id_list_machine == null || $tool_port == null || $id_assy_new == null || $status == null) {
            return redirect()->route('tfirstpokayokestep1');
        }

        // insert into trx_machine_assy_tool and trx_assy data baru, tanpa update old tool
        $insert = DB::table('trx_machine_assy_tool')->insert([
            'id_list_machine'   => $id_list_machine,
            'id_trx_assy_old'   => $id_assy_new,
            'id_user_install'   => Auth::user()->id,
            'flag_desktop'      => 0,
            'flag_transaction'  => 0,
            'start_install'     => Carbon::now(),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        // update id_assy_new di trx_assy
        $updateAssyNew = DB::table('trx_assy')
        ->where('id_assy', $id_assy_new)
        ->update([
            'id_user_install'   => Auth::user()->id,
            'start_install'     => Carbon::now(),
            'id_location'       => 3,
        ]);

        $data   = array(
            'id_list_machine' => $id_list_machine,
            'tool_port'       => $tool_port,
            'id_assy_new'     => $id_assy_new,
            'status'          => $status,
            'icontitle'       => 'marking',
            'title'           => 'POKAYOKE',
        );

        return view('Incoming.firstpokayokestep4')->with($data);
    }
    // End Pokayoke First

    function report() : object {

        $data = array(
            'icontitle' => 'incoming',
            'title'     => 'Incoming',
        );

        return view('Report.list')->with($data);
    }
    // End Report

    function changetool() : object {

        $data = array(
            'title' => 'Change Tool',
        );

        return view('Changetool.list')->with($data);

    }

    function sampleqrzoller() : object {
        $data1                  = '1.70.RS002;4;;;;;;2;Reamer 10H8;;130.069;4.996;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;';
        $data2                  = '1.70.DS143;3;;;;;;2;Drill 2.1;;107.444;0.984;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;';
        $data3                  = '1.70.RS002;1;JC547;23;00003';
        $data['Sample 1']       = explode(";",$data1);
        $data['Sample 2']       = explode(";",$data2);
        $data['Sample 3']       = explode(";",$data3);

        // return response()->json($data);

        echo '<pre>';print_r($data);exit;
    }




}
