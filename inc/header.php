<?php 
include('config/config.php');
session_start();
$massage="";
?>

<?php
// for register.php page
if(isset($_POST['signup'])){
  $name=mysqli_real_escape_string($conn,$_POST['name']);
  $username=mysqli_real_escape_string($conn,$_POST['username']);
  $password=mysqli_real_escape_string($conn,$_POST['password']);
  $password=md5($password);
  $email=mysqli_real_escape_string($conn,$_POST['email']);
	
  if ($name == "" || $username == "" || $password == "" || $email == "") {
	$massage="<span class='error'>Fields Must Not be Empty !</span>";
  }else{
	$SQL = "SELECT student_id FROM student WHERE email = '$email'";
	$Query = mysqli_query($conn, $SQL);
	$Query=mysqli_num_rows($Query);
	if ($Query > 0) {
		$massage="<span class='error'>Email Address Already Eixst !</span>";
	}else {
		$SQL=("INSERT INTO student(name,user_name,password,email,status) VALUES('$name','$username','$password','$email',1)");
		$Query = mysqli_query($conn, $SQL);
		if ($Query){
			header("Location:welcome.php?name=$name&email=$email&username=$username");
		}else {
			$massage="<span class='error'>Error.. Not Registered !</span>";
		}
	}
  }
}
?>

<?php
// for wellcome.php page
if(isset($_GET['name']) && isset($_GET['username']) && isset($_GET['email'])){
  $name=$_GET['name'];
  $username=$_GET['username'];
  $email=$_GET['email'];
}
?>

<?php
// for index.php page
if(isset($_POST['login'])){
	$email=mysqli_real_escape_string($conn,$_POST['email']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
  	$password=md5($password);

	if ($password == "" || $email == "") {
		$massage="<span class='error'>Fields Must Not be Empty !</span>";
	}else{
		$SQL = "SELECT student_id,name,user_name,email,status FROM student WHERE email = '$email' && password = '$password'";
		$Query = mysqli_query($conn, $SQL);
		$Query=mysqli_fetch_assoc($Query);
		if($Query > 0){
			if($Query['status']){
				$_SESSION['login']=1;
				$_SESSION['id']=$Query['student_id'];
				$_SESSION['name']=$Query['name'];
				$_SESSION['user_name']=$Query['user_name'];
				$_SESSION['email']=$Query['email'];
				header("location:exam.php");
			}else {				
			$massage = "<span class='error'>User Id disabled !</span>";
			}
		} else {
			$massage = "<span class='error'>Email or Password not matched !</span>";
		}
	}
}
?>
<!doctype html>
<html>
<head>
	<title>Online Exam System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link rel="stylesheet" href="css/main.css">
	<style>
		.a{
			text-align: center;
		}
	</style>
	<!-- <script src="js/jquery.js"></script> -->
	<!-- <script src="js/main.js"></script> -->
</head>
<body>


	

<div class="phpcoding">
	<section class="headeroption"></section>
		<section class="maincontent">
		<div class="menu">
		<ul>

			<?php
			if(isset($_SESSION['login'])){
			?>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="exam.php">Exam</a></li>
			<li><a href="logout.php">Logout</a></li>
			<?php }else { ?>
			<li><a href="register.php">Register</a></li>
			<li><a href="index.php">Login</a></li>
			<li><a href="admin/index.php">Admin Login</a></li>
			<?php } ?>
			
		</ul>
		

		<span style="float: right;color: #888;">
			<?php
				if(isset($_SESSION['login'])){
			?>
				Welcome <strong><?PHP echo $_SESSION['name']; ?></strong>
			<?php } ?>
		</span>
		
		</div>