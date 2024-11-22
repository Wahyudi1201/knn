<?php
session_start();
//KONEKSI DATABSE
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_knn';
$koneksi = mysqli_connect($host, $user, $pass, $db);

//METHOD POST DARI FORM DATA
$nilaik = $_POST['nilai'];
$tanggal = $_POST['tanggal'];
$jalan = $_POST['jalan'];
$id_loyal = $_POST['id_loyal'];
$loyalitas = $_POST['loyalitas'];
$tanggungjawab = $_POST['tanggungjawab'];
$disiplin = $_POST['disiplin'];
$id_petugas = $_POST['id_petugas'];

//UBAH NILAI STATUS DI TABEL UJI
mysqli_query($koneksi, "UPDATE tb_uji SET Status='1' WHERE id_loyal='$id_loyal'");

//DAFTARKAN DATA DI DATA HASIL
mysqli_query($koneksi, "INSERT INTO tb_hasil (id_loyal, id_petugas, ruas_jalan, Loyalitas, Tanggungjawab, Disiplin, Status, tanggal_input, nilaik) VALUES ('$id_loyal', '$id_petugas', '$jalan', '$loyalitas', '$tanggungjawab', '$disiplin', '0', '$tanggal', '$nilaik')");

//HAPUS DATA DI TABEL KESIMPULAN
mysqli_query($koneksi, "DELETE FROM tb_kesimpulan");

//AMBIL SELURUH DATA DI DATA TESTING
$datatesting = mysqli_query($koneksi, "SELECT * FROM tb_datatesting");

while($datatest = mysqli_fetch_array($datatesting)){
	//VARIABEL DATA TESTING
	$loyalitas1 = $datatest['Loyalitas'];
	$tanggungjawab1 = $datatest['Tanggungjawab'];
	$disipin1 = $datatest['Disiplin'];

//VARIABEL DATA POSTNYA
$loyalitas = $_POST['loyalitas'];
$tanggungjawab = $_POST['tanggungjawab'];
$disiplin = $_POST['disiplin'];


//RUMUS KNN
	$rumus = sqrt(pow($loyalitas1-$loyalitas, 2) + pow($tanggungjawab1-$tanggungjawab, 2) + pow($disipin1-$disiplin, 2));
	var_dump($rumus); //CEK NILAI HASIL RUMUS

//MASUKKAN HASIL RUMUS KEDALAM FIELD JARAK / DISTANCE
	mysqli_query($koneksi, "INSERT INTO tb_rangkingsementara (id_test, nama_petugas, Loyalitas, Tanggungjawab, Disiplin, Jarak, Status) VALUES ('".$datatest['id_test']."', '".$datatest['nama_petugas']."', '".$datatest['Loyalitas']."', '".$datatest['Tanggungjawab']."', '".$datatest['Disiplin']."', '".$rumus."', '".$datatest['Status']."')");

}

//MEMBUAT JARAK TERDEKAT SESUAI DENGAN NILAI K
$rangkingsebenarnya = mysqli_query($koneksi, "SELECT * FROM tb_rangkingsementara ORDER BY Jarak ASC LIMIT $nilaik");
while ($datates = mysqli_fetch_array($rangkingsebenarnya)) {
	mysqli_query($koneksi, "INSERT INTO tb_kesimpulan (id_test, nama_petugas, Loyalitas, Tanggungjawab, Disiplin, Jarak, Status) VALUES ('".$datates['id_test']."', '".$datates['nama_petugas']."', '".$datates['Loyalitas']."', '".$datates['Tanggungjawab']."', '".$datates['Disiplin']."', '".$datates['Jarak']."', '".$datates['Status']."')");

	mysqli_query($koneksi, "DELETE FROM tb_rangkingsementara");



}

 //HITUNG RENTANG JARAK TERDEKAT
$hasilknn = mysqli_query($koneksi, "SELECT Status, count(Status) as jumlah FROM tb_kesimpulan GROUP BY Status ORDER BY jumlah DESC");
while ($hasilknn1 = mysqli_fetch_array($hasilknn)){

$tanggal = $_POST['tanggal'];
$id_loyal = $_POST['id_loyal'];


//UPDATE DATA STATUS DI TABEL HASIL SESUAI DENGAN NILAI STATUS HASIL JARAK TERDEKAT 
mysqli_query($koneksi, "UPDATE tb_hasil SET Status='".$hasilknn1['Status']."' WHERE id_loyal='$id_loyal'");


header("location:Dashboard.php?m=hasilrank");
}



