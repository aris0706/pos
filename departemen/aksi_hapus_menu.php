<?php 
include '..\konfig.php';
$id=$_GET['id'];

$qrycekmenu 	= mysql_query("SELECT * FROM tb_pesanan_detail WHERE kode_menu = '$id'")  or die ("Query data salah : ".mysql_error());
$cekmenu=mysql_num_rows($qrycekmenu);

if($cekmenu < 1){

    mysql_query("delete from tb_menu where kode_menu='$id' ");
    echo "<script language=\"Javascript\">\n";
    echo "window.alert('Menu berhasil dihapus!');";
    echo "javascript:history.back()";
    echo "</script>";

} else {
    echo "<script language=\"Javascript\">\n";
    echo "window.alert('Tidak dapat menghapus menu, menu sudah ada transaksi !');";
    echo "javascript:history.back()";
    echo "</script>";
}

?>