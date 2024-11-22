
<div class="row">
    <div class="col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Daftar</strong>
            </div>
            <div class="panel-body">
                <?php if($_POST) include'aksi.php';?>
                <form method="post" action="?m=daftar">
                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input class="form-control input-sm" type="text" name="user" value="<?=$_POST['user']?>"/>
                    </div>
                    <div class="form-group">
                        <label>Password <span class="text-danger">*</span></label>
                        <input class="form-control input-sm" type="password" name="pass" value="<?=$_POST['pass']?>"/>
                    </div>
                    <div class="form-group">
                        <label>Alamat <span class="text-danger">*</span></label>
                        <input class="form-control input-sm" type="text" name="alamat" value="<?=$_POST['alamat']?>"/>
                    </div>
                    <div class="form-group">
                        <label>HP <span class="text-danger">*</span></label>
                        <input class="form-control input-sm" type="text" name="hp" value="<?=$_POST['hp']?>"/>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                        <a href="?m=login" class="btn btn-success btn-sm"> Punya Akun? </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
