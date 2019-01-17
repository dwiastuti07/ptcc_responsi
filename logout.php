<?php
session_start();
include_once ('template_atas.php');
session_destroy();
	header("location:index.php");
include_once ('template_bawah.php'); 
?>
