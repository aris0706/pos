<?php 
include '../konfig.php';
$username=$_POST['username'];
$password=MD5($_POST['password']);
$level=$_POST['level'];

$cekusername="SELECT username FROM tb_user WHERE username='$username'";
$ada=mysql_query($cekusername) or die(mysql_error());
if(mysql_num_rows($ada)>0)
   { echo "<script language=\"Javascript\">\n";
     echo "window.alert('Username sudah ada digunakan, silahkan gunakan username yang berbeda !');";
     echo "javascript:history.back()";
     echo "</script>"; 
   }

else {
mysql_query("insert into tb_user (username,password,level)"."values('$username','$password','$level')") or die(mysql_error());

	echo "<script language=\"Javascript\">\n";
	echo "window.alert('User berhasil ditambahkan!');";
	echo "javascript:history.back()";
	echo "</script>";
}
?>