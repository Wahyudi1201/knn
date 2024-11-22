        <?php
$row = $db->get_row("SELECT tb_loyalparkir.nama_petugas, tb_uji.id_uji, tb_uji.id_loyal, tb_uji.tanggal_input, tb_uji.Loyalitas, tb_uji.ruas_jalan, tb_uji.Tanggungjawab, tb_uji.Disiplin FROM tb_uji  JOIN tb_loyalparkir ON tb_uji.id_loyal = tb_loyalparkir.id_loyal  WHERE id_uji='$_GET[ID]'"); 
?>
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
                             <form method="post" action="?m=disiplin_ubah&ID=<?=$row->id_uji?>">
                                <div class="form-group">
                                    <label>Tanggal Input <span class="text-danger">*</span></label>
                                    <?php date_default_timezone_set('Asia/Jakarta'); 
                                    $tanggal = date('d/m/Y');
                                    ?>
                                    <input class="form-control input-sm" type="text" name="tanggal" id="tanggal" value="<?= $tanggal ?>"/>
                                </div>
                                <div class="form-group">
                                    <label>Nama Petugas <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="text" name="id_loyal" id="id_loyal" value="<?= $row->nama_petugas ?>" readonly />
                                </div>
                                  <div class="form-group">
                                    <label> Ruas Jalan <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="text" name="jalan" id="jalan" value="<?= $row->ruas_jalan ?>"readonly />
                                </div>
                                <div class="form-group">
                                    <label>Nilai Loyalitas <span class="text-danger">*</span></label>
                                    
                                    <input class="form-control input-sm" type="text" name="loyalitas" id="loyalitas" class="loyali" value="<?= $row->Loyalitas ?>" readonly />
                        
                                </div>
                                <div class="form-group">
                                    <label> Nilai Tanggung Jawab <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="tanggungjawab" value="<?= $row->Tanggungjawab ?>"/>
                                </div>
                                <div class="form-group">
                                    <label> Nilai Disiplin <span class="text-danger">*</span></label>
                                    <input class="form-control input-sm" type="number" name="disiplin" value="<?= $row->Disiplin?>"/>
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