<?php 
include '..\konfig.php';
$id=$_GET['id'];
mysql_query("delete from tb_pesanan_detail where id_detail_pesanan='$id' ");
echo "<script language=\"Javascript\">\n";
echo "window.alert('Menu berhasil dihapus!');";
echo "javascript:history.back()";
echo "</script>";

?>