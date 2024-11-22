<div style="min-height:100px">
</div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Tambah Loyalitas</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <?php if($_POST) include'aksi.php';?>
                                <form method="post" action="?m=loyalitas_tambah">
                                    <div class="form-group">
                                        <label>Tanggal Input <span class="text-danger">*</span></label>
                                        <?php date_default_timezone_set('Asia/Jakarta'); 
                                    $tanggal = date('Y/m/d');
                                    ?>
                                    <input class="form-control input-sm" type="text" name="tanggal" id="tanggal" value="<?= $tanggal ?>"/>
                                    </div>
                                    <div class="form-group">
                                    <label>Nama Petugas <span class="text-danger">*</span></label>
                                    <select class="form-control input-sm js-example-basic-single"   name="idtest" id="idtest"> 
                                            <option value=""> ==PILIH DATA==</option>
                                            <?php
                                            $rows = $db->get_results("SELECT * FROM tb_petugas");
                                            foreach($rows as $row):?>
                                            <option value="<?= $row->id_petugas ?>"> [ <?= $row->id_petugas ?> ] <?= $row->nama_petugas ?></option>
                                           <?php endforeach; ?>
                                        </select>
                                </div>
                                <!--<span class="hasil"></span>-->
                                  <input class="form-control input-sm" type="hidden" name="nama" id="nama"/>
                                    <div class="form-group">
                                        <label>Ruas Jalan<span class="text-danger">*</span></label>
                                        <input class="form-control input-sm" type="text" name="jalan" id="jalan" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>Loyalitas<span class="text-danger">*</span></label>
                                        <input class="form-control input-sm" type="text" name="loyalitas"/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan </button>
                                        <a class="btn btn-success btn-sm" href="?m=loyalitas"><span class="glyphicon glyphicon-arrow-left"></span> Kembali </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});


$('#idtest').change(function(){
    $('.hasil').html($('#idtest').val());
var id_petugas = $('#idtest').val();
$.ajax({
    url: "aksi_tampilpetugas.php",
    data:"id_petugas=" +id_petugas,
    success: function(data) {
        var datajson = data,
        objek = JSON.parse(datajson);
         $('#nama').val(objek.nama);
         $('#jalan').val(objek.jalan);
      }
});
});
</script>