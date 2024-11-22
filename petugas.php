<div style="min-height:100px">
</div>
<div class="panel panel-default">
    <div class="panel-heading">
     <strong> Data Petugas Parkir </strong>
   </div>
<div class="panel-body">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
          <table id="datatables" class="table table-bordered table-hover table-striped table-condensed" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Petugas</th>
                     <th>Ruas Jalan</th>
                    <th> <a class="btn btn-default btn-xs" href="?m=petugas_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a></th>
                </tr>
            </thead>
            <?php
            $rows = $db->get_results("SELECT * FROM  tb_petugas ORDER BY id_petugas DESC");
            $no=0;

            foreach($rows as $row):?>
            <tr>
                <td><?=++$no ?></td>
                <td><?=$row->nama_petugas?></td>
                 <td><?=$row->ruas_jalan?></td>
                <td class="nw">
                    <a class="btn btn-xs btn-warning" href="?m=petugas_ubah&ID=<?=$row->id_petugas?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=petugas_hapus&ID=<?=$row->id_petugas?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus </a>                   
                </td>
            </tr>
        <?php endforeach;
        ?>
    </table>
</div>
</div>
