<?php 
include_once ("tcpdf/buatkode.php");
?>
<div align="center">
    <h1><img src="images/note.png" width="50"> Data Pesanan</h1>
</div>
<div align="right">
    <button class="btn btn-primary btn-large" onClick='top.location="?view=pesanan_baru"'>
        <i class="glyphicon glyphicon-plus-sign"></i> Tambah Pesanan
    </button>
</div>
<br>
<table id="datatable" class="stripe">
    <thead>
    <th>Kode Pesanan</th>
    <th>Tanggal Pesanan</th>
    <th>Nama Menu</th>
    <th>Satuan</th>
    <th>Qty</th>
    <th>Harga</th>
    <th>Total</th>
    <th>Keterangan</th>
    <th>Status Pembayaran</th>
    <th>Aksi</th>
</thead>
<tbody>

    <?php 
    $user=mysql_query("select h.kode_pesanan, 
                            d.harga as harga_satuan,
                            (d.qty*d.harga) as total_harga,
                            b.nama_menu,
                            b.satuan,
                            d.qty,
                            h.keterangan,
                            h.tanggal_pesanan,
                            (select count(kode_pesanan) from tb_pembayaran where kode_pesanan = h.kode_pesanan) as ispaid
                        from tb_pesanan_header h 
                            inner join tb_pesanan_detail d on d.kode_pesanan = h.kode_pesanan
                            inner join tb_menu b on d.kode_menu = b.kode_menu
                        where h.kode_pesanan <> '' order by h.kode_pesanan desc");
    
	$no=1;
    $prevcode = "";
	while($b=mysql_fetch_array($user)){
        $ispaid = $b['ispaid'];
		?>
    <tr>
        <td><?php echo $b['kode_pesanan'] ?></td>
        <td><?php echo $b['tanggal_pesanan'] ?></td>
        <td><?php echo $b['nama_menu'] ?></td>
        <td><?php echo $b['satuan'] ?></td>
        <td><?php echo $b['qty'] ?></td>
        <td align="right">Rp.<?php echo number_format($b['harga_satuan']) ?>,-</td>
        <td align="right">Rp.<?php echo number_format($b['total_harga']) ?>,-</td>
        <td><?php echo $b['keterangan'] ?></td>
        <td><?php if($ispaid > 0){ echo "Sudah dibayar";}else{ echo "Belum dibayar";};  ?></td>
        <td nowrap>
            <?php if($prevcode != $b['kode_pesanan']){ ?>
                <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='departemen/aksi_hapus_pesanan.php?id=<?php echo $b['kode_pesanan']; ?>' }" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
            <?php } ?>
        </td>
    </tr>
    <?php $prevcode = $b['kode_pesanan'];  } ?>
</table>


