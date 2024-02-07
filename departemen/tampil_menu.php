<?php 
include_once ("tcpdf/buatkode.php");
?>
<div align="center">
    <h1><img src="images/minuman.png" width="50"> Data Menu</h1>
</div>
<div align="right">
    <button class="btn btn-primary btn-large" data-toggle="modal" data-target="#tambahModal">
        <i class="glyphicon glyphicon-plus-sign"></i> Tambah Menu
    </button>
</div>
<br>
<table id="datatable" class="stripe">
    <thead>
    <th>Kode Menu</th>
    <th>Nama Menu</th>
    <th>Satuan</th>
    <th>Harga</th>
    <th>Keterangan</th>
    <th>Aksi</th>
</thead>
<tbody>

    <?php 
    $user=mysql_query("select * from tb_menu order by nama_menu");
	$no=1;
	while($b=mysql_fetch_array($user)){
		?>
    <tr>
        <td><?php echo $b['kode_menu'] ?></td>
        <td><?php echo $b['nama_menu'] ?></td>
        <td><?php echo $b['satuan'] ?></td>
        <td align="right">Rp.<?php echo number_format($b['harga']) ?>,-</td>
        <td><?php echo $b['keterangan'] ?></td>
        <td nowrap>
            <a href="?view=edit_menu&id=<?php echo $b['kode_menu']; ?>" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
            <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='departemen/aksi_hapus_menu.php?id=<?php echo $b['kode_menu']; ?>' }" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
        </td>
    </tr>
    <?php  } ?>
</table>

<!---------------------------- tambah ------------------------->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h4 class="modal-title" id="myModalLabel"> <i class="glyphicon glyphicon-edit"></i> Tambah Data Menu</h4>
            </div> 
            <div class="modal-body">
                <form name="form_tambah_menu" id="form_tambah_menu" method="POST" action="departemen/aksi_tambah_menu.php">

                    <div class="form-group">
						<label>Kode Menu</label>
						<?php
							$kode = buatKode("tb_menu", "LV");
						?>
						<input name="kode_menu" id="kode_menu" type="text" class="form-control" value="<?php echo $kode; ?>" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Nama Menu</label>
						<input name="nama_menu" id="nama_menu" type="text" class="form-control" placeholder="Nama Menu ..">
					</div>
					<div class="form-group">
						<label>Satuan</label>
						<select class="form-control" name="satuan" id="satuan">
							<option value="">- Pilih -</option>
							<option value="Cup Small">Cup Small</option>
							<option value="Cup Large">Cup Large</option>
						</select>
					</div>	
					<div class="form-group">
						<label>Harga</label>
						<input name="harga" id="harga" type="text" class="form-control" onKeyUp="numericFilter(this);" placeholder="Harga ..">
					</div>

					<div class="form-group">
          			<label for="keterangan">Keterangan</label>
          			<textarea style="width:500px; height:150px" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan .. Fungsi Dari Menu"></textarea>
        			</div>

                    <br>
                    <div align="center">
                        <button type="button" class="btn btn-primary btn-lg" onClick="validasi()"><i class="glyphicon glyphicon-floppy-disk"></i>  Simpan </button>
                    </div>
                </form>

            </div>

        </div> 
    </div><!-- /.modal-content --> 
</div><!-- /.modal -->

<script>
	function numericFilter(txb) {
		txb.value = txb.value.replace(/[^\0-9]/ig, "");
	}

	function validasi(){
		var nama_menu = document.getElementById("nama_menu").value; 
		var satuan = document.getElementById("satuan").value; 
		var harga = document.getElementById("harga").value; 
		
		if(nama_menu.trim() == ""){
			alert("Nama Menu harus diisi");
			return false;
		} else if(satuan == ""){
			alert("Satuan belum dipilih");
			return false;
		} else if(harga == ""){
			alert("Harga belum diisi");
			return false;
		} else {
			document.getElementById("form_tambah_menu").submit(); 
		}
  
	}

</script>


