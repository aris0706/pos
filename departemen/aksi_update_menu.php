<?php 
include '..\konfig.php';
$nama_menu=$_POST['nama_menu'];
$kode_menu=$_POST['kode_menu'];
$keterangan=$_POST['keterangan'];
$satuan=$_POST['satuan'];
$harga=$_POST['harga'];

mysql_query("update tb_menu set nama_menu='$nama_menu', keterangan='$keterangan', satuan='$satuan', harga='$harga'   where kode_menu='$kode_menu'");
echo "<script language=\"Javascript\">\n";
echo "window.alert('Menu berhasil di update');";
echo "window.location=\"../cafelarva.php?view=tampil_menu\";";
echo "</script>";

?>