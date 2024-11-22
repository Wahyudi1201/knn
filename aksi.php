<?php
require_once'functions.php';
    
//LOGIN 
if ($mod=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    
    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION['login'] = $row->user;
        $_SESSION['id_user'] = $row->id_user;
        $_SESSION['level'] = $row->level;
        redirect_js("Dashboard.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }          
} elseif($act=='logout'){
     unset($_SESSION['login'], $_SESSION['level'], $_SESSION['id_user']);
    header("location:index.php");

//UBAHPASSWORD
}elseif ($mod=='password'){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];
    
    $row = $db->get_row("SELECT * FROM tb_user WHERE user='$_SESSION[login]' AND pass='$pass1'");        
    
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg('Field bertanda * harus diisi.');
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif( $pass2 != $pass3 )
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE tb_user SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
}

//USER BARU
elseif($mod=='daftar'){
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $alamat = $_POST['alamat'];
    $hp = $_POST['hp'];
        
    if($user=='' || $pass=='' || $alamat=='' || $hp=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_user WHERE user='$user'"))
        print_msg("User sudah ada!");
    else{
        $db->query("INSERT INTO tb_user (user, pass, alamat, hp, level) 
            VALUES ('$user', '$pass', '$alamat', '$hp', 'petani')");  
        alert('Pendaftaran berhasil, silahkan login untuk melanjutkan!');                     
        redirect_js("index.php?m=login");
    }
} 

//LOYALITAS
elseif($mod=='loyalitas_tambah'){
  $tanggal = $_POST['tanggal'];
    $nipp = $_POST['idtest'];
    $nama = $_POST['nama'];
    $jalan = $_POST['jalan'];
	$loyalitas = $_POST['loyalitas'];
    if($nama=='' ||$loyalitas=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else{
        $db->query("INSERT INTO tb_loyalparkir (tanggal_input, nipp, nama_petugas, ruas_jalan, loyalitas, status) VALUES ('$tanggal', '$nipp', '$nama', '$jalan', '$loyalitas', '0')");                       
        redirect_js("Dashboard.php?m=loyalitas");
    }
} else if($mod=='loyalitas_ubah'){
   $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $jalan = $_POST['jalan'];
    $loyalitas = $_POST['loyalitas'];
    if($nama=='' || $loyalitas=='' )
        print_msg("Field yang bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_loyalparkir SET tanggal_input='$tanggal', nama_petugas='$nama', ruas_jalan='$jalan', loyalitas='$loyalitas' WHERE id_loyal='$_GET[ID]'");
         redirect_js("Dashboard.php?m=loyalitas");
    }
} else if ($act=='loyalitas_hapus'){
    $db->query("DELETE FROM tb_loyalparkir WHERE id_loyal='$_GET[id_loyal]'");
    header("location:Dashboard.php?m=loyalitas");
} 

//TANGGUNGJAWAB DAN DISIPLIN   
if($mod=='disiplin_tambah'){
     $tanggal = $_POST['tanggal'];
    $id_loyal = $_POST['id_loyal'];
     $jalan = $_POST['jalan'];
    $loyalitas = $_POST['loyalitas'];
    $Tanggungjawab = $_POST['tanggungjawab'];
    $disiplin = $_POST['disiplin'];
     $id_petugas = $_POST['idpetugas'];

    
    if($disiplin=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_uji WHERE id_loyal='$id_loyal'"))
        print_msg("Data sudah ada!");
    else{
        $db->query("INSERT INTO tb_uji (tanggal_input, id_loyal, id_petugas, ruas_jalan, Loyalitas, Tanggungjawab, Disiplin, Status) VALUES ('$tanggal', '$id_loyal','$id_petugas','$jalan', '$loyalitas', '$Tanggungjawab', '$disiplin', '0')");                       
        $db->query("UPDATE tb_loyalparkir SET status='1' WHERE id_loyal='$id_loyal'");
        redirect_js("Dashboard.php?m=disiplin");

    }    
    // mengubah nilai data disiplin dan tanggungjawab                
} else if($mod=='disiplin_ubah'){
    $Tanggungjawab = $_POST['tanggungjawab'];
    $disiplin = $_POST['disiplin'];


    if($Tanggungjawab=='' || $disiplin=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        //ubah nilai
        $db->query("UPDATE tb_uji SET Tanggungjawab='$Tanggungjawab', Disiplin='$disiplin' WHERE id_uji='$_GET[ID]'");
        redirect_js("Dashboard.php?m=disiplin");
    }    
//hapus data
} else if ($act=='disiplin_hapus'){
    $db->query("DELETE FROM tb_uji WHERE id_uji ='$_GET[ID]'");
     $db->query("UPDATE tb_loyalparkir SET status='0' WHERE id_loyal='$_GET[ID_LOYAL]'");
    header("location:Dashboard.php?m=disiplin");
} 

//NAMA PETUGAS   
if($mod=='petugas_tambah'){
     $nama_petugas = $_POST['nama_petugas'];
     $jalan = $_POST['jalan'];
       
    if($nama_petugas=='' || $jalan=='' ){
        print_msg("Field bertanda * tidak boleh kosong!");
    }
    else{
        $db->query("INSERT INTO tb_petugas (nama_petugas, ruas_jalan) VALUES ('$nama_petugas', '$jalan')");
        redirect_js("Dashboard.php?m=petugas");

    }    
    // mengubah nilai data disiplin dan tanggungjawab                
} else if($mod=='petugas_ubah'){
     $nama_petugas = $_POST['nama_petugas'];
     $jalan = $_POST['jalan'];
       
    if($nama_petugas=='' || $jalan=='' ){
        print_msg("Field bertanda * tidak boleh kosong!");
    }else{
        //ubah nilai
        $db->query("UPDATE tb_petugas SET nama_petugas='$nama_petugas', ruas_jalan='$jalan' WHERE id_petugas='$_GET[ID]'");
        redirect_js("Dashboard.php?m=petugas");
    }    
//hapus data
} else if ($act=='petugas_hapus'){
    $db->query("DELETE FROM tb_petugas WHERE id_petugas ='$_GET[ID]'");
    header("location:Dashboard.php?m=petugas");
} 
?>
