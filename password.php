<div style="min-height:100px">
</div>
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
              <strong> Ubah Password</strong>
           </div>
           <div class="panel-body">
               <div class="row">
                   <div class="col-sm-12">
                    <?php if($_POST) include'aksi.php';?>
                    <form method="post" action="?m=password&act=password_ubah">
                        <div class="form-group">
                            <label>Password Lama <span class="text-danger">*</span></label>
                            <input class="form-control input-sm" type="password" name="pass1"/>
                        </div>
                        <div class="form-group">
                            <label>Password Baru <span class="text-danger">*</span></label>
                            <input class="form-control input-sm" type="password" name="pass2"/>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input class="form-control input-sm" type="password" name="pass3"/>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>