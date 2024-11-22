<?php 
include 'koneksi.php';
?>
<div style="min-height:90px">
</div>
<div class="panel panel-default">
    <div class="panel-heading">      
        <strong>Histori Kualifikasi</strong>  
    </div>
    <div class="panel-heading">
        <div class="form-inline">
            <!--<input type="hidden" name="m" value="histori" />-->
            <form action ="?m=histori" method="POST">
            <div class="form-group">                
            <strong>Filter</strong> 
            <select name="filter" id="filter">
            <option value="">Pilih</option>
            <option value="1">Per Tanggal</option>
            <option value="2">Per Bulan</option>
            <option value="3">Per Tahun</option>
            <option value="4">Semua Data</option>

            </select>           
            <strong id="form-tanggal1">Dari
            <input type="date" name="tanggal1" id="tanggal1" class="input-tanggal"  autocomplete="off">
            </strong>
            <strong id="form-tanggal2">Sampai
            <input type="date" name="tanggal2" id="tanggal2" class="input-tanggal"  autocomplete="off">
            </strong>

            <strong id="form-bulan">Bulan
            <select name="bulan" id="bulan">
                <option value="">Pilih</option>
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>
            </strong>
            <strong id="form-tahun">Tahun
            <select name="tahun" id="tahun">
                <option value="">Pilih</option>
                <?php
                $query=mysqli_query($koneksi, "SELECT year(tanggal_input) AS tahun FROM tb_hasil group by year(tanggal_input)");
              while ( $row = mysqli_fetch_array($query)) { ?>
                <option value="<?php echo $row['tahun'];?>"><?php echo $row['tahun'];?></option>'
              <?php  } ?>
            </select>
            </strong>
            </div>
            <div class="btn-group">                  
                <button class="btn btn-primary btn-sm glyphicon glyphicon-filter" type="submit">Filter</button>
            </div>
        
        
        </div>

        </form>
    </div>
    <div class="panel-body">
        <table id="datatables" class="table table-bordered table-hover table-striped table-condensed" width="100%">
        
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
            

if(isset($_POST['filter']) && ! empty($_POST['filter'])){ // Cek apakah user telah memilih filter dan klik tombol tampilkan
                $filter = $_POST['filter']; // Ambil data filder yang dipilih user

            if($filter == '1'){ // Jika filter nya 1 (per tanggal)
                date_default_timezone_set('Asia/Jakarta');
                $tgl = date("Y-m-d", strtotime($_POST['tanggal1']));
                $tgl2 = date("Y-m-d", strtotime($_POST['tanggal2']));

                $ket = 'Data Tanggal '.date('d-m-Y', strtotime($tgl)).' Sampai Dengan ' .date('d-m-Y', strtotime($tgl2));
                $url_cetak = 'histori_cetak.php?filter=1&tanggal='.$tgl.'&tanggal2='.$tgl2;
                $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal WHERE DATE(tb_hasil.tanggal_input) BETWEEN '$tgl' AND '$tgl2'  ORDER BY tanggal_input ASC"); 
                

            }else if($filter == '2'){ // Jika filter nya 2 (per bulan)
                $bulan = $_POST['bulan'];
                $tahun = $_POST['tahun'];
                $nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

                $ket = 'Data Bulan '.$nama_bulan[$bulan].' '.$tahun;
                $url_cetak = 'histori_cetak.php?filter=2&bulan='.$bulan.'&tahun='.$tahun;
                $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal WHERE MONTH(tb_hasil.tanggal_input)='$bulan' AND YEAR(tb_hasil.tanggal_input)='$tahun'  ORDER BY tanggal_input ASC ");  // panggil fungsi transksi bulan dan tahun
            }else if($filter == '3'){ // Jika filter nya 3 (per tahun)
                $tahun = $_POST['tahun'];

                $ket = 'Data Tahun '.$tahun;
                $url_cetak = 'histori_cetak.php?filter=3&tahun='.$tahun;
                 $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal WHERE YEAR(tb_hasil.tanggal_input)='$tahun'  ORDER BY tanggal_input ASC");  // Panggil fungsi transaksi Tahun
            }else { // Jika filter nya 4 (Semua data)
                $url_cetak = 'histori_cetak.php?filter=4';
               $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal  ORDER BY tb_hasil.tanggal_input ASC");
                
            }

        }else{ // Jika user tidak mengklik tombol tampilkan
           $url_cetak = 'histori_cetak.php';
           $rows = mysqli_query($koneksi, "SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal ORDER BY tb_hasil.tanggal_input ASC");
        }
              

                $no=0;

                while ( $row = mysqli_fetch_array($rows)) { 
                    $no++;

                    ?> 
                    
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo date("d/m/Y", strtotime($row['tanggal_input']))?></td>
                    <td>[<?php echo $row['NIPP'] ?>] <?php echo $row['nama_petugas']?></td>
                    <td><?php echo $row['ruas_jalan']?></td>
                    <td><?php echo $row['Loyalitas']?></td>
                    <td><?php echo $row['Tanggungjawab']?></td>
                    <td><?php echo $row['Disiplin'] ?></td>
                    <td><?php echo $row['Status'] ?></td>

                     <td> <?php 
                     $data = $row['NIPP'];
                     $hitungbaik=mysqli_query($koneksi, "SELECT * FROM tb_hasil WHERE Status='Kinerja Baik' AND id_petugas='".$data."'");
                   echo $querybaru = mysqli_num_rows($hitungbaik);
                   ?></td>
                     <td> <?php  
                     $data = $row['NIPP'];
                     $hitungbaik=mysqli_query($koneksi, "SELECT * FROM tb_hasil WHERE Status='Kinerja Buruk' AND id_petugas='".$data."'");
                   echo $querybaru = mysqli_num_rows($hitungbaik);
                   ?></td>
                </tr>
                <?php } ?>
                
             
        </table>

        <div class="row">  
        <div class="col-md-5 col-md-offset-10">                
                <a href="<?php echo $url_cetak; ?>" target="_blank" ><button class="btn btn-default glyphicon glyphicon-print"> Cetak </button></a>
            </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
 <script>
    $(document).ready(function(){ // Ketika halaman selesai di load

        $('#form-tanggal1, #form-tanggal2, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function(){ // Ketika user memilih filter
            if($(this).val() == '1'){ // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal1, #form-tanggal2').show(); // Tampilkan form tanggal
            }else if($(this).val() == '2'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal1, #form-tanggal2').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            }else if($(this).val() == '3'){ // Jika filter nya 2 (per bulan)
                $('#form-tanggal1, #form-tanggal2, #form-bulan').hide(); // Sembunyikan form tanggal
                $('#form-tahun').show();
            }else{ // Jika filternya 3 (per tahun)
                $('#form-tanggal1, #form-tanggal2, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').hide(); // Tampilkan form tahun
            }

       })
    });
    </script>
