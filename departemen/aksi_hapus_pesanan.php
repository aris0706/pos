<?php 
include '..\konfig.php';
$id=$_GET['id'];

$qrycekpesanan 	= mysql_query("SELECT * FROM tb_pembayaran WHERE kode_pesanan = '$id' ")  or die ("Query data salah : ".mysql_error());
$cekpesanan=mysql_num_rows($qrycekpesanan);

if($cekpesanan > 0){

	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Pesanan sudah di bayar, hapus pembayaran terlebih dahulu !');";
	echo "javascript:history.back()";
	echo "</script>";

} else {

mysql_query("delete from tb_pesanan_detail where kode_pesanan='$id' ");
mysql_query("delete from tb_pesanan_header where kode_pesanan='$id' ");
echo "<script language=\"Javascript\">\n";
echo "window.alert('Pesanan berhasil dihapus!');";
echo "javascript:history.back()";
echo "</script>";

}

?>