<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_knn';

$koneksi = mysqli_connect($host, $user, $pass, $db);
$id_loyal = $_GET['id_loyal'];
$sql = mysqli_query($koneksi, "SELECT * FROM tb_uji WHERE id_loyal='$id_loyal'");
$cekdata = mysqli_fetch_row($sql);
$data = array(
			'id_petugas'          => $cekdata['3'],
            'ruas'          => $cekdata['4'],
             'loyalitas'          => $cekdata['5'],
              'Tanggungjawab'          => $cekdata['6'],
               'Disiplin'          => $cekdata['7'],
            );
echo json_encode($data);