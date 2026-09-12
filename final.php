<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_login();
require_once __DIR__ . '/inc/header.php';

$score = isset($_SESSION['score']) ? (int) $_SESSION['score'] : 0;
?>
<div class="main">
<h1>You are done!</h1>
<div class="starttest">
	<p>Congrats! You have just completed the test.</p>
	<p>Final Score: <?php echo $score; ?></p>
	<a href="viewans.php">View Ans</a>
	<a href="starttest.php">Start Again</a>
</div>
</div>
<?php include 'inc/footer.php'; ?>
