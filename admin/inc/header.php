<?php
define('ADMIN_AREA', true);
require_once __DIR__ . '/../../inc/bootstrap.php';
require_admin_login();
?>
<!doctype html>
<html>
<head>
	<title>Admin</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="-1">
	<meta http-equiv="Cache-Control" content="no-cache">
	<link rel="stylesheet" href="css/admin.css">
</head>
<body>
<div class="phpcoding">
	<section class="headeroption"></section>
		<section class="maincontent">
		<div class="menu">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="users.php">Manage User</a></li>
			<li><a href="quesadd.php">Add Ques</a></li>
			<li><a href="queslist.php">Ques List</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>
	 </div>
