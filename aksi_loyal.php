<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_knn';

$koneksi = mysqli_connect($host, $user, $pass, $db);
$id_loyal = $_GET['id_loyal'];
$sql = mysqli_query($koneksi, "SELECT * FROM tb_loyalparkir WHERE id_loyal='$id_loyal'");
$cekdata = mysqli_fetch_row($sql);
$data = array(
			'idpetugas'          => $cekdata['2'],
            'jalan'          => $cekdata['4'],
             'loyalitas'          => $cekdata['5'],
            );
echo json_encode($data);