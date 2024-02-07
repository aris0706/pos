<?php 
include_once ("tcpdf/buatkode.php");
$kd_pelanggan = $_SESSION['username'];
?>
<div align="center">
    <h1><img src="images/payment.png" width="50"> Data Pembayaran</h1>
</div>
<div align="right">
<?php if($_SESSION['level'] == 'Admin' OR $_SESSION['level'] == 'Kasir'){ ?>
    <button class="btn btn-primary btn-large" onClick='top.location="?view=pembayaran_baru"'>
        <i class="glyphicon glyphicon-plus-sign"></i> Tambah Pembayaran
    </button>
<?php } ?>
</div>
<br>
<table id="datatable" class="stripe">
    <thead>
    <th>Kode Pembayaran</th>
    <th>Tanggal Pembayaran</th>
    <th>Keterangan</th>
    <th>Kode Pesanan</th>
    <th>Total Harga</th>
    <th>Jumlah Uang</th>
    <th>Uang Kembali</th>
    <th>Aksi</th>
</thead>
<tbody>

    <?php 
    
        $user=mysql_query("select j.kode_pembayaran,
                                j.tanggal_pembayaran,
                                j.keterangan,
                                j.jumlah_uang,
                                j.kode_pesanan,
                            (select sum(qty*harga) from tb_pesanan_detail where kode_pesanan = j.kode_pesanan) as total_harga 
                            from tb_pembayaran j 
                            inner join tb_pesanan_header p on p.kode_pesanan = j.kode_pesanan 
                            where j.kode_pembayaran <> ''
                            order by j.kode_pembayaran desc");
    
	$no=1;
	while($b=mysql_fetch_array($user)){
		?>
    <tr>
        <td><?php echo $b['kode_pembayaran'] ?></td>
        <td><?php echo $b['tanggal_pembayaran'] ?></td>
        <td><?php echo $b['keterangan'] ?></td>
        <td><?php echo $b['kode_pesanan'] ?></td>
        <td align="right">Rp.<?php echo number_format($b['total_harga']) ?>,-</td>
        <td align="right">Rp.<?php echo number_format($b['jumlah_uang']) ?>,-</td>
        <td align="right">Rp.<?php echo number_format($b['jumlah_uang']-$b['total_harga']) ?>,-</td>
        <td nowrap>
            <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='departemen/aksi_hapus_pembayaran.php?id=<?php echo $b['kode_pembayaran']; ?>' }" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a> &nbsp;&nbsp;
			<a href="departemen/pembayaran_cetak.php?noNota=<?php echo $b['kode_pembayaran']; ?>" target="_blank">Cetak Struk</a>
        </td>
    </tr>
    <?php  } ?>
</table>

