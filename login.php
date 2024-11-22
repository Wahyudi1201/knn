<div style="min-height:90px">
</div>
<div class="col-md-4 col-md-offset-4">
  <center><img src="assets/images/logo/dishub.jpg" width="105px;" style="margin-bottom: 10px" ></center>
</div>
<div class="row">
    <div class="col-md-4 col-md-offset-4">  
        <div class="panel panel-default">
            <div class="panel-heading text-left">
                <strong><center>Login</center></strong> 
            </div>
            <div class="panel-body">
                <?php if($_POST) include 'aksi.php'; ?>
                <form class="form-signin" action="?m=login" method="post">                        
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control input-sm" placeholder="Username" name="user" autofocus />
                    </div>
                    <div class="form-group">            
                        <label>Password</label>
                        <input type="password" id="inputPassword" class="form-control input-sm" placeholder="Password" name="pass" />
                    </div>      
                    <div class="form-group text-center">                
                        <button class="btn btn-primary btn-block btn-sm" type="submit"><span class="glyphicon glyphicon-log-in"></span> Masuk</button>   
                    </div>        
                </form>      
            </div>
        </div>
    </div>
</div>