<br/><br/><br/>
<h3><span class="glyphicon glyphicon-list-alt"></span>  Laporan Penjualan</h3>
<br/><br/>
<form id="form_laporan" role="form" action="laporan/cetak_pdf.php" target="_blank" method="POST">
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Tanggal Awal</label>
			<div class="col-lg-4">
				<input name="tgl_awal" type="text" class="form-control" id="tgl_awal" autocomplete="off">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label">Tanggal Akhir</label>
			<div class="col-lg-4">
				<input name="tgl_akhir" type="text" class="form-control" id="tgl_akhir" autocomplete="off">
			</div>
		</div>
		<div class="form-group row">
			<label class="col-lg-2 col-form-label form-control-label"></label>
			<div class="col-lg-4">
				<input type="button" class="btn btn-primary" onclick="validasi()" value="Cetak">
			</div>
		</div>
</form>

</table>

<script>

	function validasi(){
		var tgl_awal = document.getElementById("tgl_awal").value; 
		var tgl_akhir = document.getElementById("tgl_akhir").value; 
		
		if(tgl_awal == ""){
			alert("Tanggal awal belum dipilih");
			return false;
		} else if(tgl_akhir == ""){
			alert("Tanggal akhir belum dipilih");
			return false;
		} else {
			document.getElementById("form_laporan").submit(); 
		}

	}

	$(document).ready(function(){
		$("#tgl_awal").datepicker({dateFormat : 'yy-mm-dd'});							
	});
	
	$(document).ready(function(){
		$("#tgl_akhir").datepicker({dateFormat : 'yy-mm-dd'});							
	});
</script>