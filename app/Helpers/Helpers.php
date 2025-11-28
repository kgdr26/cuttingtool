<?php

    if (!function_exists('ArForm')) {
        function ArForm($arr, $idkey){
            if (! $arr) return array();
            if (! is_array($arr)) return array();
            if (count($arr) == 0) return array();
            $str = array();
            foreach($arr as $row) $str[ $row[$idkey] ] = $row;
            return $str;
        }
    }

    function customTanggal($date,$date_format){
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
    }

    function ToArr($value,$idkey){
        $data = json_decode(json_encode($value), true);
        $data = ArForm($data,$idkey);

        return $data;

    }

    function browse( $arr ) {
        if (count($arr) > 0) {
            $hasil  = "<table style='font-size: 80%; border: 1px solid grey;' cellpadding='0px' cellspacing='0px'>";
            $hasil .= "<thead><tr><th style='border: 1px solid grey'>". implode("</th><th style='border: 1px solid grey'>", array_keys(current($arr))) ."</th></tr></thead><tbody>";

            foreach ($arr as $row){
                array_map('htmlentities', $row);
                $hasil .= "<tr><td style='border: 1px solid grey'>". implode("</td><td style='border: 1px solid grey'>", $row) ."</td></tr>";
            }

            $hasil .= "</tbody></table>";
        }
        echo $hasil;
        return;
    }

    function arrayfromdate($start,$end){
        $begin 	    = new DateTime($start);
        $end 	    = new DateTime($end);
        $end 	    = $end->modify( '+1 day' );

        $interval   = new DateInterval('P1D');
        $daterange  = new DatePeriod($begin, $interval ,$end);


        foreach($daterange as $date){
            $val = $date->format("Y-m-d");
            $jdl = $date->format("d");
            $hr  = $date->format("D");
            $m   = $date->format("m");
            if($hr == 'Sat' || $hr == 'Sun'){
                $sun = 1;
            }else {
                $sun = 0;
            }
            $arr[] = array('time'=>$val,'judul'=>$jdl,'hr'=>$hr,'sun'=>$sun, 'water_consumption'=>0,'total_breakdown'=>0,'total_freq'=>0,'total_freq_mtbf'=>0,'total_waktu_mtbf'=>0,'dt'=>0,'dc'=>0,'mc'=>0,'fg'=>0,'std'=>2200, 'jumlah_hari'=>0,'bln'=>$m);

        }
        $arr = ToArr($arr,'time');

        return $arr;
    }

    function keArr($value){
        $data = json_decode(json_encode($value), true);

        return $data;

    }

    function InVar($arr, $kode) {
        $in = "in (";
        foreach ($arr as $row) {
            if (trim($row[$kode])!='') {
            if ( !strpos($in, $row[$kode]) ) $in .= "'$row[$kode]'";
            }
        }
        $in = str_replace("''", "','", $in) .")";
        return $in;
    }

    function stdToArray($obj){
        $reaged = (array)$obj;
        foreach($reaged as $key => &$field){
        if(is_object($field))$field = stdToArray($field);
        }
        return $reaged;
    }

    function ConvArr(Type $var = null){
        $data = DB::connection()->getPdo()
        ->query("SELECT * FROM users ")
        ->fetchAll(\PDO::FETCH_ASSOC);
    }

    function array_index($a, $subkey) {
        if (count($a) == 0) return array();
        foreach($a as $k=>$v) $b[$k] = strtolower($v[$subkey]);
        asort($b);
        foreach($b as $key=>$val) $c[] = $a[$key];
        return $c;
    }

    function array_flatten($array) {
        if (!is_array($array)) {
        return FALSE;
        }
        $result = array();
        foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        }
        else {
            $result[$key] = $value;
        }
        }
        return $result;
    }

    function helper_shift(){
        $timenow   		= strtotime(date("Y-m-d H:i:s"));
        $tglnow 		= date("Y-m-d");
        $tglnex         = date('Y-m-d',strtotime("+1 days"));
        $timenowdate    = date("Y-m-d H:i:s");

        $shift1a 		= strtotime(date("$tglnow 07:00:00"));
        $shift1b 		= strtotime(date("$tglnow 15:59:59"));

        $shift2a 		= strtotime(date("$tglnow 16:00:00"));
        $shift2b 		= strtotime(date("$tglnow 23:59:59"));

        $shift3a 		= strtotime(date("$tglnow 00:00:00"));
        $shift3b 		= strtotime(date("$tglnex 06:59:59"));

        if($timenow >= $shift1a && $timenow <= $shift1b) {
            $data['shift'] 					= 1;
            $data['selisihawalshift'] 		= $timenow-$shift1a;
            $data['mulaisfhit']				= $shift1a;
            $data['realtime']  				= $timenow;
            $data['selisihakhirshift'] 		= $shift1b - $timenow;
            $data['selesaishift'] 			= $shift1b;
            $data['lamashift']            	= $shift1b - $shift1a;
            $data['realjam'] 				= $timenowdate;
        }elseif($timenow >= $shift2a && $timenow <= $shift2b){
            $data['shift']  				= 2;
            $data['selisihawalshift'] 		= $timenow-$shift2a;
            $data['mulaisfhit']				= $shift2a;
            $data['realtime']  				= $timenow;
            $data['selisihakhirshift'] 		= $shift2b - $timenow;
            $data['selesaishift'] 			= $shift2b;
            $data['lamashift']            	= $shift2b - $shift2a;
            $data['realjam'] 				= $timenowdate;

        }elseif($timenow >= $shift3a && $timenow <= $shift3b) {
            $data['shift']  				= 3;
            $data['selisihawalshift'] 		= $timenow-$shift3a;
            $data['mulaisfhit']				= $shift3a;
            $data['realtime']  				= $timenow;
            $data['selisihakhirshift'] 		= $shift3b - $timenow;
            $data['selesaishift'] 			= $shift3b;
            $data['lamashift']            	= $shift3b - $shift3a;
            $data['realjam'] 				= $timenowdate;

        }else {
            $data['shift']	 				= 'wrong realtime parameter !';
            $ddata['selisihawalshift'] 		= 'wrong time different';
        }

        return $data;
    }

    function get_shift($time,$tglnow,$tglnex){
        $timenow   		= strtotime(date($time));
        // $tglnow 		= date("Y-m-d");
        // $tglnex         = date('Y-m-d',strtotime("+1 days"));

        $shift1a 		= strtotime(date("$tglnow 07:00:00"));
        $shift1b 		= strtotime(date("$tglnow 15:59:59"));

        $shift2a 		= strtotime(date("$tglnow 16:00:00"));
        $shift2b 		= strtotime(date("$tglnow 23:59:59"));

        $shift3a 		= strtotime(date("$tglnow 00:00:00"));
        $shift3b 		= strtotime(date("$tglnex 06:59:59"));

        if($timenow >= $shift1a && $timenow <= $shift1b) {
            $data['shift'] 					= 1;
        }elseif($timenow >= $shift2a && $timenow <= $shift2b){
            $data['shift']  				= 2;

        }elseif($timenow >= $shift3a && $timenow <= $shift3b) {
            $data['shift']  				= 3;

        }else {
            $data['shift']	 				= 'wrong realtime parameter !';
            $ddata['selisihawalshift'] 		= 'wrong time different';
        }

        return $data;
    }

    function getAllPlant($id = null)
    {
        if($id == null){
            $arr    = DB::table('mst_plant')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData = json_encode($row);
                    $jsonData = str_replace('"', "'", $jsonData);
                    $i     = $key + 1;
                    $html .= '<tr>';
                    $html .= '<td>'.$i.'</td>';
                    $html .= '<td>'.$row->id_plant.'</td>';
                    $html .= '<td>'.$row->plant_name.'</td>';
                    $html .= '<td>'.$row->plant_description.'</td>';
                    $html .= '<td>';
                    $html .= '<div class="d-flex justify-content-center">';
                    $html .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_plant.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_plant')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllLine($id = null)
    {
        if($id == null){
            $arr = DB::select("SELECT a.*, b.plant_name FROM mst_line a LEFT JOIN mst_plant b ON a.id_plant = b.id WHERE a.is_active = '1'");

            // get plant name
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData = json_encode($row);
                    $jsonData = str_replace('"', "'", $jsonData);
                    $i     = $key + 1;
                    $html .= '<tr>';
                    $html .= '<td>'.$i.'</td>';
                    $html .= '<td>'.$row->id_wct.'</td>';
                    $html .= '<td>'.$row->id_plant.'</td>';
                    $html .= '<td>'.$row->line_name.'</td>';
                    $html .= '<td>';
                    $html .= '<div class="d-flex justify-content-center">';
                    $html .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_wct.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_line')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllModel($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_model')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData = json_encode($row);
                    $jsonData = str_replace('"', "'", $jsonData);
                    $i     = $key + 1;
                    $html .= '<tr>';
                    $html .= '<td>'.$i.'</td>';
                    $html .= '<td>'.$row->id_model.'</td>';
                    $html .= '<td>'.$row->model_name.'</td>';
                    $html .= '<td>';
                    $html .= '<div class="d-flex justify-content-center">';
                    $html .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_model.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_model')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllPart($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_part')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData = json_encode($row);
                    $jsonData = str_replace('"', "'", $jsonData);
                    $i     = $key + 1;
                    $html .= '<tr>';
                    $html .= '<td>'.$i.'</td>';
                    $html .= '<td>'.$row->id_part.'</td>';
                    $html .= '<td>'.$row->part_name.'</td>';
                    $html .= '<td>';
                    $html .= '<div class="d-flex justify-content-center">';
                    $html .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_part.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html .= '</div>';
                    $html .= '</td>';
                    $html .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_part')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllHolder($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_holder')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->id_holder.'</td>';
                    $html       .= '<td>'.$row->holder_type.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_holder.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_holder')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllTool($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_tool')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->id_tool.'</td>';
                    $html       .= '<td>'.$row->tool_type.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_tool.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_tool')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllMaterial($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_material')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->id_material.'</td>';
                    $html       .= '<td>'.$row->material_type.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_material.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_material')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllAcc($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_accesories')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->id_accesories.'</td>';
                    $html       .= '<td>'.$row->accesories_type.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_accesories.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_accesories')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllBat($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_bat')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->bat_desc.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->bat_desc.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_bat')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllTol($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_tolerance')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->id_tolerance.'</td>';
                    $html       .= '<td>'.$row->tolerance_type.'</td>';
                    $html       .= '<td>'.$row->tolerance_length.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_tolerance.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_tolerance')->where('id',$id)->get();

            return $arr;
        }

    }

    function getAllMaker($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_maker_tool')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->id_maker.'</td>';
                    $html       .= '<td>'.$row->maker_name.'</td>';
                    $html       .= '<td>'.$row->suplier_name.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->maker_name.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_maker_tool')->where('id',$id)->first();

            return $arr;
        }

    }

    function getAllMakerMachine($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_maker_machine')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->id_maker_machine.'</td>';
                    $html       .= '<td>'.$row->machine_name.'</td>';
                    $html       .= '<td>'.$row->suplier_name.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->id_maker_machine.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_maker_machine')->where('id',$id)->first();

            return $arr;
        }
    }

    function getAllMachineRegrind($id = null)
    {
        if($id == null){
            $arr    = DB::table('mst_machine_regrind')->where('is_active',true)->get();
            // join with mst_plant
            $arr    = DB::select("SELECT a.*, b.plant_name FROM mst_machine_regrind a LEFT JOIN mst_plant b ON a.id_plant = b.id WHERE a.is_active = '1'");
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->plant_name.'</td>';
                    $html       .= '<td>'.$row->no_asset.'</td>';
                    $html       .= '<td>'.$row->machine_regrind.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->machine_regrind.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_machine_regrind')->where('id',$id)->first();

            return $arr;
        }
    }

    function getAllMarkingProgram($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_marking_program')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->program_no.'</td>';
                    $html       .= '<td>'.$row->description.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->program_no.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_marking_program')->where('id',$id)->first();

            return $arr;
        }
    }

    function getAllUnit($id = null)
    {
        if($id == null){
            $arr = DB::table('mst_unit')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->description.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->description.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_unit')->where('id',$id)->first();

            return $arr;
        }
    }

    function getAllHolderRegis($id = null)
    {
        // reff mst_tool
        $holder   = DB::table('mst_holder')->get();
        $holder   = ToArr($holder,'id');
        // reff mst_mmaker
        $maker  = DB::table('mst_maker_tool')->get();
        $maker  = ToArr($maker,'id');
        // reff mst_material
        $material = DB::table('mst_material')->get();
        $material = ToArr($material,'id');
        // ref markin program
        $marking = DB::table('mst_marking_program')->get();
        $marking = ToArr($marking,'id');
        // ref mst_unit
        $unit   = DB::table('mst_unit')->get();
        $unit   = ToArr($unit,'id');
        // ref mst_unit
        $unit   = DB::table('mst_unit')->get();
        $unit   = ToArr($unit,'id');

        if($id == null){
            $arr    = DB::table('mst_holder_regis')->where('is_active',true)->get();
            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    if(array_key_exists($row->id_holder, $holder)){
                        $nmholder = $holder[$row->id_holder]['holder_type'];
                    }
                    if(array_key_exists($row->id_maker, $maker)){
                        $nmmaker = $maker[$row->id_maker]['maker_name'];
                    }
                    if(array_key_exists($row->id_material, $material)){
                        $nmmaterial = $material[$row->id_material]['material_type'];
                    }
                    if(array_key_exists($row->id_marking, $marking)){
                        $nmmarking = $marking[$row->id_marking]['program_no'];
                    }

                    // check if file drawing exist
                    $file       = public_path('holder/'.$row->drawing);
                    $cssDrawing = 'text-success';
                    if(!file_exists($file)){
                        $cssDrawing = 'text-danger';
                    }

                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->part_no.'</td>';
                    $html       .= '<td>'.$row->engineering_no.'</td>';
                    $html       .= '<td>'.$row->hes_no.'</td>';
                    $html       .= '<td>'.$row->spesification.'</td>';
                    $html       .= '<td>'.$nmholder.'</td>';
                    $html       .= '<td>'.$nmmaker.'</td>';
                    $html       .= '<td>'.$nmmaterial.'</td>';
                    $html       .= '<td>'.$nmmarking.'</td>';
                    $html       .= '<td>'.$row->price.'</td>';
                    $html       .= '<td>'.$row->lifetime.'</td>';
                    // download file
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<a href="'.url('holder/'.$row->drawing).'" class="btn btn-icon-download '.$cssDrawing.'" type="button" data-item="'.$row->id.'" data-name="download" download><i class="bi bi-download"></i></a>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->part_no.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }
            return $html;
        }else {

            $arr            = DB::table('mst_holder_regis')->where('id',$id)->first();
            $id_holder      = $arr->id_holder;
            $id_material    = $arr->id_material;
            $id_marking     = $arr->id_marking;

            $arr->holder_type     = $holder[$id_holder]['holder_type'];
            $arr->marking_program = $marking[$id_marking]['program_no'];
            $arr->material_type   = $material[$id_material]['material_type'];

            return $arr;
        }
    }

    function getAllToolRegis($id = null)
    {
        // reff mst_tool
        $tool   = DB::table('mst_tool')->get();
        $tool   = ToArr($tool,'id');
        // reff mst_mmaker
        $maker  = DB::table('mst_maker_tool')->get();
        $maker  = ToArr($maker,'id');
        // reff mst_material
        $material = DB::table('mst_material')->get();
        $material = ToArr($material,'id');
        // ref markin program
        $marking = DB::table('mst_marking_program')->get();
        $marking = ToArr($marking,'id');
        // ref mst_unit
        $unit   = DB::table('mst_unit')->get();
        $unit   = ToArr($unit,'id');
        // ref mst_unit
        $unit   = DB::table('mst_unit')->get();
        $unit   = ToArr($unit,'id');

        if($id == null){
            $arr    = DB::table('mst_tool_regis')->where('is_active',true)->get();

            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    if(array_key_exists($row->id_tool, $tool)){
                        $nmtool = $tool[$row->id_tool]['tool_type'];
                    }
                    if(array_key_exists($row->id_maker, $maker)){
                        $nmmaker = $maker[$row->id_maker]['maker_name'];
                    }
                    if(array_key_exists($row->id_material, $material)){
                        $nmmaterial = $material[$row->id_material]['material_type'];
                    }
                    if(array_key_exists($row->id_marking, $marking)){
                        $nmmarking = $marking[$row->id_marking]['program_no'];
                    }

                    // check if file drawing exist
                    $file       = public_path('tool/'.$row->drawing);
                    $cssDrawing = 'text-success';
                    if(!file_exists($file)){
                        $cssDrawing = 'text-danger';
                    }
                    if($row->judgement == 'regrind'){
                        $regrind_indexing = '<td>'.$row->max_regrind.'</td>';
                    }else {
                        $regrind_indexing = '<td>'.$row->max_indexing.'</td>';
                    }

                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->part_no.'</td>';
                    $html       .= '<td>'.$row->engineering_no.'</td>';
                    $html       .= '<td>'.$row->hes_no.'</td>';
                    $html       .= '<td>'.$row->spesification.'</td>';
                    $html       .= '<td>'.$nmtool.'</td>';
                    $html       .= '<td>'.$nmmaker.'</td>';
                    $html       .= '<td>'.$nmmaterial.'</td>';
                    $html       .= '<td>'.$nmmarking.'</td>';
                    $html       .= '<td>'.$row->price.'</td>';
                    $html       .= '<td>'.$row->replacement.'</td>';
                    $html       .= '<td>'.$row->judgement.'</td>';
                    $html       .= $regrind_indexing;
                    // download file
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<a href="'.url('tool/'.$row->drawing).'" class="btn btn-icon-download '.$cssDrawing.'" type="button" data-item="'.$row->id.'" data-name="download" download><i class="bi bi-download"></i></a>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->part_no.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;

        }else {
            $arr        = DB::table('mst_tool_regis')->where('id',$id)->first();
            $regrind    = DB::table('mst_regrind_inspection_record')->where('id_register_tool',$id)->first();
            $arr->tool_type      = $tool[$arr->id_tool]['tool_type'];
            $arr->material_type  = $material[$arr->id_material]['material_type'];
            $arr->marking        = $marking[$arr->id_marking]['program_no'];

            return array('tool' => $arr, 'regrind' => $regrind);
        }
    }

    function getAllRegrindInspectionRecord($id)
    {
        $arr    = DB::table('mst_regrind_inspection_record')->where('id_register_tool',$id)->first();

        return $arr;

    }

    function getAccRegis($id = null)
    {
        if($id == null){
            $arr    = DB::table('mst_accesories_regis')->where('is_active',true)->get();

            // reff mst_tool
            $acc    = DB::table('mst_accesories')->get();
            $acc    = ToArr($acc,'id');
            // reff mst_mmaker
            $maker  = DB::table('mst_maker_tool')->get();
            $maker  = ToArr($maker,'id');
            // reff mst_material
            $material = DB::table('mst_material')->get();
            $material = ToArr($material,'id');
            // ref mst_unit
            $unit   = DB::table('mst_unit')->get();
            $unit   = ToArr($unit,'id');

            $html   = '';
            if(count($arr) > 0){
                foreach ($arr as $key => $row) {
                    if(array_key_exists($row->id_accesories, $acc)){
                        $nmacc = $acc[$row->id_accesories]['accesories_type'];
                    }
                    if(array_key_exists($row->id_maker, $maker)){
                        $nmmaker = $maker[$row->id_maker]['maker_name'];
                    }
                    if(array_key_exists($row->id_material, $material)){
                        $nmmaterial = $material[$row->id_material]['material_type'];
                    }
                    if(array_key_exists($row->id_unit, $unit)){
                        $nmunit = $unit[$row->id_unit]['description'];
                    }

                    // check if file drawing exist
                    $file       = public_path('accessories/'.$row->drawing);
                    $cssDrawing = 'text-success';
                    if(!file_exists($file)){
                        $cssDrawing = 'text-danger';
                    }
                    $html      .= '<tr>';
                    $html      .= '<td>'. ($key + 1) .'</td>';
                    $html      .= '<td>'.$row->part_no.'</td>';
                    $html      .= '<td>'.$row->engineering_no.'</td>';
                    $html      .= '<td>'.$row->hes_no.'</td>';
                    $html      .= '<td>'.$row->spesification.'</td>';
                    $html      .= '<td>'.$nmacc.'</td>';
                    $html      .= '<td>'.$nmmaker.'</td>';
                    $html      .= '<td>'.$nmmaterial.'</td>';
                    // $html      .= '<td>'.$nmunit.'</td>';
                    $html      .= '<td>'.$row->price.'</td>';
                    $html      .= '<td>'.$row->lifetime.'</td>';
                    // download file
                    $html      .= '<td>';
                    $html      .= '<div class="d-flex justify-content-center">';
                    $html      .= '<a href="'.url('accessories/'.$row->drawing).'" class="btn btn-icon-download '.$cssDrawing.'" type="button" data-item="'.$row->id.'" data-name="download" download><i class="bi bi-download"></i></a>';
                    $html      .= '</div>';
                    $html      .= '</td>';
                    $html      .= '<td>';
                    $html      .= '<div class="d-flex justify-content-center">';
                    $html      .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html      .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->part_no.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html      .= '</div>';
                    $html      .= '</td>';
                    $html      .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';

            }

            return $html;
        }else {
            $arr = DB::table('mst_accesories_regis')->where('id',$id)->first();

            return $arr;
        }
    }

    function getAllMachineRegis($id = null)
    {
        if($id == null){
            $arr    = DB::table('mst_machine_regis')->where('is_active',true)->get();

            $plant  = DB::table('mst_plant')->get();
            $plant  = ToArr($plant,'id');

            $wct    = DB::table('mst_line')->get();
            $wct    = ToArr($wct,'id');

            $maker  = DB::table('mst_maker_machine')->get();
            $maker  = ToArr($maker,'id');

            $html   = '';
            if(count($arr) > 0){
                foreach ($arr as $key => $row) {
                    if(array_key_exists($row->id_plant, $plant)){
                        $nmplant = $plant[$row->id_plant]['plant_name'];
                    }
                    if(array_key_exists($row->id_wct, $wct)){
                        $nmwct = $wct[$row->id_wct]['line_name'];
                    }
                    if(array_key_exists($row->id_maker_machine, $maker)){
                        $nmmaker = $maker[$row->id_maker_machine]['machine_name'];
                    }

                    $html      .= '<tr class="click_machine" data-item='.$row->id.' data-arr="'.$row->op_name.'">';
                    $html      .= '<td>'. ($key + 1) .'</td>';
                    $html      .= '<td>'.$nmplant.'</td>';
                    $html      .= '<td>'.$nmwct.'</td>';
                    $html      .= '<td>'.$row->op_name.'</td>';
                    $html      .= '<td>'.$nmmaker.'</td>';
                    $html      .= '<td>';
                    $html      .= '<div class="d-flex justify-content-center">';
                    $html      .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html      .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->op_name.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html      .= '</div>';
                    $html      .= '</td>';
                    $html      .= '</tr>';
                }

                return $html;
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
                return $html;
            }
        }else {
            $arr = DB::table('mst_machine_regis')->where('id',$id)->first();

            return $arr;
        }
    }

    function getAssyToolPort($id)
    {

        $arr = DB::table('mst_assy_tool_port_regis')->where('id_machine_regis',$id)->where('is_active',1)->get();

        // ref cutting tool regis
        $cutting = DB::table('mst_tool_regis')->get();
        $cutting = ToArr($cutting,'id');

        // ref holder regis
        $holder = DB::table('mst_holder_regis')->get();
        $holder = ToArr($holder,'id');

        // ref accessories regis
        $acc = DB::table('mst_accesories_regis')->get();
        $acc = ToArr($acc,'id');

        $html = '';
        foreach ($arr as $key => $row) {
            // hitung jumlah cutting tool,holder,accessories
            $arrCutting   = explode(',', $row->id_cutting_tool_regis);
            $countCutting = count($arrCutting);

            $arrHolder   = explode(',', $row->id_holder_regis);
            $countHolder = count($arrHolder);

            $arrAcc      = explode(',', $row->id_accesories_regis);
            $countAcc    = count($arrAcc);

            $numrowPort  = $countCutting + 1 + 1 + $countAcc;//holder + accessories + total price masing2 1

			$totalPriceCutting = 0;
           foreach ($arrCutting as $a => $b) {
				if($a == 0){
					$html .= '<tr class="bg-1">';
					$html .= '<td class="text-center align-middle" rowspan="'.$numrowPort.'">'.$row->tool_port.'</td>';
					$html .= '<td class="text-center align-middle" rowspan="'.$countCutting.'">Cutting Tool</td>';
					$html .= '<td class="text-center align-middle">'.$cutting[$b]['spesification'].'</td>';
					$html .= '<td class="text-center align-middle">Rp. '.number_format($cutting[$b]['price'],0,',','.').'</td>';
					$html .= '<td class="text-center align-middle" rowspan="'.$numrowPort.'">'.$row->sigma_process.'</td>';
					$html .= '<td class="text-center align-middle" rowspan="'.$numrowPort.'">'.$row->macro_address.'</td>';
					$html .= '<td class="text-center align-middle" rowspan="'.$numrowPort.'">'.$row->min_value .'/'. $row->max_value.'</td>';
					$html .= '<td class="text-center align-middle" rowspan="'.$numrowPort.'">';
					$html .= '<div class="d-flex justify-content-center">';
					$html .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit_assy"><i class="bi bi-pencil-square"></i></button>';
					$html .= '<button class="btn btn-icon-delete" type="button" data-arr="'.$row->tool_port.'" data-item="'.$row->id.'" data-name="delete_assy"><i class="bi bi-trash-fill"></i></button>';
					$html .= '</div>';
					$html .= '</td>';
					$html .= '</tr>';
				}else {
					$html .= '<tr class="bg-1">';
					$html .= '<td class="text-center align-middle">'.$cutting[$b]['spesification'].'</td>';
					$html .= '<td class="text-center align-middle">Rp. '.number_format($cutting[$b]['price'],0,',','.').'</td>';
					$html .= '</tr>';
				}

				// sum the price
				$totalPriceCutting += $cutting[$b]['price'];
           }

		    $totalPriceHolder = $holder[$row->id_holder_regis]['price'];
			$html .= '<tr class="bg-1">';
			$html .= '<td class="text-center align-middle" rowspan="'.$countHolder.'">Holder</td>';
			$html .= '<td class="text-center align-middle">'.$holder[$row->id_holder_regis]['spesification'].'</td>';
			$html .= '<td class="text-center align-middle">Rp. '.number_format($holder[$row->id_holder_regis]['price'],0,',','.').'</td>';
			$html .= '</tr>';

			// accessories
			$allAcc = '';
			$totalPriceAcc = 0;
			foreach ($arrAcc as $key => $value) {
				// get name accessories
				$nmAcc = $acc[$value]['spesification'];
				$price = $acc[$value]['price'];

                if($key == 0){
                    $html .= '<tr class="bg-1">';
                    $html .= '<td class="text-center align-middle" rowspan="'.$countAcc.'">Accessories</td>';
                    $html .= '<td class="text-center align-middle">'.$nmAcc.'</td>';
                    $html .= '<td class="text-center align-middle">Rp. '.number_format($price,0,',','.').'</td>';
                    $html .= '</tr>';
                }else {
                    $html .= '<tr class="bg-1">';
                    $html .= '<td class="text-center align-middle">'.$nmAcc.'</td>';
                    $html .= '<td class="text-center align-middle">Rp. '.number_format($price,0,',','.').'</td>';
                    $html .= '</tr>';
                }

				$totalPriceAcc += $price;
			}

			$totalPrice = $totalPriceCutting + $totalPriceHolder + $totalPriceAcc;

			$html .= '<tr class="bg-1">';
			$html .= '<td class="text-center align-middle" colspan="2">Total PRICE</td>';
			$html .= '<td class="text-center align-middle">Rp. '.number_format($totalPrice,0,',','.').'</td>';
			$html .= '</tr>';

        }

		return $html;
    }

    function getAssyToolPortDetail($id)
    {
        $arr = DB::table('mst_assy_tool_port_regis')->where('id',$id)->first();

        return $arr;
    }

    function getMachineList($id = null)
    {
        if($id == null){
            $arr    = DB::table('mst_list_machine')->where('is_active',true)->get();
            // ref plant
            $plant  = DB::table('mst_plant')->get();
            $plant  = ToArr($plant,'id');

            // ref wct
            $wct    = DB::table('mst_line')->get();
            $wct    = ToArr($wct,'id');

            // ref op_name
            $machine_regis     = DB::table('mst_machine_regis')->get();
            $machine_regis     = ToArr($machine_regis,'id');

            // ref maker machine
            $maker_machine     = DB::table('mst_maker_machine')->get();
            $maker_machine     = ToArr($maker_machine,'id');

            $html   = '';
            if(count($arr) > 0){
                foreach ($arr as $key => $row) {
                    $id_machine_regis = $row->id_machine_regis;
                    $dat = DB::table('mst_machine_regis')->where('id',$id_machine_regis)->first();
                    $id_plant = $dat->id_plant;
                    $id_wct   = $dat->id_wct;
                    $id_maker_machine = $dat->id_maker_machine;

                    if(array_key_exists($id_plant, $plant)){
                        $nmplant = $plant[$id_plant]['id_plant'];
                    }

                    if(array_key_exists($id_wct, $wct)){
                        $nmwct = $wct[$id_wct]['id_wct'];
                    }

                    if(array_key_exists($row->id_machine_regis, $machine_regis)){
                        $nmop = $machine_regis[$row->id_machine_regis]['op_name'];
                    }

                    if(array_key_exists($id_maker_machine, $maker_machine)){
                        $nmaker = $maker_machine[$id_maker_machine]['suplier_name'];
                    }

                    $i           = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$nmplant.'</td>';
                    $html       .= '<td>'.$nmwct.'</td>';
                    $html       .= '<td>'.$nmop.'</td>';
                    $html       .= '<td>'.$nmaker.'</td>';
                    $html       .= '<td>'.$row->asset_id.'</td>';
                    $html       .= '<td>'.$row->machine_name.'</td>';
                    $html       .= '<td>'.$row->ip_address.'</td>';
                    $html       .= '<td>'.$row->port.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    $html       .= '<button class="btn btn-icon-edit" type="button" data-item="'.$row->id.'" data-name="edit"><i class="bi bi-pencil-square"></i></button>';
                    $html       .= '<button class="btn btn-icon-delete" type="button" data-item="'.$row->id.'" data-arr="'.$row->machine_name.'" data-name="delete"><i class="bi bi-trash-fill"></i></button>';
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {
            $arr = DB::table('mst_list_machine')->where('id',$id)->first();
            // getmachine regis
            $id_machine_regis = $arr->id_machine_regis;
            $dat = DB::table('mst_machine_regis')->where('id',$id_machine_regis)->first();
            $id_plant = $dat->id_plant;
            $id_wct   = $dat->id_wct;

            $resp = array('list' => $arr, 'machine' => $dat, 'id_plant' => $id_plant, 'id_wct' => $id_wct);

            return $resp;
        }
    }

    function getAllMarkingHolder($id = null)
    {
        if($id == null){
            $arr    = DB::table('mst_holder_regis')->where('is_active',1)->get();
            // echo '<pre>';print_r($arr);exit;
            // reff mst_holder
            $holder = DB::table('mst_holder')->get();
            $holder = ToArr($holder,'id');
            // reff mst_mmaker
            $maker  = DB::table('mst_maker_tool')->get();
            $maker  = ToArr($maker,'id');
            // reff mst_material
            $material = DB::table('mst_material')->get();
            $material = ToArr($material,'id');
            // ref markin program
            $marking = DB::table('mst_marking_program')->get();
            $marking = ToArr($marking,'id');
            // ref mst_unit
            $unit   = DB::table('mst_unit')->get();
            $unit   = ToArr($unit,'id');
            // ref mst_unit
            $unit   = DB::table('mst_unit')->get();
            $unit   = ToArr($unit,'id');

            // echo '<pre>';print_r($arr);die;
            $html   = '';
            if(count($arr) > 0){
                foreach ($arr as $key => $row) {
                    // echo $row->id_holder;exit;
                    // get count from mst_marking_holder
                    $count = DB::table('mst_marking_holder')->where('is_active',1)->where('status_qr_code',1)->where('id_holder_register',$row->id)->count();
                    // check the latest status of marking holder
                    $latest = DB::table('mst_marking_holder')->where('is_active',1)->where('id_holder_register',$row->id)->orderBy('id','desc')->first();
                    if(empty($latest)){
                        $status = 'execute';
                        $qr_code = '';
                    }else {
                        $status = $latest->status_qr_code;
                        if($status == 1){
                            $status = 'execute';
                            $qr_code = $latest->qr_code;
                        }else {
                            $status = 'verify';
                            $qr_code = $latest->qr_code;
                        }
                    }
                    // $status = $latest->status_qr_code;
                    // // echo $status;exit;
                    // if($status == 1){
                    //     $status = 'execute';
                    //     $qr_code = $latest->qr_code;
                    // }else {
                    //     $status = 'verify';
                    //     $qr_code = $latest->qr_code;
                    // }

                    if(array_key_exists($row->id_holder, $holder)){
                        $nmholder = $holder[$row->id_holder]['holder_type'];
                    }
                    if(array_key_exists($row->id_maker, $maker)){
                        $nmmaker = $maker[$row->id_maker]['maker_name'];
                    }
                    if(array_key_exists($row->id_material, $material)){
                        $nmmaterial = $material[$row->id_material]['material_type'];
                    }
                    if(array_key_exists($row->id_marking, $marking)){
                        $nmmarking = $marking[$row->id_marking]['program_no'];
                    }

                    // check if file drawing exist
                    $file       = public_path('holder/'.$row->drawing);
                    $cssDrawing = 'text-success';
                    if(!file_exists($file)){
                        $cssDrawing = 'text-danger';
                    }

                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->part_no.'</td>';
                    $html       .= '<td>'.$row->engineering_no.'</td>';
                    $html       .= '<td>'.$row->hes_no.'</td>';
                    $html       .= '<td>'.$row->spesification.'</td>';
                    $html       .= '<td>'.$nmholder.'</td>';
                    $html       .= '<td>'.$nmmaterial.'</td>';
                    $html       .= '<td>'.$nmmarking.'</td>';
                    $html       .= '<td>'.$count.'</td>';
                    $html       .= '<td>'.$row->lifetime.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    if($status == 'execute'){
                    $html       .= '<button class="btn btn-execute" data-name="execute" data-item="'.$row->id.'"><i class="bi bi-caret-right-fill"></i>Execute</button>';
                    }
                    if($status == 'verify'){
                    $html       .= '<button class="btn btn-verify" data-name="verify" data-arr="'.$qr_code.'" data-item="'.$row->id.'"><i class="bi bi-caret-right-fill"></i>Verify</button>';
                    }
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {

        }
    }

    function getAllMarkingTool($id = null)
    {
        if($id == null){
            $arr    = DB::table('mst_tool_regis')->where('is_active',true)->get();
            // echo '<pre>';print_r($arr);die;
            // reff mst_tool
            $tool   = DB::table('mst_tool')->get();
            $tool   = ToArr($tool,'id');
            // reff mst_mmaker
            $maker  = DB::table('mst_maker_tool')->get();
            $maker  = ToArr($maker,'id');
            // reff mst_material
            $material = DB::table('mst_material')->get();
            $material = ToArr($material,'id');
            // ref markin program
            $marking = DB::table('mst_marking_program')->get();
            $marking = ToArr($marking,'id');
            // ref mst_unit
            $unit   = DB::table('mst_unit')->get();
            $unit   = ToArr($unit,'id');
            // ref mst_unit
            $unit   = DB::table('mst_unit')->get();
            $unit   = ToArr($unit,'id');

            $html   = '';
            if(count($arr) > 0){

                foreach ($arr as $key => $row) {
                    if(array_key_exists($row->id_tool, $tool)){
                        $nmtool = $tool[$row->id_tool]['tool_type'];
                    }
                    if(array_key_exists($row->id_maker, $maker)){
                        $nmmaker = $maker[$row->id_maker]['maker_name'];
                    }
                    if(array_key_exists($row->id_material, $material)){
                        $nmmaterial = $material[$row->id_material]['material_type'];
                    }
                    if(array_key_exists($row->id_marking, $marking)){
                        $nmmarking = $marking[$row->id_marking]['program_no'];
                    }

                    $count  = DB::table('mst_marking_tool')->where('is_active',1)->where('status_qr_code',1)->where('id_tool_regis',$row->id)->count();
                    $latest = DB::table('mst_marking_tool')->where('is_active',1)->where('id_tool_regis',$row->id)->orderBy('id','desc')->first();
                    if(empty($latest)){
                        $status  = 'execute';
                        $qr_code = '';
                    }else {
                        $status = $latest->status_qr_code;
                        if($status == 1){
                            $status = 'execute';
                            $qr_code = $latest->qr_code;
                        }else {
                            $status = 'verify';
                            $qr_code = $latest->qr_code;
                        }
                    }



                    // check if file drawing exist
                    $file       = public_path('tool/'.$row->drawing);
                    $cssDrawing = 'text-success';
                    if(!file_exists($file)){
                        $cssDrawing = 'text-danger';
                    }
                    if($row->judgement == 'regrind'){
                        $regrind_indexing = '<td>'.$row->max_regrind.'</td>';
                    }else {
                        $regrind_indexing = '<td>'.$row->max_indexing.'</td>';
                    }
                    if($row->judgement == 'regrind'){
                        $lifetime = $row->replacement * $row->max_regrind;
                    }else {
                        $lifetime = $row->replacement * $row->max_indexing;
                    }

                    // make encode json
                    $jsonData   = json_encode($row);
                    $jsonData   = str_replace('"', "'", $jsonData);
                    $i          = $key + 1;
                    $html       .= '<tr>';
                    $html       .= '<td>'.$i.'</td>';
                    $html       .= '<td>'.$row->part_no.'</td>';
                    $html       .= '<td>'.$row->engineering_no.'</td>';
                    $html       .= '<td>'.$row->hes_no.'</td>';
                    $html       .= '<td>'.$row->spesification.'</td>';
                    $html       .= '<td>'.$nmtool.'</td>';
                    $html       .= '<td>'.$nmmaterial.'</td>';
                    $html       .= '<td>'.$nmmarking.'</td>';
                    $html       .= '<td>'.$count.'</td>';
                    $html       .= '<td>'.$row->judgement.'</td>';
                    $html       .= '<td>';
                    $html       .= '<div class="d-flex justify-content-center">';
                    if($status == 'execute'){
                        $html       .= '<button class="btn btn-execute" data-name="execute" data-item="'.$row->id.'"><i class="bi bi-caret-right-fill"></i>Execute</button>';
                        }
                    if($status == 'verify'){
                        $html       .= '<button class="btn btn-verify" data-name="verify" data-arr="'.$qr_code.'" data-item="'.$row->id.'"><i class="bi bi-caret-right-fill"></i>Verify</button>';
                    }
                    $html       .= '</div>';
                    $html       .= '</td>';
                    $html       .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
            }

            return $html;
        }else {

        }

    }

    function getInspectionRecord($qr_code = null)
    {
        // reff mst_tool_regis
        $tool_regis = DB::table('mst_tool_regis')->get();
        $tool_regis = ToArr($tool_regis,'id');

        // ref material
        $material = DB::table('mst_material')->get();
        $material = ToArr($material,'id');
        // ref marking
        $marking = DB::table('mst_marking_program')->get();
        $marking = ToArr($marking,'id');

        if($qr_code == null){
            $arr = DB::table('mst_marking_tool')->where('is_active',1)->where('status_qr_code',1)->where('is_stock',0)->get();
            if(empty($arr)){
                $html = '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';
                return $html;
            }
            $arr = $arr->toArray();
            foreach ($arr as $key => $row) {
                if (isset($tool_regis[$row->id_tool_regis])) {
                    if ($tool_regis[$row->id_tool_regis]['judgement'] != 'regrind') {
                        unset($arr[$key]);
                    }
                }
            }
        
            $arr        = array_values($arr);
            foreach ($arr as $key => $row) {
                if(array_key_exists($row->id_tool_regis, $tool_regis)){
                    $arr[$key]->id_material = $tool_regis[$row->id_tool_regis]['id_material'];
                }
            }
            $html       = '';

            // echo '<pre>';print_r($arr);exit;
            foreach ($arr as $key => $row) {
                $i     = $key + 1;

                $spefisification = $tool_regis[$row->id_tool_regis]['spesification'];
                $material_type   = $material[$row->id_material]['material_type'];
                $marking_no      = $marking[$tool_regis[$row->id_tool_regis]['id_marking']]['program_no'];
                $replacement     = $tool_regis[$row->id_tool_regis]['replacement'];

                $html .= '<tr>';
                $html .= '<td>'.$i.'</td>';
                $html .= '<td>'.$row->qr_code.'</td>';
                $html .= '<td>'.$spefisification.'</td>';
                $html .= '<td>'.$row->id_tool_regis.'</td>';
                $html .= '<td>'.$material_type.'</td>';
                $html .= '<td>'.$marking_no.'</td>';
                $html .= '<td>'.$replacement.'</td>';

            }
            return $html;
        }else {
            $arr = DB::table('mst_marking_tool')->where('qr_code',$qr_code)->first();
            if(empty($arr)){
                $status = false;
                $arr  = '';
                $isp  = '';
                $message = 'QR Code Not Found !';
            }else {
                $isp    = DB::table('mst_regrind_inspection_record')->where('id_register_tool',$arr->id_tool_regis)->first();
                $status = true;
                $message = 'QR Code Found !';
            }

            $resp = array(
                'status' => $status,
                'tool'   => $arr,
                'isp'    => $isp,
                'message' => $message
            );

            return $resp;
        }
    }

    function getStokMarkingHolder()
    {
        $arr    = DB::table('mst_holder_regis')->where('is_active',1)->get();
        $html   = '';
        // reff mst_holder
        $holder = DB::table('mst_holder')->get();
        $holder = ToArr($holder,'id');
        // reff mst_mmaker
        $maker  = DB::table('mst_maker_tool')->get();
        $maker  = ToArr($maker,'id');
        // reff mst_material
        $material = DB::table('mst_material')->get();
        $material = ToArr($material,'id');
        // ref markin program
        $marking = DB::table('mst_marking_program')->get();
        $marking = ToArr($marking,'id');
        if(!empty($arr)){
            foreach ($arr as $key => $row) {
                // get count from mst_marking_holder
                $count = DB::table('mst_marking_holder')->where('is_active',1)->where('status_qr_code',1)->where('id_holder_register',$row->id_holder)->count();

                if(array_key_exists($row->id_holder, $holder)){
                    $nmholder = $holder[$row->id_holder]['holder_type'];
                }
                if(array_key_exists($row->id_maker, $maker)){
                    $nmmaker = $maker[$row->id_maker]['maker_name'];
                }
                if(array_key_exists($row->id_material, $material)){
                    $nmmaterial = $material[$row->id_material]['material_type'];
                }
                if(array_key_exists($row->id_marking, $marking)){
                    $nmmarking = $marking[$row->id_marking]['program_no'];
                }

                $html .= '<tr>';
                $html .= '<td>'. ($key + 1) .'</td>';
                $html .= '<td>'.$row->part_no.'</td>';
                $html .= '<td>'.$row->engineering_no.'</td>';
                $html .= '<td>'.$row->hes_no.'</td>';
                $html .= '<td>'.$row->spesification.'</td>';
                $html .= '<td>'.$nmholder.'</td>';
                $html .= '<td>'.$nmmaterial.'</td>';
                $html .= '<td>'.$nmmarking.'</td>';
                $html .= '<td>'.$count.'</td>';
                $html .= '<td>'.$row->lifetime.'</td>';
                $html .= '<td>';
                $html .= '<div class="d-flex justify-content-center">';
                $html .= '<button class="btn btn-execute" data-item="'.$row->id.'" data-name="detail">View Detail</button>';
                $html .= '</div>';
                $html .= '</td>';
                $html .= '</tr>';

            }
        }else {
            $html .= '<tr>';
            $html .= '<td colspan="5" class="text-center">No Data !</td>';
            $html .= '</tr>';
        }

        return $html;

        echo '<pre>';print_r($arr);die;
    }

    function getDetailMarkingHolder($id)
    {
        // reff mst_holder_regis
        $typeHolder = DB::table('mst_holder')->where('id',$id)->get();
        $typeHolder = ToArr($typeHolder,'id');

        // ref marking program
        $marking    = DB::table('mst_marking_program')->get();
        $marking    = ToArr($marking,'id');

        // ref material
        $material   = DB::table('mst_material')->get();
        $material   = ToArr($material,'id');

        $holder     = DB::table('mst_holder_regis')->where('id',$id)->first();

        $holder->holder_type    = $typeHolder[$id]['holder_type'];
        $holder->material_type  = $material[$holder->id_material]['material_type'];
        $holder->marking = $marking[$holder->id_marking]['program_no'];

        $marking    = DB::table('mst_marking_holder')->where('id_holder_register',$id)->where('status_qr_code',1)->where('is_active',1)->get();
        foreach ($marking as $key => $row) {
            $marking[$key]->actual_lifetime = 'dummy';
        }

        $resp = array(
            'holder' => $holder,
            'marking' => $marking
        );

        return $resp;
    }

    function getMarkingToolStock()
    {
        $arr    = DB::table('mst_tool_regis')->where('is_active',true)->get();
        // reff mst_tool
        $tool   = DB::table('mst_tool')->get();
        $tool   = ToArr($tool,'id');
        // reff mst_mmaker
        $maker  = DB::table('mst_maker_tool')->get();
        $maker  = ToArr($maker,'id');
        // reff mst_material
        $material = DB::table('mst_material')->get();
        $material = ToArr($material,'id');
        // ref markin program
        $marking = DB::table('mst_marking_program')->get();
        $marking = ToArr($marking,'id');
        // ref mst_unit
        $unit   = DB::table('mst_unit')->get();
        $unit   = ToArr($unit,'id');
        // ref mst_unit
        $unit   = DB::table('mst_unit')->get();
        $unit   = ToArr($unit,'id');

        $html   = '';
        if(count($arr) > 0){

            foreach ($arr as $key => $row) {
                if(array_key_exists($row->id_tool, $tool)){
                    $nmtool = $tool[$row->id_tool]['tool_type'];
                }
                if(array_key_exists($row->id_maker, $maker)){
                    $nmmaker = $maker[$row->id_maker]['maker_name'];
                }
                if(array_key_exists($row->id_material, $material)){
                    $nmmaterial = $material[$row->id_material]['material_type'];
                }
                if(array_key_exists($row->id_marking, $marking)){
                    $nmmarking = $marking[$row->id_marking]['program_no'];
                }

                $count = DB::table('mst_marking_tool')->where('is_active',1)->where('status_qr_code',1)->where('id_tool_regis',$row->id)->count();

                $latest = DB::table('mst_marking_tool')->where('is_active',1)->where('id_tool_regis',$row->id)->orderBy('id','desc')->first();
                $status = $latest->status_qr_code;

                // echo $status;

                if($status == 1){
                    $status = 'execute';
                    $qr_code = $latest->qr_code;
                }else {
                    $status = 'verify';
                    $qr_code = $latest->qr_code;
                }

                // check if file drawing exist
                $file       = public_path('tool/'.$row->drawing);
                $cssDrawing = 'text-success';
                if(!file_exists($file)){
                    $cssDrawing = 'text-danger';
                }
                if($row->judgement == 'regrind'){
                    $regrind_indexing = '<td>'.$row->max_regrind.'</td>';
                }else {
                    $regrind_indexing = '<td>'.$row->max_indexing.'</td>';
                }
                if($row->judgement == 'regrind'){
                    $lifetime = $row->replacement * $row->max_regrind;
                }else {
                    $lifetime = $row->replacement * $row->max_indexing;
                }

                // make encode json
                $jsonData   = json_encode($row);
                $jsonData   = str_replace('"', "'", $jsonData);
                $i          = $key + 1;
                $html       .= '<tr>';
                $html       .= '<td>'.$i.'</td>';
                $html       .= '<td>'.$row->part_no.'</td>';
                $html       .= '<td>'.$row->engineering_no.'</td>';
                $html       .= '<td>'.$row->hes_no.'</td>';
                $html       .= '<td>'.$row->spesification.'</td>';
                $html       .= '<td>'.$nmtool.'</td>';
                $html       .= '<td>'.$nmmaterial.'</td>';
                $html       .= '<td>'.$nmmarking.'</td>';
                $html       .= '<td>'.$count.'</td>';
                $html       .= '<td>'.$lifetime.'</td>';
                $html       .= '<td>';
                $html       .= '<div class="d-flex justify-content-center">';
                $html       .= '<button class="btn btn-execute" data-item="'.$row->id.'"  data-name="detail">View Detail</button>';
                $html       .= '</div>';
                $html       .= '</td>';
                $html       .= '</tr>';
            }
        }else {
            $html .= '<tr>';
            $html .= '<td colspan="5" class="text-center">No Data !</td>';
            $html .= '</tr>';
        }

        return $html;
    }

    function getDetailGoodStock($id)
    {
        $arr = DB::table('mst_marking_tool')->where('status_qr_code',1)->where('is_stock',1)->where('is_active',1)->where('id_tool_regis',$id)->get();
        // add column actual lifetime
        foreach ($arr as $key => $row) {
            $arr[$key]->actual_lifetime = 'dummy';
        }

        return $arr;
    }

    function getAccStock($id = null)
    {
        if($id == null ){
            $arr    = DB::table('mst_accesories_regis')->where('is_active',true)->get();

            // reff mst_tool
            $acc    = DB::table('mst_accesories')->get();
            $acc    = ToArr($acc,'id');
            // reff mst_mmaker
            $maker  = DB::table('mst_maker_tool')->get();
            $maker  = ToArr($maker,'id');
            // reff mst_material
            $material = DB::table('mst_material')->get();
            $material = ToArr($material,'id');
            // ref mst_unit
            $unit   = DB::table('mst_unit')->get();
            $unit   = ToArr($unit,'id');

            $html   = '';
            if(count($arr) > 0){
                foreach ($arr as $key => $row) {
                    if(array_key_exists($row->id_accesories, $acc)){
                        $nmacc = $acc[$row->id_accesories]['accesories_type'];
                    }
                    if(array_key_exists($row->id_maker, $maker)){
                        $nmmaker = $maker[$row->id_maker]['maker_name'];
                    }
                    if(array_key_exists($row->id_material, $material)){
                        $nmmaterial = $material[$row->id_material]['material_type'];
                    }
                    if(array_key_exists($row->id_unit, $unit)){
                        $nmunit = $unit[$row->id_unit]['description'];
                    }

                    // check if file drawing exist
                    $file       = public_path('accessories/'.$row->drawing);
                    $cssDrawing = 'text-success';
                    if(!file_exists($file)){
                        $cssDrawing = 'text-danger';
                    }
                    $html      .= '<tr>';
                    $html      .= '<td>'. ($key + 1) .'</td>';
                    $html      .= '<td>'.$row->part_no.'</td>';
                    $html      .= '<td>'.$row->engineering_no.'</td>';
                    $html      .= '<td>'.$row->hes_no.'</td>';
                    $html      .= '<td>'.$row->spesification.'</td>';
                    $html      .= '<td>'.$nmacc.'</td>';
                    $html      .= '<td>'.$nmmaker.'</td>';
                    $html      .= '<td>'.$nmmaterial.'</td>';
                    $html      .= '<td>'.$row->price.'</td>';
                    $html      .= '<td>'.$row->lifetime.'</td>';
                    $html      .= '<td>'.$row->qty.'</td>';
                    $html      .= '<td>';
                    $html      .= '<div class="d-flex justify-content-center">';
                    $html      .= '<button class="btn btn-verify" data-item="'.$row->id.'" data-name="add_stock">Add Stock</button>';
                    $html      .= '</div>';
                    $html      .= '</td>';
                    $html      .= '</tr>';
                }
            }else {
                $html .= '<tr>';
                $html .= '<td colspan="5" class="text-center">No Data !</td>';
                $html .= '</tr>';

            }

            return $html;
        }else {
            $arr = DB::table('mst_accesories_regis')->where('id',$id)->first();
            // reff mst_tool
            $acc    = DB::table('mst_accesories')->get();
            $acc    = ToArr($acc,'id');
            // reff mst_mmaker
            $maker  = DB::table('mst_maker_tool')->get();
            $maker  = ToArr($maker,'id');
            // reff mst_material
            $material = DB::table('mst_material')->get();
            $material = ToArr($material,'id');
            // ref mst_unit
            $unit   = DB::table('mst_unit')->get();
            $unit   = ToArr($unit,'id');

            if(array_key_exists($arr->id_accesories, $acc)){
                $nmacc = $acc[$arr->id_accesories]['accesories_type'];
            }
            if(array_key_exists($arr->id_maker, $maker)){
                $nmmaker = $maker[$arr->id_maker]['maker_name'];
            }
            if(array_key_exists($arr->id_material, $material)){
                $nmmaterial = $material[$arr->id_material]['material_type'];
            }
            if(array_key_exists($arr->id_unit, $unit)){
                $nmunit = $unit[$arr->id_unit]['description'];
            }

            $resp = array(
                'acc' => $arr,
                'nmacc' => $nmacc,
                'nmmaker' => $nmmaker,
                'nmmaterial' => $nmmaterial,
                'nmunit' => $nmunit
            );

            return $resp;
        }


    }

    function fetchHtmlAssy($qr_code)
    {
        // get data mst_plant
        $plant          = DB::table('mst_plant')->get();
        $plant          = ToArr($plant,'id');

        // get data mst_wct
        $wct            = DB::table('mst_line')->get();
        $wct            = ToArr($wct,'id');

        // get data mst_machine_regist
        $machine_regis  = DB::table('mst_machine_regis')->get();
        $machine_regis  = ToArr($machine_regis,'id');

        // get data holder from mst_marking_holder
        $marking_holder = DB::table('mst_marking_holder')->where('qr_code',$qr_code)->first();

        // get data line from mst_line
        $line           = DB::table('mst_line')->where('id',$marking_holder->id_wct)->first();
        $plant_id       = $plant[$line->id_plant]['id_plant'];
        $wct_id         = $wct[$line->id_wct]['id_wct'];
        $op_name        = $machine_regis[$marking_holder->id_machine_regis]['op_name'];
        // echo $op_name;exit;
        // echo '<pre>';print_r($line);exit;
        // get template assy from mst_assy_tool_port_regis
        $template       = DB::table('mst_assy_tool_port_regis')->where('id',$marking_holder->id_assy_tool_port_regis)->first();
        $tool_port      = $template->tool_port;
        // get data holder from trx_assy
        $assy           = DB::table('trx_assy')->where('holder_qr_code',$qr_code)->orderBy('id','desc')->get();

        // get data template separate for array tool, holder, accesorries
        $tool           = array();
        $holder         = array();
        $acc            = array();

        // ref mst_tool_regis
        $tool_regis = DB::table('mst_tool_regis')
        ->join('mst_tool', 'mst_tool_regis.id_tool', '=', 'mst_tool.id')
        ->select('mst_tool_regis.*', 'mst_tool.tool_type') // Specify the columns you want to select
        ->get();
        $tool_regis     = ToArr($tool_regis,'id');


        // ref mst_holder_regis join mst_holder
        $holder_regis   = DB::table('mst_holder_regis')
        ->join('mst_holder', 'mst_holder_regis.id_holder', '=', 'mst_holder.id')
        ->select('mst_holder_regis.*', 'mst_holder.holder_type') // Specify the columns you want to select
        ->get();
        $holder_regis   = ToArr($holder_regis,'id');

        // ref mst_accesories_regis join mst_accesories
        $acc_regis      = DB::table('mst_accesories_regis')
        ->join('mst_accesories', 'mst_accesories_regis.id_accesories', '=', 'mst_accesories.id')
        ->select('mst_accesories_regis.*', 'mst_accesories.accesories_type') // Specify the columns you want to select
        ->get();
        $acc_regis      = ToArr($acc_regis,'id');

        // explode data from $template
        $tool           = explode(',',$template->id_cutting_tool_regis);
        $holder         = explode(',',$template->id_holder_regis);
        $acc            = explode(',',$template->id_accesories_regis);

        // get data tool
        foreach ($tool as $key => $row) {
            if(array_key_exists($row, $tool_regis)){
                $tool[$key] = $tool_regis[$row];
            }
        }

        // get data holder
        foreach ($holder as $key => $row) {
            if(array_key_exists($row, $holder_regis)){
                $holder[$key] = $holder_regis[$row];
                $holder[$key]['actual_lifetime'] = 'dummy';
            }
        }

        // get data accesorries
        foreach ($acc as $key => $row) {
            if(array_key_exists($row, $acc_regis)){
                $acc[$key] = $acc_regis[$row];
                $acc[$key]['actual_lifetime'] = 'dummy';
            }
        }

        $data = array(
            'plant_id'       => $plant_id,
            'wct_id'         => $wct_id,
            'op_name'        => $op_name,
            'tool_port'      => $tool_port,
            'marking_holder' => $marking_holder,
            'template'       => $template,
            'tool'           => $tool,
            'holder'         => $holder,
            'acc'            => $acc,
            'assy'           => $assy
        );

        return $data;

    }

    function getAssyMeasure()
    {
        $arr = DB::table('trx_assy')->where('start_install',null)->where('end_install',null)->get();//zoller belum pernah diinstall di mesin

        return $arr;
    }

    function trxAssyByQrHolder($qr_code)
    {
        $arr = DB::table('trx_assy')->where('holder_qr_code',$qr_code)->first();

        return $arr;

    }

    function getToRtuLine($qr)
    {
        // jika ada aktifitas scan
        if($qr != ''){
            $arr = DB::table('trx_assy')->where('holder_qr_code',$qr)->first();
            if(empty($arr)){
                $status = false;
                $data   = '';
                $message= 'QR Holder Not Found !';
            }else {
                $status = true;
                $data   = $arr;
                $message= 'QR Holder Found !';
            }
        }else {
            $arr = DB::table('trx_assy')
            ->where('start_install',null)
            ->where('end_install',null)
            ->where('id_location',1)
            ->whereNotNull('zoller_z_value')
            ->whereNotNull('zoller_x_value')
            ->get();

            if(empty($arr)){
                $status = false;
                $data   = '';
                $message= 'No Data !';
            }else {
                $status = true;
                $data   = $arr;
                $message= 'Data Found !';
            }
        }
        
        $resp = array(
            'status' => $status,
            'data'   => $data,
            'message' => $message
        );

        return $resp;    
    }

    function sendRtuLine($id_assy)
    {
        // update location trx_assy from 1 to 2
        $update = DB::table('trx_assy')->where('id_assy',$id_assy)->update(['id_location' => 2]);
        
        if($update){
            $status = true;
            $message = 'Data Updated !';
        }else {
            $status = false;
            $message = 'Data Not Updated !';
        }

        $resp = array(
            'status' => $status,
            'message' => $message
        );

        return $resp;
    }

    function getAssyStock()
    {
        $arr = DB::table('trx_assy')->get();

        return $arr;
        
    }

    function pokayokestep5process($id_list_machine, $id_assy_old, $tool_port, $id_assy_new, $status)
    {
        // update data yang lama di trx_machine_assy_tool
        // check apakah datanya null, jika null maka update, jika tidak maka jangan diapa2in
        $update = DB::table('trx_machine_assy_tool')->where('id_list_machine',$id_list_machine)->where('id_trx_assy_old',$id_assy_old)->where('id_trx_assy_new',null)->update(
            [
                'flag_desktop'      => 1, // 1  = desktop harus melakukan write untuk melakukan update jumlah shoot
                'flag_transaction' => 1, // 1  = desktop harus melakukan write untuk melakukan update jumlah shoot
            ]
        );

        if($update){
            $status = true;
        }else {
            $status = false;
        }

        return $status;

    }

    function getToolAnalyze()
    {
        $arr = DB::table('trx_assy')
            ->where('id_location',3)
            ->get();

        return $arr;
    }

    function getAssyInformation($qr_holder)
    {
        $arr = DB::table('trx_assy')->where('holder_qr_code',$qr_holder)->first();
        
        // ref mst_plant
        $plant = DB::table('mst_plant')->get();
        $plant = ToArr($plant,'id');

        // ref mst_line
        $line = DB::table('mst_line')->get();
        $line = ToArr($line,'id');

        // ref mst_machine
        $machine = DB::table('mst_machine_regis')->get();
        $machine = ToArr($machine,'id');

        // ref mst_list_machine
        $list_machine = DB::table('mst_list_machine')->get();
        $list_machine = ToArr($list_machine,'id');

        // ref assy_tool_port_regis
        $tool_port = DB::table('mst_assy_tool_port_regis')->get();
        $tool_port = ToArr($tool_port,'id');

        // user
        $user = DB::table('users')->get();
        $user = ToArr($user,'id');

        if(array_key_exists($arr->id_plant, $plant)){
            $arr->plant_id = $plant[$arr->id_plant]['id_plant'];
        }
        if(array_key_exists($arr->id_wct, $line)){
            $arr->wct_id = $line[$arr->id_wct]['id_wct'];
        }
        if(array_key_exists($arr->id_machine_regis, $machine)){
            $arr->op_name = $machine[$arr->id_machine_regis]['op_name'];
        }

        if(array_key_exists($arr->id_machine_regis, $list_machine)){
            $arr->asset_id = $list_machine[$arr->id_machine_regis]['asset_id'];
        }

        if(array_key_exists($arr->id_assy_tool_port_regis, $tool_port)){
            $arr->tool_port = $tool_port[$arr->id_assy_tool_port_regis]['tool_port'];
        }

        if(array_key_exists($arr->id_user_install, $user)){
            $arr->user_name_install = $user[$arr->id_user_install]['name'];
        }

        if(array_key_exists($arr->id_user_uninstall, $user)){
            $arr->user_name_uninstall = $user[$arr->id_user_uninstall]['name'];
        }

        return $arr;
    }

    function getuser($id = null)
    {
        if($id == null){
            $arr = DB::table('users')->where('is_active',1)->get();
        }else {
            $arr = DB::table('users')->where('id',$id)->first();
        }

        return $arr;

    }

    function tes(){
        echo 'aaa';
    }
