<div style="min-height:100px">
</div>
<div class="panel panel-default">
    <div class="panel-heading">
     <strong> Data Nilai Loyalitas </strong>
   </div>
<div class="panel-body">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
          <table id="datatables" class="table table-bordered table-hover table-striped table-condensed" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal </th>
                    <th>Nama Petugas</th>
                     <th>Ruas Jalan</th>
                    <th>Loyalitas</th>
                    <th> <a class="btn btn-default btn-xs" href="?m=loyalitas_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a></th>
                </tr>
            </thead>
            <?php
            $rows = $db->get_results("SELECT * FROM  tb_loyalparkir ORDER BY tanggal_input ASC");
            $no=0;

            foreach($rows as $row):?>
            <tr>
                <td><?=++$no ?></td>
                <td><?=$row->tanggal_input?></td>
                <td>[<?=$row->NIPP?>] <?=$row->nama_petugas?></td>
                 <td><?=$row->ruas_jalan?></td>
                <td><?=$row->loyalitas?></td>
                <td class="nw">
                <?php if($row->status == 0) {?>
                        <a class="btn btn-xs btn-warning" href="?m=loyalitas_ubah&ID=<?=$row->id_loyal?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                    <a class="btn btn-xs btn-danger" href="aksi.php?act=loyalitas_hapus&id_loyal=<?=$row->id_loyal?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span> Hapus </a>
                    <?php }else{ ?>
                        <i class="btn btn-xs btn-primary"> DATA SUDAH DIKUNCI </i> 
                    <?php }?>
                    
                </td>
            </tr>
        <?php endforeach;
        ?>
    </table>
</div>
</div>
