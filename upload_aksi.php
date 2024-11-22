<!-- import excel ke mysql -->

<?php 
session_start();
// menghubungkan dengan koneksi
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_knn';

$koneksi = mysqli_connect($host, $user, $pass, $db);
// menghubungkan dengan library excel reader
include "excelreader.php";
?>

<?php
// upload file xls
$target = basename($_FILES['filepegawai']['name']) ;
move_uploaded_file($_FILES['filepegawai']['tmp_name'], $target);

// beri permisi agar file xls dapat di baca
chmod($_FILES['filepegawai']['name'],0777);

// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filepegawai']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);

// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){

	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$nama_petugas     		= $data->val($i, 1);
	$ruasjalan				= $data->val($i, 2);
	$loyalitas 				= $data->val($i, 3);
	$tanggungjawab          = $data->val($i, 4);
	$disiplin			    = $data->val($i, 5);
	$status					= $data->val($i, 6);

	if($nama_petugas != "" && $loyalitas != "" && $tanggungjawab!= "" && $disiplin!= "" && $status != ""){
		// input data ke database (table data_petugas)
		mysqli_query($koneksi,"INSERT into tb_datatesting values('','$nama_petugas','$ruasjalan','$loyalitas','$tanggungjawab', '$disiplin', '$status')");
		$berhasil++;
	}
}

// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filepegawai']['name']);

// alihkan halaman ke index.php
header("location:Dashboard.php?m=datatesting");
?>