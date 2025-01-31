<?php 

	include "../config/config.php";
	
	$id = $_GET['id'];

	$sql = mysqli_query($con, "DELETE FROM tbl_users WHERE id_user='$id'");

	if($sql) {
		echo "<script>alert('Berhasil Menghapus')</script>";
        if($id == $_SESSION['id']) {
            session_destroy();
            echo "<script>window.location.href='index.php'</script>";
        }else{
            echo "<script>window.location.href='index.php?page=lihat-akun'</script>";
        }
	}

 ?>