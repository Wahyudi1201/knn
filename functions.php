<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);
session_start();
include'config.php';
include'includes/ez_sql_core.php';
include'includes/ez_sql_mysqli.php';
$db = new ezSQL_mysqli($config["username"], $config["password"], $config["database_name"], $config["server"]);
include'includes/general.php';
    
$mod = $_GET["m"];
$act = $_GET["act"];  


function FC_get_loyalitas($selected = '', $ask = false){
    global $db;
    $rows = $db->get_results("SELECT id_loyal, tanggal_input, nama_petugas, loyalitas FROM tb_loyalparkir WHERE status ='0'");
        
    foreach($rows as $row){
        $select = ($row->id_loyal==$selected) ? 'selected' : ''; 
        $text = ($ask) ? '['. $row->id_loyal . '] Apakah '. strtolower($row->nama_petugas) . '?' : '['. $row->tanggal_input. '] ' .$row->nama_petugas;           
        $a.="<option value='$row->id_loyal' $select>$text</option>";
    }
    return $a;
}

function FC_get_penyakit_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_penyakit, nama_penyakit FROM tb_penyakit ORDER BY kode_penyakit");
    foreach($rows as $row){
        if($row->kode_penyakit==$selected)
            $a.="<option value='$row->kode_penyakit' selected>[$row->kode_penyakit] $row->nama_penyakit</option>";
        else
            $a.="<option value='$row->kode_penyakit'>[$row->kode_penyakit] $row->nama_penyakit</option>";
    }
    return $a;
}

function FC_get_gejala_option($selected = '', $ask = false){
    global $db;
    $rows = $db->get_results("SELECT kode_gejala, nama_gejala FROM tb_gejala ORDER BY kode_gejala");
        
    foreach($rows as $row){
        $select = ($row->kode_gejala==$selected) ? 'selected' : '';
        $text = ($ask) ? '['. $row->kode_gejala . '] Apakah '. strtolower($row->nama_gejala) . '?' : '['. $row->kode_gejala . '] ' .$row->nama_gejala;
            
        $a.="<option value='$row->kode_gejala' $select>$text</option>";
    }
    return $a;
}




function FC_get_solusi_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_solusi, solusi FROM tb_solusi ORDER BY kode_solusi");
    foreach($rows as $row){
        if($row->kode_solusi==$selected)
            $a.="<option value='$row->kode_solusi' selected>[$row->kode_solusi] $row->solusi</option>";
        else
            $a.="<option value='$row->kode_solusi'>[$row->kode_solusi] $row->solusi</option>";
    }
    return $a;
}


function set_value($key = null, $default = null){
    global $_POST;
    if(isset($_POST[$key]))
        return $_POST[$key];
    if($_GET[$key])
        return $_GET[$key];
    
    return $default;
} 