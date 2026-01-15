<?php include 'inc/header.php'; ?>
<?php
if(isset($_SESSION['login'])){
  header("location:starttest.php");
}
?>
<div class="main">
<h1>Online Exam System - User Registration</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/register.png"/>
	</div>
	<div class="segment">
	<form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
		<table>
		<tr>
           <td>Name</td>
           <td><input type="text" name="name" id="name" ></td>
         </tr>
		<tr>
           <td>Username</td>
           <td><input name="username" type="text" id="username" ></td>
         </tr>
         <tr>
           <td>Password</td>
           <td><input type="password" name="password" id="password"></td>
            <td></p></td>
         </tr>
         <tr>
           <td>E-mail</td>
           <td><input name="email" type="text" id="email" ></td>
         </tr>
         <tr>
           <td></td>
           <td><input type="submit" id="regsubmit" value="Signup" name="signup">
           </td>
         </tr>
       </table>
	   </form>
     <?php echo $massage ?>
	   <p>Already Registered ? <a href="index.php">Login</a> Here</p>
     
     <span id="state"></span>
	</div>


	
</div>
<?php include 'inc/footer.php'; ?>