<?php 
include('inc/loginheader.php');
?>

<div class="main">
<h1>Admin Login</h1>
<div class="adminlogin">
	<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
		<table>
			<tr>
				<td>Username</td>
				<td><input type="text" name="user_name"/></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password"/></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="login" value="Login"/></td>
			</tr>

			<tr>
				<td colspan="2">
				<?php echo $massage; ?>
				</td>
			</tr>
		</table>
	</from>
</div>
</div>
<?php include 'inc/footer.php'; ?>