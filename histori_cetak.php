<?php
include'functions.php';
include'koneksi.php';

?>
<head>
<style type="text/css">
   body {font-family: arial; 
    background-color : #ccc; }

    .rangkasurat {
      width : 980px;
      margin:0 auto;
      background-color : #fff;
      height: 170px;
      padding: 20px;
    }

    table {
      
    }

    .tengah {text-align : center;
      line-height: 5px;}

</style>
</head>



<body onload="window.print()">
<!--<table class="noborder">
  <tr>
    <td width="136" rowspan="3" align="center"><img style="margin-bottom:-25px;" src="assets/images/logo/logo.png" width="100%" height="120"></td>
    <td width="883" align="center">&nbsp;</td>
    <td width="26" rowspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><strong>
    </strong>
    <p align="left"><strong><h3 align="center">PEMERINTAH KABUPATEN ASAHAN <br> <span style="font-size:20px;"> DINAS PERHUBUNGAN KABUPATEN ASAHAN</span> <br> <span style="font-size:14px;">Jl. Jl. Abdi Setia Bakti, Sei Renggas,<br> Kec. Kota Kisaran Barat, Kabupaten Asahan, Sumatera Utara 21211 <br> E-mail: dinasperhubunganasahan@gmail.com</span></h3></strong></p>
    <h1>
    </td>
  </tr>
</table>-->
<div class = "rangkasurat">

     <table style="border-bottom : 5px solid #000; 
      padding: 2px;" width = "100%">

           <tr>

                 <td rowspan="3"> <img src="assets/images/logo/logo.png" width="140px" height="130px"> </td>

                 <td class = "tengah">

                       <h2 style="font-size:30px">PEMERINTAH DAERAH KABUPATEN ASAHAN</h2>

                       <h1 style="font-size:55px"> DINAS PERHUBUNGAN </h1>
                       <b style="font-size:23px">Komplek Terminal Madya Kisaran Telp. (0623) 43663</b>
                       <br><h2> KISARAN - 21226 </h2>

                 </td>
                 <td rowspan="3"> <img src="assets/images/logo/dishub.jpg" width="140px" height="130px"> </td>

            </tr>

     </table >

</div>
<div class="panel panel-default">
    <div class="panel-heading">      
        
    </div>
    <div class="panel-body">
        <table border="5" style="border: solid #000" width="100%">
            <thead>
                <tr>
                    <td rowspan="2"><center><b>No</b></td>
                     <td rowspan="2"><center><b>Tanggal</b></td>
                      <td rowspan="2"><center><b>Nama Petugas</b></td>
                       <td rowspan="2"><center><b>Ruas Jalan</b></td>
                        <td rowspan="2"><center><b>Loyalitas</b></td>
                         <td rowspan="2"><center><b>Tanggung jawab</b></td>
                          <td rowspan="2"><center><b>Disiplin</b></td>
                           <td rowspan="2"><center><b>Kinerja</b></td>
                            <th colspan="2"><center>Keseluruhan</th>
                </tr>
                <tr>
                <th>Baik</th>
                <th>Buruk</th>
                </tr>
            </thead> 
            <?php
             
if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
                $filter = $_GET['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                date_default_timezone_set('Asia/Jakarta');
                $tgl = date("Y-m-d", strtotime($_GET['tanggal']));
                $tgl2 = date("Y-m-d", strtotime($_GET['tanggal2']));

                $ket = 'Data Tanggal '.date('d-m-Y', strtotime($tgl)). ' Sampai Dengan ' .date('d-m-Y', strtotime($tgl2));
                 $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal WHERE DATE(tb_hasil.tanggal_input) BETWEEN '$tgl' AND '$tgl2' ORDER BY tanggal_input ASC"); 
                

            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Laporan Data Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal WHERE MONTH(tb_hasil.tanggal_input)='$bulan' AND YEAR(tb_hasil.tanggal_input)='$tahun'  ORDER BY tanggal_input ASC ");  // Panggil fungsi view_by_month yang ada di TransaksiModel
            
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_GET['tahun'];

                $ket = 'Laporan Data Tahun '.$tahun;
                 $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal WHERE YEAR(tb_hasil.tanggal_input)='$tahun'  ORDER BY tanggal_input ASC");  // Panggil fungsi view_by_month yang ada di TransaksiModel
            }else { // Jika filter nya 3 (per tahun)
                $ket = 'Laporan Semua Data';
               $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal  ORDER BY tanggal_input ASC");
                
            }

        }else{ // Jika user tidak mengklik tombol tampilkan
           $ket = 'Laporan Semua Data';
           $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal  ORDER BY tanggal_input ASC");
        }
              
                 $no=0;
                echo "<center><h1> ".$ket. "</h1></center>";
                while ( $row = mysqli_fetch_array($rows)) { 
                    $no++;
                    ?>    
     
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $row['tanggal_input']?></td>
                    <td>[<?php echo $row['NIPP'] ?>] <?php echo $row['nama_petugas']?></td>
                    <td><?php echo $row['ruas_jalan']?></td>
                    <td><?php echo $row['Loyalitas']?></td>
                    <td><?php echo $row['Tanggungjawab']?></td>
                    <td><?php echo $row['Disiplin'] ?></td>
                    <td><?php echo $row['Status'] ?></td>

                     <td> 
                     <!-- Hitung Jumlah Kinerja Baik -->
                     <?php  
                     $data = $row['NIPP'];
                     $hitungbaik=mysqli_query($koneksi, "SELECT * FROM tb_hasil WHERE Status='Kinerja Baik' AND id_petugas='".$data."'");
                   echo $querybaru = mysqli_num_rows($hitungbaik);
                   ?></td>
                     <td> 
                     <!-- Hitung Jumlah Kinerja Buruk -->
                     <?php  
                     $data = $row['NIPP'];
                     $hitungbaik=mysqli_query($koneksi, "SELECT * FROM tb_hasil WHERE Status='Kinerja Buruk' AND id_petugas='".$data."'");
                   echo $querybaru = mysqli_num_rows($hitungbaik);
                   ?></td>
                </tr>
                <?php } ?>
                
             
        </table>
    </div>
</div>

</div>
</div>
<br>
<br>

<table width=100% class="noborder">
  <tr>
    <td colspan="2"></td>
    <td width="286"></td>
  </tr>
  <tr>
    <td width="230" align="center"> <br> 
    </td>
    <td width="530"></td>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diketahui oleh </td>
  </tr>
  <tr>
    <td align="center"><br /><br /><br /><br /><br />
      <br /><br /><br />
     </td>
      <td>&nbsp;</td>
      <td align="left" valign="top"><br /><!-- <br /><br /><br /><br /> --> 
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!-- <img width="40%;" style="margin-top:-33px; margin-bottom:-33px;" src="assets/images/sign/sign.png"><br> --> <br><br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><strong><b>Zakaria Tarigan, SH</strong></u> <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manajemen Rekayasa Lalu Lintas<br />
      </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  </body>