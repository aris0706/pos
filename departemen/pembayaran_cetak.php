<?php
include '..\konfig.php';

if($_GET) {
	# Baca variabel URL
	$noNota = $_GET['noNota'];
	
	# Perintah untuk mendapatkan data dari tabel pembelian
	$mySql = "SELECT (c.qty*c.harga) as total_harga,
              a.kode_pembayaran,
              a.tanggal_pembayaran,
              a.keterangan,
              d.nama_menu,
              d.satuan,
              c.qty,
              c.harga
            from tb_pembayaran a
            inner join tb_pesanan_header b on b.kode_pesanan = a.kode_pesanan
            inner join tb_pesanan_detail c on c.kode_pesanan = b.kode_pesanan
            inner join tb_menu d on d.kode_menu = c.kode_menu
            where a.kode_pembayaran ='$noNota' ";
	$myQry = mysql_query($mySql)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
}
else {
	echo "Nomor Transaksi Tidak Terbaca";
	exit;
}
?>
<html>
<head>
<title>Cetak Pembayaran</title>
<link href="styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> Struk Pembayaran </h2>
<table width="450" border="0" cellspacing="1" cellpadding="4" class="table-print">
  <tr>
    <td width="154"><b>Kode Pembelian </b></td>
    <td width="10"><b>:</b></td>
    <td width="258"><strong><?php echo $myData['kode_pembayaran']; ?></strong></td>
  </tr>
  <tr>
    <td><b>Tgl. Pembelian </b></td>
    <td><b>:</b></td>
    <td><?php echo $myData['tanggal_pembayaran']; ?></td>
  </tr>
  <tr>
    <td><b>Keterangan</b></td>
    <td><b>:</b></td>
    <td><?php echo $myData['keterangan']; ?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<p><strong>Daftar Menu </strong></p>
<table class="table-list" width="500" border="0" cellspacing="1" cellpadding="2">
  
  <tr>
    <td width="34" align="center" bgcolor="#F5F5F5"><b>No</b></td>
    <td width="200" bgcolor="#F5F5F5"><b>Nama Menu</b></td>
    <td width="60" align="center" bgcolor="#F5F5F5"><b> Satuan </b></td>
    <td width="60" align="center" bgcolor="#F5F5F5"><b> Qty </b></td>
    <td width="60" align="right" bgcolor="#F5F5F5"><b> Harga Satuan </b></td>
    <td width="60" align="right" bgcolor="#F5F5F5"><b> Total Harga </b></td>
  </tr>
  <?php
  	// Variabel data
  $nomor  = 0;  
  $grand_total  = 0; 
  $mySqlD = "SELECT (c.qty*c.harga) as total_harga,
                a.kode_pembayaran,
                a.tanggal_pembayaran,
                d.nama_menu,
                d.satuan,
                c.qty,
                c.harga,
                a.jumlah_uang
              from tb_pembayaran a
              inner join tb_pesanan_header b on b.kode_pesanan = a.kode_pesanan
              inner join tb_pesanan_detail c on c.kode_pesanan = b.kode_pesanan
              inner join tb_menu d on d.kode_menu = c.kode_menu
              where a.kode_pembayaran ='$noNota' ";
  $myQryD = mysql_query($mySqlD)  or die ("Query salah : ".mysql_error()); 
	while($myDataDetail = mysql_fetch_array($myQryD)) {
    $nomor++;
    $grand_total = $grand_total + $myDataDetail['total_harga'];
    $jumlah_uang = $myDataDetail['jumlah_uang'];
	?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><?php echo $myDataDetail['nama_menu']; ?></td>
    <td align="center"><?php echo $myDataDetail['satuan']; ?></td>
    <td align="center"><?php echo $myDataDetail['qty']; ?></td>
    <td align="right">Rp.<?php echo number_format($myDataDetail['harga']) ?>,-</td>
    <td align="right">Rp.<?php echo number_format($myDataDetail['total_harga']) ?>,-</td>
  </tr>
  <?php } ?>
  <tr>
    <td align="right" colspan="5"><b>Grand Total :</b></td>
    <td align="right">Rp.<?php echo number_format($grand_total)?>,-</td>
  </tr>
  <tr>
    <td align="right" colspan="5"><b>Jumlah Uang :</b></td>
    <td align="right">Rp.<?php echo number_format($jumlah_uang)?>,-</td>
  </tr>
  <tr>
    <td align="right" colspan="5"><b>Uang Kembali :</b></td>
    <td align="right">Rp.<?php echo number_format($jumlah_uang-$grand_total)?>,-</td>
  </tr>
</table>
<br/>
<img src="btn_print.png" height="20" onClick="javascript:window.print()" />
</body>
</html>