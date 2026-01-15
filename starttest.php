<?php include 'inc/header.php'; ?>
<?php
if(!isset($_SESSION['login'])){
  header("location:index.php");
}
if (isset($_SESSION['score'])) {
	unset($_SESSION['score']);
}
if (isset($_SESSION['user_answers'])) {
    unset($_SESSION['user_answers']);
}
?>

<?php
$SQL="SELECT * FROM question;";
$Query=mysqli_query($conn,$SQL);
$total=mysqli_num_rows($Query);
$result=mysqli_fetch_assoc($Query);
?>

<div class="main">
<h1>Welcome to Online Exam</h1>
	<div class="starttest">
		<h2>Test your knowledge</h2>
		<p>This is multiple choice quiz to test your knowledge</p>

		<ul>
			<li><strong>Number of Questions:</strong> <?php echo $total; ?></li>
			<li><strong>Question Type:</strong> Multiple Choice</li>
		</ul>

		<a href="test.php?q=<?php echo $result['question_id'] ?>&n=1">Start Test</a>

	</div>

  </div>
<?php include 'inc/footer.php'; ?>