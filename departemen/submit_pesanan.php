<?php 
include '../konfig.php';
session_start();

include_once("../tcpdf/buatkode.php");
$kode = buatKode("tb_pesanan_header", "P");
$username = $_SESSION['username'];

$qrycekmenu 	= mysql_query("SELECT * FROM tb_pesanan_detail WHERE kode_pesanan = ''")  or die ("Query data salah : ".mysql_error());
$cekmenu=mysql_num_rows($qrycekmenu);

if($cekmenu < 1){

	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Detail Menu belum di entry');";
	echo "javascript:history.back()";
	echo "</script>";

} else {

	mysql_query("update tb_pesanan_header set kode_pesanan='$kode' where kode_pesanan ='' ")  or die ("Query data salah : ".mysql_error());
	mysql_query("update tb_pesanan_detail set kode_pesanan='$kode' where kode_pesanan ='' ")  or die ("Query data salah : ".mysql_error());
	

		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Pesanan berhasil disimpan !');";
		echo "javascript:history.go(-2)"; //mundur 2 halaman
		echo "</script>";
}
?>