<?php
include_once ("tcpdf/buatkode.php");
$kode = buatKode("tb_pesanan_header", "P");
$myQryH 	= mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan=''")  or die ("Query data salah : ".mysql_error());
$DataH	= mysql_fetch_array($myQryH);
$tanggal_pesanan		=  $DataH['tanggal_pesanan'];
$keterangan		=  $DataH['keterangan'];
?>
<h3><span class="glyphicon glyphicon-list-alt"></span>  Pesanan Baru</h3>
<br/>
<form action="departemen/aksi_tambah_pesanan.php" id="form_pesanan" method="post">
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Kode Pesanan</label>
			<div class="col-lg-4">
				<input class="form-control" type="text" name="kode_pesanan" maxlength="30" value="<?php echo $kode ?>" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Tanggal</label>
			<div class="col-lg-4">
				<input name="tanggal_pesanan" type="text" class="form-control" id="tgl" autocomplete="off" value="<?php echo $tanggal_pesanan ?>">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Keterangan</label>
			<div class="col-lg-4">
				<select id="keterangan" name="keterangan" multiple="multiple" style="width:300px;height:170px;">
					<?php $q = mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan = '' AND keterangan like '%Rainbow Jelly%' ")  or die ("Query data salah : ".mysql_error()); $h = mysql_num_rows($q); if($h > 0){ ?> <option value="Rainbow Jelly" selected >Rainbow Jelly</option> <?php } else { ?> <option value="Rainbow Jelly" >Rainbow Jelly</option> <?php } ?>
					<?php $q = mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan = '' AND keterangan like '%Oreo Crumbs%' ")  or die ("Query data salah : ".mysql_error()); $h = mysql_num_rows($q); if($h > 0){ ?> <option value="Oreo Crumbs" selected >Oreo Crumbs</option> <?php } else { ?> <option value="Oreo Crumbs" >Oreo Crumbs</option> <?php } ?>
					<?php $q = mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan = '' AND keterangan like '%Keju Cheddar Parut%' ")  or die ("Query data salah : ".mysql_error()); $h = mysql_num_rows($q); if($h > 0){ ?> <option value="Keju Cheddar Parut" selected >Keju Cheddar Parut</option> <?php } else { ?> <option value="Keju Cheddar Parut" >RKeju Cheddar Parut</option> <?php } ?>
					<?php $q = mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan = '' AND keterangan like '%Fresh Milk%' ")  or die ("Query data salah : ".mysql_error()); $h = mysql_num_rows($q); if($h > 0){ ?> <option value="Fresh Milk" selected >Fresh Milk</option> <?php } else { ?> <option value="Fresh Milk" >Fresh Milk</option> <?php } ?>
					<?php $q = mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan = '' AND keterangan like '%Nata de Coco%' ")  or die ("Query data salah : ".mysql_error()); $h = mysql_num_rows($q); if($h > 0){ ?> <option value="Nata de Coco" selected >Nata de Coco</option> <?php } else { ?> <option value="Nata de Coco" >Nata de Coco</option> <?php } ?>
					<?php $q = mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan = '' AND keterangan like '%Jelly Coffee%' ")  or die ("Query data salah : ".mysql_error()); $h = mysql_num_rows($q); if($h > 0){ ?> <option value="Jelly Coffee" selected >Jelly Coffee</option> <?php } else { ?> <option value="Jelly Coffee" >Jelly Coffee</option> <?php } ?>
					<?php $q = mysql_query("SELECT * FROM tb_pesanan_header WHERE kode_pesanan = '' AND keterangan like '%Yakult%' ")  or die ("Query data salah : ".mysql_error()); $h = mysql_num_rows($q); if($h > 0){ ?> <option value="Yakult" selected >Yakult</option> <?php } else { ?> <option value="Yakult" >Yakult</option> <?php } ?>
					
				</select>
			</div>
		</div>
		
<div align="left">
	<a style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><i class="glyphicon glyphicon-plus-sign"></i> Entry Menu</a>
</div>	

<table class="table">
	<tr>
		<th>No</th>
		<th>Kode Menu</th>
		<th>Nama Menu</th>
		<th>Satuan</th>
		<th>Jumlah</th>
		<th>Harga @</th>
		<th>Total Harga</th>	
		<th>Opsi</th>
	</tr>
	<?php 
		$user=mysql_query("select h.kode_pesanan, 
									d.id_detail_pesanan,
									d.harga as harga_satuan,
									(d.qty*d.harga) as total_harga,
									d.kode_menu,
									b.nama_menu,
									b.satuan,
									d.qty,
									h.keterangan,
									h.tanggal_pesanan 
							from tb_pesanan_header h 
								inner join tb_pesanan_detail d on d.kode_pesanan = h.kode_pesanan
								inner join tb_menu b on d.kode_menu = b.kode_menu
							where h.kode_pesanan = '' order by h.kode_pesanan desc");
		$no=1;
		$total_pesanan=0;
		while($b=mysql_fetch_array($user)){
	?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['kode_menu'] ?></td>
			<td><?php echo $b['nama_menu'] ?></td>
			<td><?php echo $b['satuan'] ?></td>
			<td><?php echo $b['qty'] ?></td>
			<td>Rp.<?php echo number_format($b['harga_satuan']) ?>,-</td>		
			<td>Rp.<?php echo number_format($b['total_harga']) ?>,-</td>	
			<td>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='departemen/aksi_hapus_detail_pesanan.php?id=<?php echo $b['id_detail_pesanan']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>

	<?php $total_pesanan = $total_pesanan + $b['total_harga'];
	 } ?>
	<tr>
		<td colspan="6">Total Pesanan</td>
		<td><b>Rp.<?php echo number_format($total_pesanan) ?>,-</b></td>
	</tr>
</table>

<div class="row">
	&nbsp;&nbsp;&nbsp;<a onclick="if(confirm('Apakah anda yakin ingin menyimpan data ini ??')){ location.href='departemen/submit_pesanan.php' }" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</a>
</div>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Entry Menu
				</div>
				<div class="modal-body">					
						<div class="form-group">
							<label>Nama Menu</label>								
							<select class="form-control" name="kode_menu" id="kode_menu">
								<option value="">- Pilih -</option>
								<?php 
								$brg=mysql_query("select * from tb_menu order by nama_menu");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['kode_menu']; ?>"><?php echo $b['nama_menu'] ?> | Rp.<?php echo number_format($b['harga']) ?>,-</option>
									<?php 
								}
								?>
							</select>

						</div>			
						<div class="form-group">
							<label>Qty</label>
							<input name="qty" id="qty"  type="text" class="form-control" onKeyUp="numericFilter(this);" placeholder="Qty ..">
						</div>															

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>										
						<input type="button" class="btn btn-primary" onclick="validasi()" value="Tambah">
					</div>
			</div>
		</div>
	</div>
</div>
	<script>
		function numericFilter(txb) {
			txb.value = txb.value.replace(/[^\0-9]/ig, "");
		}

		function validasi(){
			var kode_menu = document.getElementById("kode_menu").value; 
			var qty = document.getElementById("qty").value; 
			
			if(kode_menu == ""){
				alert("Menu belum dipilih");
				return false;
			} else if(qty == ""){
				alert("Qty belum diisi");
				return false;
			} else {
				document.getElementById("form_pesanan").submit(); 
			}
	
		}

		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
	
	</form>