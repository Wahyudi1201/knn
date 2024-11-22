<div style="min-height:100px">
</div>        
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Tambah Data Tanggung Jawab dan Disiplin</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                             <?php if($_POST) include'aksi.php';?>
                             <form method="post" action="?m=disiplin_tambah">
                                <div class="form-group">
                                    <label>Tanggal Input <span class="text-danger">*</span></label>
                                    <?php date_default_timezone_set('Asia/Jakarta'); 
                                     $tanggal = date('Y/m/d');
                                    ?>
                                    <input class="form-control input-sm" type="text" name="tanggal" id="tanggal" value="<?= $tanggal ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Nama Petugas <span class="text-danger">*</span></label>
                                    <select class="form-control input-sm js-example-basic-single"   name="id_loyal" id="id_loyal"> 
                                            <option value=""> ==PILIH DATA==</option>
                                            <?php
                                            $rows = $db->get_results("SELECT * FROM tb_loyalparkir where status='0'");
                                            foreach($rows as $row):?>
                                            <option value="<?= $row->id_loyal ?>">[<?= $row->NIPP ?>] <?= $row->nama_petugas ?></option>
                                           <?php endforeach; ?>
                                        </select>
                                </div>
                                 <input class="form-control input-sm" type="hidden" name="idpetugas" id="idpetugas" readonly />
                                  <div class="form-group">
                                    <label> Ruas Jalan <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="text" name="jalan" id="jalan" readonly />
                                </div>
                                <div class="form-group">
                                    <label>Nilai Loyalitas <span class="text-danger">*</span></label>
                                    
                                    <input class="form-control input-sm" type="text" name="loyalitas" id="loyalitas" class="loyali" readonly />
                        
                                </div>
                                <div class="form-group">
                                    <label> Nilai Tanggung Jawab <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="tanggungjawab"/>
                                </div>
                                <div class="form-group">
                                    <label> Nilai Disiplin <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="disiplin"/>
                                </div>
                                <div class="form-group text-right">
                                    <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                                    <a class="btn btn-success btn-sm" href="?m=Disiplin"><span class="glyphicon glyphicon-arrow-left"></span> Kembali </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript">
//select2
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});

//menampilkan data otomatis dengan ajax
$('#id_loyal').change(function(){
    $('.hasil').html($('#id_loyal').val());
var id_loyal = $('#id_loyal').val();
$.ajax({
    url: "aksi_loyal.php",
    data:"id_loyal="+id_loyal,
    success: function(data) {
        var datajson = data,
        objek = JSON.parse(datajson);
        $('#idpetugas').val(objek.idpetugas);
        $('#loyalitas').val(objek.loyalitas);
         $('#jalan').val(objek.jalan);
      }
});
});

</script>