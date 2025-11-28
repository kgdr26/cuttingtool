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

class RegisController extends Controller
{

    function rholder() : object 
    {
        $holder     = DB::table('mst_holder')->where('is_active',1)->get();
        $maker      = DB::table('mst_maker_tool')->where('is_active',1)->get();
        $material   = DB::table('mst_material')->where('is_active',1)->get();
        $marking    = DB::table('mst_marking_program')->where('is_active',1)->get();
        $unit       = DB::table('mst_unit')->where('is_active',1)->get();

        $data = array(
            'icontitle' => 'registrasi',
            'title'     => 'Registrasi',
            'holder'    => $holder,
            'maker'     => $maker,
            'material'  => $material,
            'marking'   => $marking,
            'unit'      => $unit,
        );
     
        return view('Registrasi.rholder')->with($data);
    }

    function getAllHolderRegis(Request $request) : object 
    {
        $id     = $request->id;
        $arr    = getAllHolderRegis($id);
        
        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);        
    }

    function crudHolderRegis(Request $request): object
    {
        $aksi      = $request->aksi;
        // return response()->json($request->all());
        if($aksi == 'add'){
            try {
                $validatedData = $request->validate([
                    'part_no'               => 'required',
                    'engineering_no'        => 'required',
                    'hes_no'                => 'required',
                    'spesification'         => 'required',
                    'id_holder'             => 'required',
                    'id_maker'              => 'required',
                    'id_material'           => 'required',
                    'id_marking'            => 'required',
                    'id_unit'               => 'required',
                    'price'                 => 'required',
                    'lifetime'              => 'required',
                    'drawing'               => 'required'
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => false, 'message' => $firstError]);
            }

            $data = array(
                'part_no'               => $request->part_no,
                'engineering_no'        => $request->engineering_no,
                'hes_no'                => $request->hes_no,
                'spesification'         => $request->spesification,
                'id_holder'             => $request->id_holder,
                'id_maker'              => $request->id_maker,
                'id_material'           => $request->id_material,
                'id_marking'            => $request->id_marking,
                'id_unit'               => $request->id_unit,
                'price'                 => $request->price,
                'lifetime'              => $request->lifetime,
                'drawing'               => $request->drawing,
                'created_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // upload file to public/holder
            $file               = $request->file('drawing');
            if($file != null && $file != ''){
                $filename           = $file->getClientOriginalName();
                $file->move(public_path('holder'), $filename);
                $data['drawing']    = $filename;
            }else {
                $data['drawing']    = '';
            }
            $insert = DB::table('mst_holder_regis')->insert($data);
            if($insert){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Disimpan',
                );
            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Disimpan',
                );
            }
            return response()->json($all);
        }else if($aksi == 'edit'){
            
            try {
                $validatedData = $request->validate([
                    'id'                    => 'required',
                    'part_no'               => 'required',
                    'engineering_no'        => 'required',
                    'hes_no'                => 'required',
                    'spesification'         => 'required',
                    'id_holder'             => 'required',
                    'id_maker'              => 'required',
                    'id_material'           => 'required',
                    'id_marking'            => 'required',
                    'id_unit'               => 'required',
                    'price'                 => 'required',
                    'lifetime'              => 'required'
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => false, 'message' => $firstError]);
            }


            $id     = $request->id;
            $data = array(
                'part_no'               => $request->part_no,
                'engineering_no'        => $request->engineering_no,
                'hes_no'                => $request->hes_no,
                'spesification'         => $request->spesification,
                'id_holder'             => $request->id_holder,
                'id_maker'              => $request->id_maker,
                'id_material'           => $request->id_material,
                'id_marking'            => $request->id_marking,
                'id_unit'               => $request->id_unit,
                'price'                 => $request->price,
                'lifetime'              => $request->lifetime,
                'drawing'               => $request->drawing,
                'updated_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // upload file to public/holder
            $file               = $request->file('drawing');
            if($file != null){
                $filename           = $file->getClientOriginalName();
                $file->move(public_path('holder'), $filename);
                $data['drawing']    = $filename;
            }else {
                $data['drawing']    = '';
            }

            try {
                $update = DB::table('mst_holder_regis')->where('id', $id)->update($data);
                $all = array(
                    'status'    => true,
                    'message'   => 'Data Berhasil Diupdate',
                );

            } catch (\Throwable $th) {
                $all = array(
                    'status'    => false,
                    'message'   => $th->getMessage(),
                );
            }

           
        }else {
            $id     = $request->id;
            try {
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now()
                );
                try {
                    DB::table('mst_holder_regis')->where('id', $id)->update($data);
                    $arr    = getAllHolderRegis();

                    $all = array(
                        'status'    => true,
                        'message'   => 'Data Berhasil Dihapus',
                        'arr'       => $arr
                    );


                } catch (\Throwable $th) {
                    $all = array(
                        'status'    => false,
                        'message'   => $th->getMessage(),
                    );
                }

            } catch (\Throwable $th) {
                $all = array(
                    'status'    => 'error',
                    'message'   => $th->getMessage(),
                );
            }
        }

        return response()->json($all);
        
    }

    function rtool() : object 
    {
        $tool       = DB::table('mst_tool')->where('is_active',1)->get();
        $maker      = DB::table('mst_maker_tool')->where('is_active',1)->get();
        $material   = DB::table('mst_material')->where('is_active',1)->get();
        $marking    = DB::table('mst_marking_program')->where('is_active',1)->get();
        $unit       = DB::table('mst_unit')->where('is_active',1)->get();

        $data = array(
            'icontitle' => 'registrasi',
            'title'     => 'Registrasi',
            'tool'      => $tool,
            'maker'     => $maker,
            'material'  => $material,
            'marking'   => $marking,
            'unit'      => $unit,
        );
     
        return view('Registrasi.rtool')->with($data);
    }

    function getAllToolRegis(Request $request) : object
    {
        $id     = $request->id;
        $arr    = getAllToolRegis($id);
        
        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);            
    }

    function crudToolRegis(Request $request) : object 
    {
        $aksi      = $request->aksi;
        if($aksi == 'add'){
            $json_regrind = $request->json_regrind;
            $max_indexing = '';
            $max_regrind  = '';
            if($request->judgement == 'regrind'){
                $max_regrind    = $request->max_regrind_indexing;
                $max_indexing   = '0';
                if($json_regrind == ''){
                    $all = array(
                        'status'    => 'error',
                        'message'   => 'Json Regrind Tidak Boleh Kosong',
                    );
                    return response()->json($all);
                }

            }else {
                $max_regrind    = '0';
                $max_indexing   = $request->max_regrind_indexing;
            }
            

            $data = array(
                'part_no'               => $request->part_no,
                'engineering_no'        => $request->engineering_no,
                'hes_no'               => $request->hes_no,
                'spesification'         => $request->spesification,
                'id_tool'               => $request->id_tool,
                'id_maker'              => $request->id_maker,
                'id_material'           => $request->id_material,
                'id_marking'            => $request->id_marking,
                'id_unit'               => $request->id_unit,
                'price'                 => $request->price,
                'replacement'           => $request->replacement,
                'judgement'             => $request->judgement,
                'max_regrind'           => $max_regrind,
                'max_indexing'          => $max_indexing,
                'created_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // $emptyFields = $this->getEmptyFields($data);
            $excludeFields  = ['max_regrind', 'max_indexing'];
            $emptyFields    = $this->getEmptyFields($data, $excludeFields);


            if (!empty($emptyFields)) {
                return response()->json([
                    'message' => 'Some fields are empty',
                    'empty_fields' => $emptyFields,
                    'arr' => $request->all()
                ], 400);
            }           

            // upload file to public/tool
            $file               = $request->file('drawing');
            if($file != null && $file != ''){
                $filename           = $file->getClientOriginalName();
                $file->move(public_path('tool'), $filename);
                $data['drawing']    = $filename;
            }else {
                $data['drawing']    = '';
            }
            $insert = DB::table('mst_tool_regis')->insert($data);
            // get last id
            $last_id = DB::getPdo()->lastInsertId();
            if($json_regrind != ''){
                $id_register_tool = $last_id;
                $eng_no           = '';
                $code             = '';
                $dimension        = $json_regrind;
                $image_add_insp   = $request->image_add_insp;

                $data_regrind = array(
                    'id_register_tool'  => $id_register_tool,
                    'eng_no'            => $eng_no,
                    'code'              => $code,
                    'max_regrind'       => $max_regrind,
                    'image'             => $image_add_insp,
                    'dimension'         => $dimension,
                    'created_at'        => Carbon::now(),
                );

                $insert_regrind = DB::table('mst_regrind_inspection_record')->insert($data_regrind);
            }

            if($insert){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Disimpan',
                );
            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Disimpan',
                );
            }
        }else if($aksi == 'edit'){
            $id             = $request->id;
            $json_regrind   = $request->json_regrind;
            $max_indexing   = '';
            $max_regrind    = '';
            if($request->judgement == 'regrind'){
                $max_regrind    = $request->max_regrind_indexing;
                $max_indexing   = '0';
                if($json_regrind == ''){
                    $all = array(
                        'status'    => 'error',
                        'message'   => 'Json Regrind Tidak Boleh Kosong',
                    );
                    return response()->json($all);
                }
            }else {
                $max_regrind    = '0';
                $max_indexing   = $request->max_regrind_indexing;
            }
            $data = array(
                'part_no'               => $request->part_no,
                'engineering_no'        => $request->engineering_no,
                'hes_no'                => $request->hes_no,
                'spesification'         => $request->spesification,
                'id_tool'               => $request->id_tool,
                'id_maker'              => $request->id_maker,
                'id_material'           => $request->id_material,
                'id_marking'            => $request->id_marking,
                'id_unit'               => $request->id_unit,
                'price'                 => $request->price,
                'replacement'           => $request->replacement,
                'judgement'             => $request->judgement,
                'max_regrind'           => $max_regrind,
                'max_indexing'          => $max_indexing,
                'drawing'               => $request->drawing,
                'updated_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // $emptyFields = $this->getEmptyFields($data);
            $excludeFields  = ['max_regrind', 'max_indexing'];
            $emptyFields    = $this->getEmptyFields($data, $excludeFields);

            // all data must be filled
            if (!empty($emptyFields)) {
                return response()->json([
                    'message'       => 'Some fields are empty',
                    'empty_fields'  => $emptyFields,
                    'arr'           => $request->all()
                ], 400);
            }

            // upload file to public/tool
            $file               = $request->file('drawing');
            if($file != null){
                $filename           = $file->getClientOriginalName();
                $file->move(public_path('tool'), $filename);
                $data['drawing']    = $filename;
            }else {
                $data['drawing']    = '';
            }

            $update = DB::table('mst_tool_regis')->where('id', $id)->update($data);
            if($json_regrind != ''){
                $id_register_tool = $id;
                $eng_no           = '';
                $code             = '';
                $dimension        = $json_regrind;
                $image_edit_insp  = $request->image_edit_insp;

                $data_regrind = array(
                    'id_register_tool'  => $id_register_tool,
                    'eng_no'            => $eng_no,
                    'code'              => $code,
                    'max_regrind'       => $max_regrind,
                    'image'             => $image_edit_insp,
                    'dimension'         => $dimension,
                    'updated_at'        => Carbon::now(),
                    'created_at'        => Carbon::now(),
                );
                // upsert regrind
                $regrind = DB::table('mst_regrind_inspection_record')->where('id_register_tool', $id)->first();
                if($regrind){
                    $update_regrind = DB::table('mst_regrind_inspection_record')->where('id_register_tool', $id)->update($data_regrind);
                }else {
                    $insert_regrind = DB::table('mst_regrind_inspection_record')->insert($data_regrind);
                }
            }
            if($update){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Diupdate',
                    'arr'       => $data
                );
            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Diupdate',
                );
            }
        }else {
            $id     = $request->id;
            try {
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now()
                );
                $delete = DB::table('mst_tool_regis')->where('id', $id)->update($data);
                // delete regrind
                $delete_regrind = DB::table('mst_regrind_inspection_record')->where('id_register_tool', $id)->delete();
                $arr    = getAllToolRegis();
                if($delete){
                    $all = array(
                        'status'    => 'success',
                        'message'   => 'Data Berhasil Dihapus',
                        'arr'       => $arr
                    );
                }else {
                    $all = array(
                        'status'    => 'error',
                        'message'   => 'Data Gagal Dihapus',
                        'arr'       => $arr
                    );
                }
            
            } catch (\Throwable $th) {
                $all = array(
                    'status'    => 'error',
                    'message'   => $th->getMessage(),
                );
            }
        }

        return response()->json($all);
    }

    function getAllRegrindInspectionRecord(Request $request)
    {
        $id     = $request->id;
        $arr    = getAllRegrindInspectionRecord($id);
        
        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'id'        => $id,
            'arr'       => $arr,
        );

        return response()->json($all);                
    }

    function getEmptyFields($data, $exclude = []) {
        $emptyFields = [];
        foreach ($data as $key => $value) {
            if (!in_array($key, $exclude) && ($value === null || $value === '')) {
                $emptyFields[] = $key;
            }
        }
        return $emptyFields;
    }

    function uploadImage(Request $request)
    {
        $file       = $request->file('drawing');
        $lokasi     = $request->lokasi;
        $filename   = $file->getClientOriginalName();
        // if folder not exist, create folder
        if (!file_exists(public_path($lokasi))) {
            mkdir(public_path($lokasi), 0777, true);
        }
        $file->move(public_path($lokasi), $filename);
        return response()->json(['status' => 'success', 'message' => 'Image uploaded', 'filename' => $filename]);
    }
    

    function raccessories() : object 
    {
        $acc        = DB::table('mst_accesories')->where('is_active',1)->get();
        $maker      = DB::table('mst_maker_tool')->where('is_active',1)->get();
        $material   = DB::table('mst_material')->where('is_active',1)->get();
        $unit       = DB::table('mst_unit')->where('is_active',1)->get();

        $data = array(
            'icontitle' => 'registrasi',
            'title'     => 'Registrasi',
            'acc'       => $acc,
            'maker'     => $maker,
            'material'  => $material,
            'unit'      => $unit,
        );
     
        return view('Registrasi.raccessories')->with($data);
    }

    function getAccRegis(Request $request)
    {
        $id     = $request->id;
        $arr    = getAccRegis($id);
        
        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
        );

        return response()->json($all);            
    }

    function crudAccRegis(Request $request)
    {
        $aksi      = $request->aksi;
        if($aksi == 'add'){
            try {
                $validatedData = $request->validate([
                    'part_no'               => 'required',
                    'engineering_no'        => 'required',
                    'hes_no'                => 'required',
                    'spesification'         => 'required',
                    'id_acc'                => 'required',
                    'id_maker'              => 'required',
                    'id_material'           => 'required',
                    'id_unit'               => 'required',
                    'price'                 => 'required',
                    'lifetime'              => 'required',
                    'drawing'               => 'required',
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => false, 'message' => $firstError]);
            }

            $data = array(
                'part_no'               => $request->part_no,
                'engineering_no'        => $request->engineering_no,
                'hes_no'                => $request->hes_no,
                'spesification'         => $request->spesification,
                'id_accesories'         => $request->id_acc,
                'id_maker'              => $request->id_maker,
                'id_material'           => $request->id_material,
                'id_unit'               => $request->id_unit,
                'price'                 => $request->price,
                'lifetime'              => $request->lifetime,
                'drawing'               => $request->drawing,
                'created_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // upload file to public/holder
            $file               = $request->file('drawing');
            if($file != null && $file != ''){
                // get original filename (not encoded filename
                $filename           = $file->getClientOriginalName();
                $filename           = urlencode($filename);
                $file->move(public_path('accessories'), $filename);
                $data['drawing']    = $filename;
            }else {
                $data['drawing']    = '';
            }
            $insert = DB::table('mst_accesories_regis')->insert($data);
            if($insert){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Disimpan',
                );
            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Disimpan',
                );
            }
            return response()->json($all);
        }else if($aksi == 'edit'){
            try {
                $validatedData = $request->validate([
                    'part_no'               => 'required',
                    'engineering_no'        => 'required',
                    'hes_no'                => 'required',
                    'spesification'         => 'required',
                    'id_acc'                => 'required',
                    'id_maker'              => 'required',
                    'id_material'           => 'required',
                    'id_unit'               => 'required',
                    'price'                 => 'required',
                    'lifetime'              => 'required',
                    'drawing'               => 'required',
                ]);
            } catch (ValidationException $e) {
                $errors     = $e->validator->errors();
                $firstError = $errors->first();
                return response()->json(['status' => false, 'message' => $firstError]);
            }

            $id = $request->id;
            $data = array(
                'part_no'               => $request->part_no,
                'engineering_no'        => $request->engineering_no,
                'hes_no'                => $request->hes_no,
                'spesification'         => $request->spesification,
                'id_accesories'         => $request->id_acc,
                'id_maker'              => $request->id_maker,
                'id_material'           => $request->id_material,
                'id_unit'               => $request->id_unit,
                'price'                 => $request->price,
                'lifetime'              => $request->lifetime,
                'drawing'               => $request->drawing,
                'updated_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // upload file to public/holder
            $file               = $request->file('drawing');
            if($file != null){
                $filename           = $file->getClientOriginalName();
                $file->move(public_path('accessories'), $filename);
                $data['drawing']    = $filename;
            }else {
                $data['drawing']    = '';
            }

            $update = DB::table('mst_accesories_regis')->where('id', $id)->update($data);
            if($update){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Diupdate',
                );

            }else {

                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Diupdate',
                );
            }                

        }else {
            $id     = $request->id;
            try {
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now()
                );
                $delete = DB::table('mst_accesories_regis')->where('id', $id)->update($data);
                $arr    = getAccRegis();
                if($delete){
                    $all = array(
                        'status'    => 'success',
                        'message'   => 'Data Berhasil Dihapus',
                        'arr'       => $arr
                    );
                }else {
                    $all = array(
                        'status'    => 'error',
                        'message'   => 'Data Gagal Dihapus',
                        'arr'       => $arr
                    );
                }
            
            } catch (\Throwable $th) {
                $all = array(
                    'status'    => 'error',
                    'message'   => $th->getMessage(),
                );
            }
        }

        return response()->json($all);
        
    }
    
    function rmachine() : object 
    {
        $plant              = DB::table('mst_plant')->where('is_active',1)->get();
        $wct                = DB::table('mst_line')->get();
        $maker_machine      = DB::table('mst_maker_machine')->where('is_active',1)->get();

        // assy_tool_port
        $holder             = DB::table('mst_holder_regis')->where('is_active',1)->get();
        $cutting_tool       = DB::table('mst_tool_regis')->where('is_active',1)->get();
        $accessories        = DB::table('mst_accesories_regis')->where('is_active',1)->get();


        $data = array(
            'icontitle' => 'registrasi',
            'title'     => 'Registrasi',
            'plant'     => $plant,
            'wct'       => $wct,
            'maker_machine' => $maker_machine,
            'holder'    => $holder,
            'cutting_tool' => $cutting_tool,
            'accessories' => $accessories,
        );
     
        return view('Registrasi.rmachine')->with($data);
    }

    function crudMachineRegis(Request $request)
    {
        $aksi      = $request->aksi;
        if($aksi == 'add'){
            $data = array(
                'id_plant'              => $request->id_plant,
                'id_wct'                => $request->id_wct,
                'id_maker_machine'      => $request->id_maker_machine,
                'op_name'               => $request->op_name,
                'created_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // all data must be filled
            if($data['id_plant'] == '' || $data['id_wct'] == '' || $data['id_maker_machine'] == '' || $data['op_name'] == ''){
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Semua Data Harus Diisi',
                );
                return response()->json($all);
            }

            $insert = DB::table('mst_machine_regis')->insert($data);
            if($insert){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Disimpan',
                );
            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Disimpan',
                );
            }
            return response()->json($all);
        }else if($aksi == 'edit'){
            $id = $request->id;
            $data = array(
                'id_plant'              => $request->id_plant,
                'id_wct'                => $request->id_wct,
                'id_maker_machine'      => $request->id_maker_machine,
                'op_name'               => $request->op_name,
                'updated_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // all data must be filled
            if($data['id_plant'] == '' || $data['id_wct'] == '' || $data['id_maker_machine'] == '' || $data['op_name'] == ''){
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Semua Data Harus Diisi',
                );
                return response()->json($all);
                
            }

            $update = DB::table('mst_machine_regis')->where('id', $id)->update($data);
            if($update){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Diupdate',
                );

            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Diupdate',
                );
            }

            return response()->json($all);

        }else {
            $id       = $request->id;
            try {
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now()
                );
                // delete machine register
                $delete                = DB::table('mst_machine_regis')->where('id', $id)->update($data);
                // delete assy tool port
                $delete_assy_tool_port = DB::table('mst_assy_tool_port_regis')->where('id_machine_regis', $id)->delete();
                if($delete){
                    $all = array(
                        'status'    => 'success',
                        'message'   => 'Data Berhasil Dihapus',
                        'arr'       => $arr
                    );
                }else {
                    $all = array(
                        'status'    => 'error',
                        'message'   => 'Data Gagal Dihapus',
                        'arr'       => $arr
                    );
                }
            
            } catch (\Throwable $th) {
                $all = array(
                    'status'    => 'error',
                    'message'   => $th->getMessage(),
                );
            }

            return response()->json($all);
        }
    }

    function getAllMachineRegis(Request $request)
    {
        $id     = $request->id;
        $arr    = getAllMachineRegis($id);
        
        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
            'id'        => $id,
        );

        return response()->json($all);                
    }

    function getAssyToolPort(Request $request)
    {
        $id     = $request->id;
        $arr    = getAssyToolPort($id);
        
        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
            'id'        => $id,
        );

        return response()->json($all);                    
    }

    function getAssyToolPortDetail(Request $request)
    {
        $id    = $request->id;
        $arr   = getAssyToolPortDetail($id);
        
        $all = array(
            'status'    => 'success',
            'message'   => 'Query Success',
            'arr'       => $arr,
            'id'        => $id,
        );

        return response()->json($all);    
    }

    function crudAssyToolPort(Request $request)
    {
        $aksi      = $request->aksi;
        if($aksi == 'add'){
            $data = array(
                'id_machine_regis'      => $request->id_machine_regis,
                'id_holder_regis'       => $request->id_holder_regis,
                'id_cutting_tool_regis' => $request->id_cutting_tool_regis,
                'id_accesories_regis'   => $request->id_accessories_regis,
                'tool_port'             => $request->tool_port,
                'sigma_process'         => $request->sigma_process,
                'macro_address'         => $request->macro_address,
                'min_value'             => $request->min_value,
                'max_value'             => $request->max_value,
                'created_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // all data must be filled
            if($data['id_machine_regis'] == '' ||$data['id_holder_regis'] == '' || $data['id_cutting_tool_regis'] == '' || $data['id_accesories_regis'] == '' || $data['tool_port'] == '' || $data['sigma_process'] == '' || $data['macro_address'] == '' || $data['min_value'] == '' || $data['max_value'] == ''){
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Semua Data Harus Diisi',
                );
                return response()->json($all);
            }

            $insert = DB::table('mst_assy_tool_port_regis')->insert($data);
            if($insert){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Disimpan',
                );
            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Disimpan',
                );
            }
            return response()->json($all);
        }else if($aksi == 'edit'){
            $id = $request->id;
            $data = array(
                // 'id_machine_regis'      => $request->id_machine_regis,
                'id_holder_regis'       => $request->id_holder_regis,
                'id_cutting_tool_regis' => $request->id_cutting_tool_regis,
                'id_accesories_regis'   => $request->id_accessories_regis,
                'tool_port'             => $request->tool_port,
                'sigma_process'         => $request->sigma_process,
                'macro_address'         => $request->macro_address,
                'min_value'             => $request->min_value,
                'max_value'             => $request->max_value,
                'updated_at'            => Carbon::now(),
                'created_by'            => Auth::user()->id,
            );

            // all data must be filled
            if($data['id_holder_regis'] == '' || $data['id_cutting_tool_regis'] == '' || $data['id_accesories_regis'] == '' || $data['tool_port'] == '' || $data['sigma_process'] == '' || $data['macro_address'] == '' || $data['min_value'] == '' || $data['max_value'] == ''){
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Semua Data Harus Diisi',
                );
                return response()->json($all);
            }

            $update = DB::table('mst_assy_tool_port_regis')->where('id', $id)->update($data);
            if($update){
                $all = array(
                    'status'    => 'success',
                    'message'   => 'Data Berhasil Diupdate',
                );

            }else {
                $all = array(
                    'status'    => 'error',
                    'message'   => 'Data Gagal Diupdate',
                );
            }

            return response()->json($all);
        }else {
            $id     = $request->id;
            try {
                $data = array(
                    'is_active' => 0,
                    'updated_at' => Carbon::now()
                );
                $delete = DB::table('mst_assy_tool_port_regis')->where('id', $id)->update($data);
                if($delete){
                    $all = array(
                        'status'    => 'success',
                        'message'   => 'Data Berhasil Dihapus',
                    );
                }else {
                    $all = array(
                        'status'    => 'error',
                        'message'   => 'Data Gagal Dihapus',
                    );
                }
            
            } catch (\Throwable $th) {
                $all = array(
                    'status'    => 'error',
                    'message'   => $th->getMessage(),
                );
            }

            return response()->json($all);
            
        }
        
    }

    function tesRegis()
    {
        $id  = 2;
        $arr = getAssyToolPort($id);

        echo '<pre>';print_r($arr);die;

    }

}
