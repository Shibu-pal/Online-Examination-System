<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_guest();
require_once __DIR__ . '/inc/header.php';
?>
<div class="main">
<h1>Online Exam System - User Registration</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/register.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table>
		<tr>
           <td>Name</td>
           <td><input type="text" name="name" id="name" required></td>
         </tr>
		<tr>
           <td>Username</td>
           <td><input name="username" type="text" id="username" required></td>
         </tr>
         <tr>
           <td>Password</td>
           <td><input type="password" name="password" id="password" required></td>
         </tr>
         <tr>
           <td>E-mail</td>
           <td><input name="email" type="email" id="email" required></td>
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" id="regsubmit" value="Signup" name="signup">
           </td>
         </tr>
       </table>
	   </form>
     <?php echo $message; ?>
	   <p>Already Registered ? <a href="index.php">Login</a> Here</p>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
