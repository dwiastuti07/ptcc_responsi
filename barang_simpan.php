<?php
	include_once ('template_atas.php');
	if (isset($_POST['idbarang'])) {
		$idbarang	= $_POST['idbarang'];
		$foto_lama	= $_POST['foto_lama'];
		$simpan 	= "EDIT";
	}else{
		$simpan = "BARU";
	}
	$nama		= $_POST['nama'];
	$harga		= $_POST['harga'];
	$stok		= $_POST['stok'];
	$foto		= $_FILES['foto']['name'];
	$tmpName	= $_FILES['foto']['tmp_name'];
	$size		= $_FILES['foto']['size'];
	$type		= $_FILES['foto']['type'];

	$maxsize	= 1500000;
	$typeYgBoleh = array("image/jpeg","image/png","image/pjpeg");

	$dirFoto	= "pict";
	if (!is_dir($dirFoto))
		mkdir($dirFoto);
	$fileTujuanFoto = $dirFoto."/".$foto;

	$dirThumb	= "thumb";

	if (!is_dir($dirThumb)) 
		mkdir($dirThumb);
	$fileTujuamThumb	= $dirThumb."/t_".$foto;

	$dataValid="YA";

	if ($size > 0) {
		if ($size > $maxsize){
			echo "Ukuran File Terlalu Besar <br />";
			$dataValid = "TIDAK";
		}
		if (!in_array($type, $typeYgBoleh)) {
			echo "Type File Tidak Dikenal <br />";
			$dataValid = "TIDAK";
		}
	}

	if(strlen(trim($nama))==0){
		echo "Nama Barang Harus Diisi! <br />";
		$dataValid = "TIDAK";
	}
	if(strlen(trim($harga))==0){
		echo "Harga Harus Diisi! <br />";
		$dataValid = "TIDAK";
	}
	if(strlen(trim($stok))==0){
		echo "Stok Harus Diisi! <br />";
		$dataValid = "TIDAK";
	}
	if ($dataValid == "TIDAK"){
		echo "Masih Ada Kesalahan, silahkan perbaiki! </br>";
		echo "<input type='button' value ='Kembali' onClick='self.history.back()'>";

		exit;
	}

	include "koneksi.php";

	if ($simpan == "EDIT") {
		if($size ==0){
			$foto = $foto_lama;
		}
		$sql = "update barang set nama = '$nama', harga = '$harga', stok = '$stok', foto = '$foto' where idbarang = $idbarang";

	}else{
	$sql = "insert into barang(nama,harga,stok,foto) values ('$nama','$harga','$stok','$foto')";
}
	$hasil = mysqli_query($kon, $sql);

	if(!$hasil){
		echo "Gagal Simpan, silahkan diulangi! <br />";
		echo mysqli_error($kon);
		echo "<br/> <input type='button' value ='Kembali' onClick='self.history.back()'>";

		exit;
	} else {
		echo "Simpan data berhasil";
	}

if ($size > 0) {
	if (!move_uploaded_file($tmpName, $fileTujuanFoto)) {
		echo "Gagal Upload Gambar...<br />";
		echo "<a href='barang_tampil.php>Daftar Barang</a>";
		exit;
	}else {
		buat_thumbnail($fileTujuanFoto, $fileTujuamThumb);
	}
}

echo "<br/> File sudah di upload. <br/>";
?>
<hr/>
<a href="barang_tampil.php" /> DAFTAR BARANG</a>
<?php include_once ('template_bawah.php'); ?>