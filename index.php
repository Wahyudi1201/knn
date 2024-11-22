<?php
include'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="assets/images/logo/logo.png"/>

    <title>Data Mining Metode KNN </title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>

    <!-- Datatables -->
    <link href="assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet"/> 
    <link rel="stylesheet" type="text/css" href="assets/datatables/css/responsive.dataTables.min.css">
    <!-- End Datatables -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>           
</head>
<body>
   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="hidden-xs">
            <a class="navbar-brand class="<?=($mod=='home') ? 'active' : ''?>"" href="?"><span><img src="assets/images/logo/logo.png" width="40px;" style="margin-top:-9px;"> Dinas Perhubungan Kab. Asahan </span></a>
        </div>
        <div class="hidden-lg hidden-md hidden-sm">
          <a class="navbar-brand class="<?=($mod=='home') ? 'active' : ''?>"" href="?"><span><img src="assets/images/logo/logo.png" width="35px;" style="margin-top:-12px;"> Dinas Perhubungan Kab. Asahan </span></a>
      </div>
  </div>
  <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        
            <li class="<?=($mod=='tentangkami') ? 'active' : ''?>"><a href="?m=tentangkami"><img src="assets/images/icon/icon_pakar.png" width="32px;"> Tentang Kami </a></li>  
            <!--<li class="<?=($mod=='daftar') ? 'active' : ''?>"><a href="?m=daftar"><img src="assets/images/icon/icon_daftar.png" width="32px;"> Daftar</a></li> -->         
         
    </ul>          
    <div class="navbar-text"></div>          
</div>
</div>
</nav>

    <?php
    if(in_array($mod, array('sanksi', 'pelanggaran', 'peraturan', 'password')) && !$_SESSION["login"])
        redirect_js('?m=login');
    if(file_exists($mod.'.php'))
        include $mod.'.php';
    else
        include 'login.php';
    ?>






<!-- <SCRIPT DATATABLES> -->
<script type="text/javascript" src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/datatables/js/dataTables.bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/datatables/js/dataTables.responsive.min.js"></script> 
<!-- <END DATATABLES> -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatables').DataTable({
      responsive: true
  });
} );
</script>

<footer class="footer bg-primary">
  <div class="container text-center">
    <p>Copyright &copy; <?=date('Y')?> Aplikasi Data Mining dengan Metode K- Nearest Neighbor(K-NN)</p>
</div>
</footer>
</body>
</html>