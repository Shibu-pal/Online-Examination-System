<?php
include 'inc/loginheader.php';
?>
<div class="main">
<h1>Admin Login</h1>
<div class="adminlogin">
	<form action="" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="user_name" required/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password" required/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login"/></td>
			</tr>
			<tr>
				<td colspan="2">
				<?php echo $message; ?>
				</td>
			</tr>
		</table>
	</form>
</div>
</div>
<?php include 'inc/footer.php'; ?>
