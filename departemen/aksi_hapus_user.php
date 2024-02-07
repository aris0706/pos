<?php 
include '..\konfig.php';
$id=$_GET['id'];
mysql_query("delete from tb_user where username='$id' ");
echo "<script language=\"Javascript\">\n";
echo "window.alert('User berhasil dihapus!');";
echo "javascript:history.back()";
echo "</script>";

?>