<?php
$row = $db->get_row("SELECT * FROM tb_petugas WHERE id_petugas='$_GET[ID]'"); 
?>
<div style="min-height:100px">
</div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Ubah Data Petugas Parkir </strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <?php if($_POST) include'aksi.php';?>
                                <form method="post" action="?m=petugas_ubah&ID=<?=$row->id_petugas?>">
                                    <div class="form-group">
                                    <label>Nama Petugas<span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="text" name="nama_petugas" id="nama_petugas" value="<?=$row->nama_petugas?>"/>
                                </div>
                                    <div class="form-group">
                                        <label>Ruas Jalan<span class="text-danger">*</span></label>
                                        <input class="form-control input-sm" type="text" name="jalan" id="jalan" value="<?=$row->ruas_jalan?>"/>
                                    </div>
                                    <div class="form-group text-right">
                                        <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan </button>
                                        <a class="btn btn-success btn-sm" href="?m=petugas"><span class="glyphicon glyphicon-arrow-left"></span> Kembali </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>