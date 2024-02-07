<?php 
include '..\konfig.php';
session_start();
$username = $_SESSION['username'];
$kode_pesanan=trim($_POST['kode_pesanan']);
$tanggal_pembayaran=trim($_POST['tanggal_pembayaran']);

		mysql_query("delete from tb_pembayaran where username = '$username' and kode_pembayaran=''");
		mysql_query("insert into tb_pembayaran (kode_pembayaran,kode_pesanan,username,tanggal_pembayaran)"."values('','$kode_pesanan','$username','$tanggal_pembayaran')") or die(mysql_error());

		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Barang sudah ditambah');";
		echo "javascript:history.back()";
		echo "</script>";

?>