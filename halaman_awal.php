<?php
session_start();
include_once ('template_atas.php');
if(!isset ($_SESSION["user"])){
	echo "Sesi Sudah Habis!<br>
	<a href='login_form.php'>LOGIN LAGI</a>";;
	exit;
}
echo "SELAMAT DATANG <br>";
echo "USER : ".$_SESSION["user"]."<br>";
echo "NAMA : ".$_SESSION["nama_lengkap"]."<br>";
?>

<?php include_once ('template_bawah.php'); ?>	