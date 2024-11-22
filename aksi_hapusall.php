<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_knn';

$koneksi = mysqli_connect($host, $user, $pass, $db);
$sql = mysqli_query($koneksi, "DELETE FROM tb_datatesting");
$cekdata = mysqli_fetch_array($sql);
$cek = mysqli_num_rows($cekdata);
header("location:Dashboard.php?m=datatesting");
