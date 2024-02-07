<?php 
include_once ("tcpdf/buatkode.php");
?>
<div align="center">
    <h1><img src="images/user.png" width="40"> Data User</h1>
</div>
<div align="right">
    <button class="btn btn-primary btn-large" data-toggle="modal" data-target="#tambahModal">
        <i class="glyphicon glyphicon-plus-sign"></i> Tambah User
    </button>
</div>
<br>
<table id="datatable" class="stripe">
<thead>
    <th>Username</th>
    <th>Level</th>
    <th>Aksi</th>
</thead>
<tbody>

    <?php 
    $user=mysql_query("select * from tb_user");
	$no=1;
	while($b=mysql_fetch_array($user)){
		?>
    <tr>
        <td><?php echo $b['username'] ?></td>
        <td><?php echo $b['level'] ?></td>
        <td nowrap>
            <a href="?view=edit_user&id=<?php echo $b['username']; ?>" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i> Ubah</a>
            <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='departemen/aksi_hapus_user.php?id=<?php echo $b['username']; ?>' }" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Hapus</a>
        </td>
    </tr>
    <?php  } ?>
</tbody>
</table>

<!---------------------------- tambah ------------------------->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                <h4 class="modal-title" id="myModalLabel"> <i class="glyphicon glyphicon-edit"></i> Tambah Data User</h4>
            </div> 
            <div class="modal-body">
                <form name="form_tambah_user" id="form_tambah_user" method="POST" action="departemen/aksi_tambah_user.php">

					<div class="form-group">
						<label>Username</label>
						<input name="username" id="username" type="text" class="form-control" placeholder="Username ..">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input name="password" id="password" type="password" class="form-control" placeholder="Password ..">
					</div>
					<div class="form-group">
						<label>Level</label>
						<select class="form-control" name="level" id="level">
							<option value="">- Pilih -</option>
							<option value="Admin">Admin</option>
							<option value="Pelayan">Pelayan</option>
							<option value="Koki">Koki</option>
							<option value="Kasir">Kasir</option>
							<option value="Owner">Owner</option>
						</select>
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

	function validasi(){
		var username = document.getElementById("username").value; 
		var level = document.getElementById("level").value; 
		
		if(username.trim() == ""){
			alert("Username harus diisi");
			return false;
		} else if(level == ""){
			alert("Level belum dipilih");
			return false;
		} else {
			document.getElementById("form_tambah_user").submit(); 
		}
  
	}

</script>


