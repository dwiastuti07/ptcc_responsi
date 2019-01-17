<?php 
	error_reporting(E_ALL ^ E_DEPRECATED);
	$host = "localhost";
	$user = "dwast";
	$pass = "dwast";
	$dbName = "toko_ol";
	
	$kon = mysqli_connect($host, $user, $pass);
	if(!$kon)
		die("Gagal koneksi");
	
	$hasil = mysqli_select_db($kon, $dbName);
	if(!$hasil){
		$hasil = mysqli_query($kon, "CREATE DATABASE $dbName");
		if(!$hasil)
			die("Gagal Buat Database");
		else
			$hasil = mysqli_select_db($kon, $dbName);
			if(!$hasil) die("Gagal Konek Database");
	}