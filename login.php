<?php

session_start();
extract($_POST);
include './konfig.php';

$password = MD5($password);
$query = "select * from tb_user where username = '$username' and password = '$password'";
$result = mysql_query($query);
if($username == ''){
    echo "<script>
	location.href='index.php?error=kosong';
	</script>";
} else if (mysql_num_rows($result)) {
    while ($row = mysql_fetch_array($result)) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        $_SESSION['kd_user'] = $row['kd_user'];
        
            header("location:cafelarva.php?view=tampil_home");
    }
} 
else{
    echo "<script>
	location.href='index.php?error=salah';
	</script>";
}
?>