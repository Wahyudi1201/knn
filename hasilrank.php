      <div style="min-height:100px">
</div>  
        <div class="row">
            <div class="col-sm-6 mb-3 col-sm-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Kualifikasi Data Metode K-NN </strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-11 mb-3 mb-sm-0">
                             <form method="post" action="aksi_knn.php">
                                <div class="form-group">
                                    <label>Tanggal Input <span class="text-danger">*</span></label>
                                    <?php date_default_timezone_set('Asia/Jakarta'); 
                                    $tanggal = date('d/m/Y');
                                    ?>
                                    <input class="form-control input-sm" type="text" name="tanggal" id="tanggal" value="<?= $tanggal ?>" />
                                </div>
                                 <div class="form-group">
                                    <label>Nilai K <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="nilai" id="nilai"/>
                                </div>
                                <div class="form-group">
                                    <label>Nama Petugas <span class="text-danger">*</span></label>
                                    <select class="form-control input-sm"   name="id_loyal" id="id_loyal"> 
                                            <option value=""> ==PILIH DATA==</option>
                                            <?php
                                            $rows = $db->get_results("SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_uji.id_loyal, tb_uji.Status FROM tb_uji  INNER JOIN tb_loyalparkir ON tb_uji.id_loyal = tb_loyalparkir.id_loyal WHERE tb_uji.Status='0'");
                                            foreach($rows as $row):?>
                                            <option value="<?= $row->id_loyal ?>">[<?= $row->NIPP ?>] <?= $row->nama_petugas ?>  <?php if($row->Status == '1') { ?> | [Sudah diuji] <?php }else{ ?>   <?php } ?></option>
                                           <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Ruas Jalan <span class="text-danger">*</span></label>
                                    
                                    <input class="form-control input-sm" type="text" name="jalan" id="jalan" readonly />
                                    <input class="form-control input-sm" type="hidden" name="id_petugas" id="id_petugas" />
                        
                                </div>
                                <div class="form-group">
                                    <label>Loyalitas <span class="text-danger">*</span></label>
                                           <input class="form-control input-sm" type="text" name="loyalitas" id="loyalitas" class="loyali" readonly />
                                </div>
                                 <div class="form-group">
                                    <label> Nilai Tanggung Jawab <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="tanggungjawab" id="tanggungjawab" readonly />
                                </div>
                            
                                <div class="form-group">
                                    <label> Nilai Disiplin <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="disiplin" id="disiplin" readonly/>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" id="simpan" name="simpan"></span> Kualifikasi</button>
                                    <a class="btn btn-success btn-sm" href="?m=histori"><span class="glyphicon glyphicon-list-alt"></span>  Lihat Data </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 mb-3 col-sm-offset-0">
<div class="panel panel-default">
    <div class="panel-heading">
        <strong> Kualifikasi Data Metode K-NN </strong>
                    </div>
<div class="panel-body">
    <table class="table table-bordered " width="100%">
                <thead>
                <b> HASIL PERHITUNGAN</b> : 
                <?php
                $rows = $db->get_results("SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.nilaik, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal ORDER BY id_hasil DESC limit 1");
                $no=0;

                foreach($rows as $row):?>
                [Nilai K =  <?= $row->nilaik ?>]<br>
                <?php endforeach; ?>
                <?php
                $rows = $db->get_results("SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal ORDER BY id_hasil DESC limit 1");
                $no=0;

                foreach($rows as $row):?>
                    <tr>
                        <th>Id Petugas</th>
                        <td><?=$row->NIPP?></td>
                    </tr>
                    <tr>
                        <th>Nama Petugas</th>
                         <td><b><?=$row->nama_petugas?></b></td>
                    </tr>
                    <tr>
                        <th>Loyalitas</th>
                         <td><?=$row->Loyalitas?></td>
                    </tr>
                    <tr>
                        <th>Tanggung Jawab</th>
                         <td><?=$row->Tanggungjawab?></td>
                    </tr>
                    <tr>
                        <th> Disiplin </th>
                        <td><?= $row->Disiplin ?></td>
                    </tr>
                    <tr>
                        <th> Status </th>
                        <td><b><?= $row->Status ?></b></td>
                    </tr>

                <?php endforeach; ?>  
            </thead>
        </table>
  </div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div> 
</div>
</div>


<!--<div class="panel-body">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
             <table class="table table-bordered " width="100%">

                <thead>
                <b> JARAK TERDEKAT </b> : <?= $_POST['nilaik'] ?><br>
                    <tr>
                        <th>No</th>
                        <th>NIPP</th>
                        <th>Nama Petugas</th>
                        <th>Loyalitas</th>
                        <th>Tanggung Jawab</th>
                        <th> Disiplin </th>
                        <th> Status </th>
                    </tr>
                </thead>
                <?php
                $q = esc_field($_GET['q']);
                $rows = $db->get_results("SELECT * FROM tb_kesimpulan");
                $no=0;

                foreach($rows as $row):?>
                <tr>
                    <td><?=++$no ?></td>
                    <td><?=$row->NIPP?></td>
                    <td><?=$row->nama_petugas?></td>
                    <td><?=$row->Loyalitas?></td>
                    <td><?=$row->Tanggungjawab?></td>
                    <td><?= $row->Disiplin ?></td>
                    <td><?= $row->Status ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</div>
</div>-->

<!--<div class="panel-body">
        <div class="row">
            <div class="col-sm-12 col-xs-12">
             <table class="table table-bordered " width="100%">

                <thead>

                <b> HASIL PERHITUNGAN</b> : 
                <?php
                $rows = $db->get_results("SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.nilaik, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal ORDER BY id_hasil DESC limit 1");
                $no=0;

                foreach($rows as $row):?>
                [Nilai K =  <?= $row->nilaik ?>]<br>
                <?php endforeach; ?>
                    <tr>
                        <th>No</th>
                        <th>NIPP</th>
                        <th>Nama Petugas</th>
                        <th>Loyalitas</th>
                        <th>Tanggung Jawab</th>
                        <th> Disiplin </th>
                        <th> Status </th>
                    </tr>
                </thead>
                <?php
                $rows = $db->get_results("SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_hasil.Status, tb_hasil.tanggal_input, tb_hasil.Loyalitas, tb_hasil.ruas_jalan, tb_hasil.Tanggungjawab, tb_hasil.Disiplin FROM tb_hasil  JOIN tb_loyalparkir ON tb_hasil.id_loyal = tb_loyalparkir.id_loyal ORDER BY id_hasil DESC limit 1");
                $no=0;

                foreach($rows as $row):?>
                <tr>
                    <td><?=++$no ?></td>
                    <td><?=$row->NIPP?></td>
                    <td><?=$row->nama_petugas?></td>
                    <td><?=$row->Loyalitas?></td>
                    <td><?=$row->Tanggungjawab?></td>
                    <td><?= $row->Disiplin ?></td>
                    <td><?= $row->Status ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

</div>
</div>-->
    

<script type="text/javascript">

$('#id_loyal').change(function(){
    $('.hasil').html($('#id_loyal').val());
var id_loyal = $('#id_loyal').val();
$.ajax({
    url: "aksi_tampiluji.php",
    data:"id_loyal="+id_loyal,
    success: function(data) {
        var datajson = data,
        objek = JSON.parse(datajson);
        $('#jalan').val(objek.ruas);
        $('#loyalitas').val(objek.loyalitas);
        $('#tanggungjawab').val(objek.Tanggungjawab);
        $('#disiplin').val(objek.Disiplin);
         $('#id_petugas').val(objek.id_petugas);
      }
});
});

</script>