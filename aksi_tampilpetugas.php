<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_knn';

$koneksi = mysqli_connect($host, $user, $pass, $db);
$id_petugas = $_GET['id_petugas'];
$sql = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE id_petugas ='$id_petugas'");
$cekdata = mysqli_fetch_row($sql);
$data = array(
             'nama'          => $cekdata['1'],
              'jalan'          => $cekdata['2'],
            );
echo json_encode($data);