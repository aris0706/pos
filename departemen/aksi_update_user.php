<?php 
include '..\konfig.php';
$username=$_POST['username'];
$level=$_POST['level'];

mysql_query("update tb_user set level='$level' where username='$username'");
echo "<script language=\"Javascript\">\n";
echo "window.alert('User berhasil di update');";
echo "window.location=\"../cafelarva.php?view=tampil_user\";";
echo "</script>";

?>