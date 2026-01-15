<?php
include("../config/config.php");
session_start();
?>

<?php
$massage="";
if(isset($_POST['login'])){
	$user_name=mysqli_real_escape_string($conn,$_POST['user_name']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);
	$password=md5($password);
	if ($password == "" || $user_name == "") {
		$massage="<span class='error'>Fields Must Not be Empty !</span>";
	}else{
		$SQL = "SELECT admin_id,user_name FROM admin WHERE user_name = '$user_name' && password = '$password'";
		$Query = mysqli_query($conn, $SQL);
		$Query=mysqli_fetch_assoc($Query);
		if($Query > 0){
			$_SESSION['admin_login']=1;
			$_SESSION['id']=$Query['admin_id'];
			$_SESSION['user_name']=$Query['user_name'];
			header("location:index.php");
		} else {
			$massage = "<span class='error'>Email or Password not matched !</span>";
		}
	}
}
?>

<?php
if(isset($_SESSION['admin_login'])){
	header(("location:index.php"));
}
?>
<!doctype html>
<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="phpcoding">
	<section class="headeroption"></section>
		<section class="maincontent">

	