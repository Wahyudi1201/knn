<?php
session_start();
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_knn';

$koneksi = mysqli_connect($host, $user, $pass, $db);

$tanggal = $_POST['tanggal'];
$jalan = $_POST['jalan'];
$id_loyal = $_POST['id_loyal'];
$loyalitas = $_POST['loyalitas'];
$tanggungjawab = $_POST['tanggungjawab'];
$disiplin = $_POST['disiplin'];
$data = mysqli_query($koneksi, "INSERT INTO tb_hasil (id_loyal, ruas_jalan, Loyalitas, Tanggungjawab, Disiplin, Status, tanggal_input) VALUES ('$id_loyal', '$jalan', '$loyalitas', '$tanggungjawab', '$disiplin', '0', '$tanggal')");

var_dump($data);