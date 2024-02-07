<?php 
include '..\konfig.php';
$id=$_GET['id'];
mysql_query("delete from tb_pembayaran where kode_pembayaran='$id' ");
echo "<script language=\"Javascript\">\n";
echo "window.alert('Pembayaran berhasil dihapus !');";
echo "javascript:history.back()";
echo "</script>";

?>