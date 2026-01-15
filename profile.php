<?php include 'inc/header.php'; ?>
<?php
if(!isset($_SESSION['login'])){
  header("location:index.php");
}
?>

<?php
if (isset($_POST['update'])){
	$id=$_SESSION['id'];
	$name=$_POST['name'];
	$user_name=$_POST['user_name'];
	$email=$_POST['email'];
	$SQL="UPDATE student SET name = '$name' ,
	user_name = '$user_name' ,email = '$email'
	WHERE `student`.`student_id` = $id;";
	$Query=mysqli_query($conn,$SQL);
	if ($Query>0) {
		$_SESSION['name']=$name;
		$_SESSION['user_name']=$user_name;
		$_SESSION['email']=$email;
		echo "<span class='success'>User Data Updated !  </span>";
	} else {
		echo "<span class='error'>User Data Not Updated !  </span>";
	}

}
?>

<style>
	.profile{width: 440px;margin: 0 auto;border: 1px solid #ddd;padding: 30px 50px 50px 138px;}
</style>

<div class="main">
<h1>Your Profile</h1>
<div class="profile">

   
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	
		<table class="tbl"> 
		     <tr>
			   <td>Name</td>
			   <td><input name="name" type="text" value="<?php echo $_SESSION['name'] ?>" /></td>
			 </tr> 
			  <tr>
			   <td>Username</td>
			   <td><input name="user_name" type="text" value="<?php echo $_SESSION['user_name'] ?>"/></td>
			 </tr>  
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" value="<?php echo $_SESSION['email'] ?>"/></td>
			 </tr>		 
			  <tr>
			  <td></td>
			   <td><input type="submit" value="Update" name="update">
			   </td>
			 </tr>
       </table>

   
	   </form>	
	   </div>
</div>
<?php include 'inc/footer.php'; ?>