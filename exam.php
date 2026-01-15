<?php include 'inc/header.php'; ?>
<?php
if(!isset($_SESSION['login'])){
  header("location:index.php");
}
?>
<div class="main">
<h1>Welcome to Online Exam - Start Now</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/exam.png"/>
	</div>
	<div class="segment">
	<h2>Start Test</h2>
	<ul>
		<li><a href="starttest.php">Start Now...</a></li>
	</ul>
	</div>
	
  </div>
<?php include 'inc/footer.php'; ?>