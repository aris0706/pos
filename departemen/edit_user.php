
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit User</h3>
<?php
$id=mysql_real_escape_string($_GET['id']);
$det=mysql_query("select * from tb_user where username='$id'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="departemen/aksi_update_user.php" method="post">
		<table class="table">
			<tr>
				<td>Username</td>
				<td><input type="text" class="form-control" name="username" id="username" value="<?php echo $d['username'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Level</td>
				<td><select class="form-control" name="level" id="level">
			            <option value="<?php echo $d['level'] ?>"><?php echo $d['level'] ?></option>
			            <option value="">- Pilih -</option>
						<option value="Admin">Admin</option>
						<option value="Pelayan">Pelayan</option>
						<option value="Koki">Koki</option>
						<option value="Kasir">Kasir</option>
						<option value="Owner">Owner</option>
					</select>
				</td>
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