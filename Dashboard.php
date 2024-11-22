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
     <link href="assets/css/mycss.css" rel="stylesheet"/>

    <!-- Datatables -->
    <link href="assets/datatables/css/jquery.dataTables.min.css" rel="stylesheet"/> 
    <link rel="stylesheet" type="text/css" href="assets/datatables/css/responsive.dataTables.min.css">
    <!-- End Datatables -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>           
</head>
<body>
   <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <div class="hidden-xs">
            <a class="navbar-brand class="<?=($mod=='home') ? 'active' : ''?>"" href="?"><span><img src="assets/images/logo/logo.png" width="40px;" style="margin-top:-9px;"> Dinas Perhubungan Kab. Asahan</span></a>
        </div>
        <div class="hidden-lg hidden-md hidden-sm">
          <a class="navbar-brand class="<?=($mod=='home') ? 'active' : ''?>"" href="?"><span><img src="assets/images/logo/logo.png" width="35px;" style="margin-top:-12px;">Dinas Perhubungan Kab. Asahan </span></a>
      </div>
  </div>
  <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <?php if($_SESSION['level']== 'admin'):?>
           <li class="<?=($mod=='datatesting') ? : ''?>"><a href="Dashboard.php"><img src="assets/images/icon/icon_gejala.png" width="32px;"> Dashboard </a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" ><img src="assets/images/icon/icon_daftar.png" width="32px;"> Data Menu </a>
            <ul class="dropdown-menu">
            <li class="<?=($mod=='petugas') ? 'active' : ''?>"><a href="?m=petugas" > Data Petugas </a></li>
            <li class="<?=($mod=='datatesting') ? 'disable' : ''?>"><a href="?m=datatesting" disable> Data Training </a></li>
            <li class="<?=($mod=='loyalitas') ? 'active' : ''?>"><a href="?m=loyalitas"> Input Nilai Loyalitas</a></li>
             <li class="nav-link disabled"><a> Input Nilai Tanggung jawab & Disiplin </a></li>
            <li class="nav-link disabled"><a>Kualifikasi Data Juru Parkir</a></li> 
            </ul>
            </li>
             <li class="nav-link disabled"><a><img src="assets/images/icon/icon_histori.png" width="32px;"> Laporan Keseluruhan </a></li> 
            <li class="<?=($mod=='visi') ? 'active' : ''?>"><a href="?m=visi"><img src="assets/images/icon/icon_penyakit.png" width="32px;"> Visi & Misi</a></li>
            <li class="<?=($mod=='password') ? 'active' : ''?>"><a href="?m=password"><img src="assets/images/icon/icon_gantipassword.png" width="32px;"> Password</a></li>
            <li><a href="aksi.php?act=logout"><img src="assets/images/icon/icon_logout.png" width="32px;"> Logout</a></li>
        
        <?php endif?>  

        <?php if($_SESSION['level']== 'kabag'):?>
           <li class="<?=($mod=='datatesting') ? 'active' : ''?>"><a href="Dashboard.php"><img src="assets/images/icon/icon_gejala.png" width="32px;"> Dashboard </a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" ><img src="assets/images/icon/icon_daftar.png" width="32px;"> Data Menu </a>
            <ul class="dropdown-menu">
             <li class="nav-link disabled"><a> Data Petugas </a></li>
            <li class="nav-link disabled"><a> Data Training </a></li>
            <li class="nav-link disabled"><a> Input Nilai Loyalitas</a></li>
              <li class="nav-link disabled"><a> Input Nilai Tanggung jawab & Disipin</a></li>
            <li class="nav-link disabled"><a> Kualifikasi Data Juru Parkir </a></li> 
            </ul>
            </li>
            <li class="<?=($mod=='histori') ? 'active' : ''?>"><a href="?m=histori"><img src="assets/images/icon/icon_penyakit.png" width="32px;"> Laporan Keseluruhan </a></li> 
             <li class="<?=($mod=='visi') ? 'active' : ''?>"><a href="?m=visi"><img src="assets/images/icon/icon_penyakit.png" width="32px;"> Visi & Misi</a></li>
            <li class="<?=($mod=='password') ? 'active' : ''?>"><a href="?m=password"><img src="assets/images/icon/icon_gantipassword.png" width="32px;"> Password</a></li>
            <li><a href="aksi.php?act=logout"><img src="assets/images/icon/icon_logout.png" width="32px;"> Logout</a></li>
        <?php endif?>    

        <?php if($_SESSION['level']== 'kasi'):?>
           <li class="<?=($mod=='datatesting') ? 'active' : ''?>"><a href="Dashboard.php"><img src="assets/images/icon/icon_gejala.png" width="32px;"> Dashboard </a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false" ><img src="assets/images/icon/icon_daftar.png" width="32px;"> Data Menu </a>
            <ul class="dropdown-menu">
            <li class="nav-link disabled"><a> Data Petugas </a></li>
            <li class="nav-link disabled"><a> Data Training </a></li>
            <li class="nav-link disabled"><a> Input Nilai Loyalitas</a></li>
              <li class="<?=($mod=='disiplin') ? 'active' : ''?>"><a href="?m=disiplin"> Input Nilai Tanggung jawab & Disipin</a></li>
            <li class="<?=($mod=='kualifikasi_tambah') ? 'active' : ''?>"><a href="?m=kualifikasi_tambah"> Kualifikasi Data Juru Parkir </a></li> 
            </ul>
            </li>
            <li class="nav-link disabled"><a><img src="assets/images/icon/icon_penyakit.png" width="32px;"> Laporan Keseluruhan </a></li> 
             <li class="<?=($mod=='visi') ? 'active' : ''?>"><a href="?m=visi"><img src="assets/images/icon/icon_histori.png" width="32px;"> Visi & Misi</a></li>
            <li class="<?=($mod=='password') ? 'active' : ''?>"><a href="?m=password"><img src="assets/images/icon/icon_gantipassword.png" width="32px;"> Password</a></li>
            <li><a href="aksi.php?act=logout"><img src="assets/images/icon/icon_logout.png" width="32px;"> Logout</a></li>
        <?php endif?> 
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
        include 'jumbotron.php';
    ?>

<footer class="footer bg-primary">
  <div class="container text-center">
    <p>Copyright &copy; <?=date('Y')?> Jalan Abdi Setia Bakti Sei Renggas, Kec. Kota Kisaran Barat Kab. Asahan - 21211 </p>
</div>
</footer>




<!-- <SCRIPT DATATABLES> -->
<script type="text/javascript" src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/datatables/js/dataTables.bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/datatables/js/dataTables.responsive.min.js"></script> 

<!-- <END DATATABLES> -->

<!-- SELECT2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- END SELECT2 -->

<script type="text/javascript">
  $(document).ready(function() {
    $('#datatables').DataTable({
      responsive: true
  });
});
</script>
</body>
</html>