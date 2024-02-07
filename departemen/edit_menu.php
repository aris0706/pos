
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Menu</h3>
<?php
$id=mysql_real_escape_string($_GET['id']);
$det=mysql_query("select * from tb_menu where kode_menu='$id'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="departemen/aksi_update_menu.php" method="post">
		<table class="table">
			<tr>
				<td>Kode Menu</td>
				<td><input type="text" class="form-control" name="kode_menu" id="kode_menu" value="<?php echo $d['kode_menu'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama Menu</td>
				<td><input type="text" class="form-control" name="nama_menu" id="nama_menu" value="<?php echo $d['nama_menu'] ?>"></td>
			</tr>
			<tr>
				<td>Satuan</td>
				<td><select class="form-control" name="satuan" id="satuan">
							<option value="<?php echo $d['satuan'] ?>"><?php echo $d['satuan'] ?></option>
							<option value="">- Pilih -</option>
							<option value="Cup Small">Cup Small</option>
							<option value="Cup Large">Cup Large</option>
						</select>
				</td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input name="harga" id="harga" type="text" class="form-control" onKeyUp="numericFilter(this);" value="<?php echo $d['harga'] ?>"></td>
			</tr>

			<tr>
				<td>Keterangan</td>
				<td><textarea style="width:600px; height:150px" class="form-control" name="keterangan" id="keterangan"><?php echo $d['keterangan'] ?></textarea></td>
			</tr>

			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 
}
?>


<script>

	function numericFilter(txb) {	
		txb.value = txb.value.replace(/[^\0-9]/ig, "");
	}

</script>

