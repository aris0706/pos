<?php 
include '..\konfig.php';
$nama_menu=$_POST['nama_menu'];
$kode_menu=$_POST['kode_menu'];
$satuan=$_POST['satuan'];
$harga=$_POST['harga'];
$keterangan=$_POST['keterangan'];

mysql_query("insert into tb_menu (kode_menu,nama_menu,keterangan,satuan,harga)"."values('$kode_menu','$nama_menu','$keterangan','$satuan','$harga')") or die(mysql_error());

	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Menu berhasil ditambahkan');";
	echo "javascript:history.back()";
	echo "</script>";

?>