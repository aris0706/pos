<?php 
include '../konfig.php';
session_start();

include_once ("../tcpdf/buatkode.php");
$kode = buatKode("tb_pembayaran", "B");
$kd_user = $_SESSION['username'];
$jumlah_uang = $_GET['jumlah_uang'];
$kode_pesanan = $_GET['kode_pesanan'];
$keterangan = $_GET['desc'];


	mysql_query("update tb_pembayaran set kode_pembayaran='$kode', jumlah_uang = '$jumlah_uang', keterangan = '$keterangan' where kode_pembayaran ='' and kode_pesanan = '$kode_pesanan' ");
	

	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Pembayaran berhasil disimpan !');";
	echo "javascript:history.go(-2)";// mundur 2 halaman
	echo "</script>";

?>