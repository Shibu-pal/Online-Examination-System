<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_login();

unset($_SESSION['score'], $_SESSION['user_answers']);

$stmt = db_prepare($conn, 'SELECT question_id FROM question ORDER BY question_id ASC LIMIT 1');
$stmt->execute();
$first = $stmt->get_result()->fetch_assoc();
$stmt->close();

$countStmt = db_prepare($conn, 'SELECT COUNT(*) AS total FROM question');
$countStmt->execute();
$totalRow = $countStmt->get_result()->fetch_assoc();
$countStmt->close();
$total = (int) ($totalRow['total'] ?? 0);

require_once __DIR__ . '/inc/header.php';
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

		<?php if ($total > 0 && $first) { ?>
			<a href="test.php?q=<?php echo (int) $first['question_id']; ?>&amp;n=1">Start Test</a>
		<?php } else { ?>
			<p class="error">No questions available. Please contact the admin.</p>
		<?php } ?>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
