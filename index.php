<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_guest();
require_once __DIR__ . '/inc/header.php';
?>
<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/login.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl">
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="email" id="email" required></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" type="password" id="password" required></td>
			 </tr>
			  <tr>
			  <td></td>
			   <td><input type="submit" id="loginsubmit" value="Login" name="login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	   <?php echo $message; ?>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
