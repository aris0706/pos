<?php 
session_start();
include '..\konfig.php';
$tanggal_pesanan=trim($_POST['tanggal_pesanan']);
$arrketerangan=$_POST['keterangan'];
//$keterangan = implode(", ",$arrketerangan);
$username = $_SESSION['username'];


$kode_menu=$_POST['kode_menu'];
$qty=$_POST['qty'];

$qrycekmenu 	= mysql_query("SELECT * FROM tb_pesanan_detail WHERE kode_menu='$kode_menu' and kode_pesanan = ''")  or die ("Query data salah : ".mysql_error());
$cekmenu=mysql_num_rows($qrycekmenu);

if($cekmenu > 0){

	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Menu tidak boleh duplicate');";
	echo "javascript:history.back()";
	echo "</script>";

} else if($tanggal_pesanan == '' OR $tanggal_pesanan == '0000-00-00'){
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Mohon pilih tanggal pesanan terlebih dahulu');";
	echo "javascript:history.back()";
	echo "</script>";
} 

else {

		
		$myQryBrg 	= mysql_query("SELECT * FROM tb_menu WHERE kode_menu='$kode_menu'")  or die ("Query data salah : ".mysql_error());
		$myDataBrg	= mysql_fetch_array($myQryBrg);
		$harga_satuan		=  $myDataBrg['harga'];

		
		mysql_query("delete from tb_pesanan_header where kode_pesanan =''") or die(mysql_error());
		mysql_query("insert into tb_pesanan_header (kode_pesanan,tanggal_pesanan,keterangan,username)"."values('','$tanggal_pesanan','$arrketerangan','$username')") or die(mysql_error());
		mysql_query("insert into tb_pesanan_detail (kode_pesanan,kode_menu,qty,harga)"."values('','$kode_menu','$qty','$harga_satuan')") or die(mysql_error());

		echo "<script language=\"Javascript\">\n";
		echo "window.alert('Menu berhasil ditambahkan');";
		echo "javascript:history.back()";
		echo "</script>";
	
}
?>