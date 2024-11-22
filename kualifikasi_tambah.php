<div style="min-height:100px">
</div>        
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Kualifikasi Data Metode K-NN </strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                             <form method="post" action="aksi_knn.php">
                                <div class="form-group">
                                    <label>Tanggal Input <span class="text-danger">*</span></label>
                                    <?php date_default_timezone_set('Asia/Jakarta'); 
                                    $tanggal = date('Y/m/d');
                                    ?>
                                    <input class="form-control input-sm" type="text" name="tanggal" id="tanggal" value="<?= $tanggal ?>"/>
                                </div>
                                 <div class="form-group">
                                    <label>Nilai K <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="nilai" id="nilai" />
                                </div>
                                <div class="form-group">
                                    <label>Nama Petugas <span class="text-danger">*</span></label>
                                    <select class="form-control input-sm"   name="id_loyal" id="id_loyal"> 
                                            <option value=""> ==PILIH DATA==</option>
                                            <?php
                                            $rows = $db->get_results("SELECT tb_loyalparkir.nama_petugas, tb_loyalparkir.NIPP, tb_uji.id_loyal, tb_uji.Status FROM tb_uji  INNER JOIN tb_loyalparkir ON tb_uji.id_loyal = tb_loyalparkir.id_loyal WHERE tb_uji.Status='0'");
                                            foreach($rows as $row):?>
                                            <option value="<?= $row->id_loyal ?>">[<?= $row->NIPP ?>] <?= $row->nama_petugas?>  <?php if($row->Status == '1') { ?> | [SUDAH DIUJI] <?php }else{ ?>   <?php } ?></i></option>
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
    </div>    


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