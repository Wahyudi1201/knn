
<div class="panel panel-default">
    <div class="panel-heading">
        <strong> Data Testing </strong>
    </div>
    <div class="panel-body">
        <div class="row">
        <div class="col-sm-6 mb-3 mb-sm-0">
       <table  class="table table-bordered table-hover" width="100%">
       
       <tr>
        <th colspan="2"> Upload Data Excel disini : </th>
        </tr>
        <tr>
        <form method="post" enctype="multipart/form-data" action="upload_aksi.php">
        <th height="10px" width="5px"><p><input type="file" name="filepegawai" id="fileToUpload"></p>
        <button class = "btn btn-success btn-sm" type="submit" name="submit"><span class="glyphicon glyphicon-upload"></span> Upload File </button>        
        </form>
        <a class="btn btn-danger btn-sm" href="aksi_hapusall.php" onclick="return confirm('Hapus Semua data?')"><span class="glyphicon glyphicon-trash"></span> Hapus Semua Data </a></th>
        </tr>
        <tr>
        <th height="10px"></th>
        </tr>
        </table>  
                       
            </div>
            <div class="col-sm-12 col-xs-12">
                <table id="datatables" class="table table-bordered table-hover table-striped table-condensed" width="100%">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Petugas</th>
                            <th>Ruas Jalan</th>
                            <th>Loyalitas</th>
                            <th>Tanggung Jawab </th>
                            <th>Disiplin</th>
                             <th>Status</th>
                        </tr>
                    </thead>
                    <?php
                    $q = esc_field($_GET['q']);
                    $rows = $db->get_results("SELECT * FROM tb_datatesting");
                    $no=1;
                    foreach($rows as $row):?>
                    <tr>
                        <td><?=$no++; ?></td>
                        <td><?=$row->nama_petugas ?></td>
                        <td><?=$row->ruas_jalan?></td>
                         <td><?=$row->Loyalitas?></td>
                          <td><?=$row->Tanggungjawab?></td>
                          <td><?=$row->Disiplin?></td>
                        <td><?= $row->Status ?></td>
                    </tr>
                <?php endforeach;
                ?>
            </table>
        </div>
    </div>
</div>
</div>