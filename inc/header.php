<?php
if (!isset($conn)) {
    require_once __DIR__ . '/bootstrap.php';
}
?>
<!doctype html>
<html>
<head>
	<title>Online Exam System</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link rel="stylesheet" href="css/main.css">
	<style>
		.a{
			text-align: center;
		}
	</style>
</head>
<body>
<div class="phpcoding">
	<section class="headeroption"></section>
		<section class="maincontent">
		<div class="menu">
		<ul>
			<?php if (is_student_logged_in()) { ?>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="exam.php">Exam</a></li>
			<li><a href="logout.php">Logout</a></li>
			<?php } else { ?>
			<li><a href="register.php">Register</a></li>
			<li><a href="index.php">Login</a></li>
			<li><a href="admin/index.php">Admin Login</a></li>
			<?php } ?>
		</ul>
		<span style="float: right;color: #888;">
			<?php if (is_student_logged_in()) { ?>
				Welcome <strong><?php echo e($_SESSION['name']); ?></strong>
			<?php } ?>
		</span>
		</div>
