<?php
include 'koneksi.php';
require_once'functions.php';

if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
                $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                date_default_timezone_set('Asia/Jakarta');
                $tgl = date("Y-m-d", strtotime($_GET['tanggal']));

                $ket = 'Laporan Data Jumlah Investasi Tanggal '.date('Y-d-m', strtotime($tgl));
                $url_cetak = 'transaksi/cetak?filter=1&tanggal='.$tgl;
                $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal WHERE DATE(tb_hasil.tanggal_input)='$tgl'"); 
                

            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Laporan Data Jumlah Investasi Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'transaksi/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                 // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else{ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Laporan Data Jumlah Investasi Tahun '.$tahun;
                $url_cetak = 'transaksi/cetak?filter=3&tahun='.$tahun;
                
            }
        }else{ // Jika user tidak mengklik tombol tampilkan
           $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal");
        }
              
?>