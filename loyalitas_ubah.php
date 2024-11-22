<?php
$row = $db->get_row("SELECT * FROM tb_loyalparkir WHERE id_loyal='$_GET[ID]'"); 
?>
<div style="min-height:100px">
</div>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
               <strong> Ubah Penyakit </strong>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <?php if($_POST) include'aksi.php';?>
                        <form method="post" action="?m=loyalitas_ubah&ID=<?=$row->id_loyal?>">
                              <div class="form-group">
                                        <label>Tanggal Input <span class="text-danger">*</span></label>
                                        <input class="form-control input-sm" type="text" name="tanggal" value="<?=$row->tanggal_input?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Petugas Parkir <span class="text-danger">*</span></label>
                                        <input class="form-control input-sm" type="text" name="nama" value="<?=$row->nama_petugas?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Ruas Jalan <span class="text-danger">*</span></label>
                                        <input class="form-control input-sm" type="text" name="jalan" value="<?=$row->ruas_jalan?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Loyalitas<span class="text-danger">*</span></label>
                                        <input class="form-control input-sm" type="text" name="loyalitas" value="<?=$row->loyalitas?>"/>
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