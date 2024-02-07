<?php
include_once ("tcpdf/buatkode.php");
$kd_user = $_SESSION['username'];
$kode = buatKode("tb_pembayaran", "B");
$myQryH 	= mysql_query("SELECT * FROM tb_pembayaran WHERE kode_pembayaran=''")  or die ("Query data salah : ".mysql_error());
$DataH	= mysql_fetch_array($myQryH);
$kode_pesanan		=  $DataH['kode_pesanan'];
$tanggal_pembayaran		=  $DataH['tanggal_pembayaran'];
$keterangan		=  $DataH['keterangan'];
?>

<h3><span class="glyphicon glyphicon-list-alt"></span>  Pembayaran Baru</h3>
<br/>
<form action="departemen/aksi_tambah_pembayaran.php" id="form_pembayaran" method="post">
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Kode Pembayaran</label>
			<div class="col-lg-4">
				<input class="form-control" type="text" name="kode_pembayaran" maxlength="30" value="<?php echo $kode ?>" readonly>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Tanggal</label>
			<div class="col-lg-4">
				<input name="tanggal_pembayaran" type="text" class="form-control" id="tgl" autocomplete="off" value="<?php echo $tanggal_pembayaran ?>">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Kode Pesanan</label>
			<div class="col-lg-4">
				<select type="submit" name="kode_pesanan" id="kode_pesanan" class="form-control" onchange="goSubmit()">
					<option value="">Pilih ..</option>
					<?php
	  					$bacaSql = "SELECT * FROM tb_pesanan_header a  where a.kode_pesanan not in (select kode_pesanan from tb_pembayaran where kode_pembayaran <> '') ORDER BY a.kode_pesanan";
	  					$bacaQry = mysql_query($bacaSql) or die ("Gagal Query".mysql_error());
	  					while ($bacaData = mysql_fetch_array($bacaQry)) {
							if (trim($bacaData['kode_pesanan']) == trim($kode_pesanan)) {
								$cek = " selected";
							} else { $cek=""; }
							echo "<option value='$bacaData[kode_pesanan]' $cek>$bacaData[kode_pesanan]</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Keterangan</label>
			<div class="col-lg-4">
				<select id="keterangan" name="keterangan[]" multiple="multiple" style="width:300px;height:150px;">
					<option value="Cash">Cash</option>
					<option value="Kartu Debit">Kartu Debit</option>
					<option value="OVO">OVO</option>
					<option value="Dana">Dana</option>
					<option value="Go Pay">Go Pay</option>
					<option value="Shopee Pay">Shopee Pay</option>
				</select>
			</div>
		</div>

<table class="table">
	<tr>
		<th>No</th>
		<th>Nama Menu</th>
		<th>Jumlah</th>
		<th>Satuan</th>
		<th>Harga @</th>
		<th>Total Harga</th>
	</tr>
	<?php 
		$user=mysql_query("select *,p.harga as harga_satuan,(p.harga * p.qty) as total_harga 
							from  tb_pembayaran j 
								inner join tb_pesanan_detail p on p.kode_pesanan = j.kode_pesanan 
								inner join tb_menu b on p.kode_menu = b.kode_menu 
							where j.kode_pembayaran = '' ");
		$no=1;
		$total_pembayaran=0;
		while($b=mysql_fetch_array($user)){
	?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['nama_menu'] ?></td>
			<td><?php echo $b['qty'] ?></td>
			<td><?php echo $b['satuan'] ?></td>
			<td>Rp.<?php echo number_format($b['harga_satuan']) ?>,-</td>		
			<td>Rp.<?php echo number_format($b['total_harga']) ?>,-</td>
		</tr>

	<?php $total_pembayaran = $total_pembayaran + $b['total_harga'];
	 } ?>
	<tr>
		<td colspan="5">Total Pembayaran</td>
		<td><b>Rp.<?php echo number_format($total_pembayaran) ?>,-</b>
			<input name="total" id="total" type="hidden" value="<?php echo $total_pembayaran ?>">
		</td>
	</tr>
</table>

		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Jumlah Uang</label>
			<div class="col-lg-4">
				<input name="jumlah_uang" id="jumlah_uang" type="text" class="form-control" onKeyUp="numericFilter(this);" placeholder="Jumlah Uang ..">
			</div>
		</div>

<div class="row">
	&nbsp;&nbsp;&nbsp;<a onclick="if(cekuang() == true){if(confirm('Apakah anda yakin ingin menyimpan data ini ??')){ location.href='departemen/submit_pembayaran.php?jumlah_uang='+document.getElementById('jumlah_uang').value+'&kode_pesanan='+document.getElementById('kode_pesanan').value+'&desc='+document.getElementById('keterangan').value } }" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</a>
</div>

	<script>
		function numericFilter(txb) {
			txb.value = txb.value.replace(/[^\0-9]/ig, "");
		}

		function cekuang(){
			
			var tanggal_pembayaran = document.getElementById("tgl").value; 
			var kode_pesanan = document.getElementById("kode_pesanan").value; 
			var jumlah_bayar = document.getElementById("jumlah_uang").value; 
			var total = document.getElementById("total").value;
			
			if(tanggal_pembayaran == "" || tanggal_pembayaran == "0000-00-00"){
				alert("Tanggal pembayaran belum dipilih");
				return false;
			} else if(kode_pesanan == ""){
				alert("Kode pesanan belum diisi");
				return false;
			} else if(parseFloat(jumlah_bayar) < parseFloat(total)){
				alert("Jumlah uang tidak mencukupi !");
				return false;
			} else {
				return true;
			}
		}

		function goSubmit(){
			var tanggal_pembayaran = document.getElementById("tgl").value; 
			var kode_pesanan = document.getElementById("kode_pesanan").value; 
			
			if(tanggal_pembayaran == "" || tanggal_pembayaran == "0000-00-00"){
				alert("Tanggal pembayaran belum dipilih");
				return false;
			} else if(kode_pesanan == ""){
				alert("Kode pesanan belum diisi");
				return false;
			} else {
				document.getElementById("form_pembayaran").submit(); 
			}
	
		}

		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
	
	</form>