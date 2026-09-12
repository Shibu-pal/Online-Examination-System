<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_login();

$que_no = filter_input(INPUT_GET, 'q', FILTER_VALIDATE_INT);
$number = filter_input(INPUT_GET, 'n', FILTER_VALIDATE_INT);
if ($que_no === false || $que_no === null || $number === false || $number === null || $que_no < 1 || $number < 1) {
    redirect('starttest.php');
}

$stmt = db_prepare($conn, 'SELECT * FROM question WHERE question_id = ? LIMIT 1', 'i', array($que_no));
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$result) {
    redirect('starttest.php');
}

$countStmt = db_prepare($conn, 'SELECT COUNT(*) AS total FROM question');
$countStmt->execute();
$totalRow = $countStmt->get_result()->fetch_assoc();
$countStmt->close();
$total = (int) ($totalRow['total'] ?? 0);

$emptyError = isset($_GET['e']);

require_once __DIR__ . '/inc/header.php';
?>
<div class="main">
<h1>Question <?php echo (int) $number; ?> of <?php echo $total; ?></h1>
	<div class="test">
		<?php if ($emptyError) { ?>
			<p class="error">Please select an answer.</p>
		<?php } ?>
		<form method="post" action="que_operation.php">
		<table>
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo (int) $number; ?>: <?php echo e($result['question']); ?></h3>
				</td>
			</tr>
			<tr>
				<td>
				 <input type="radio" name="ans" value="1" /><?php echo e($result['option1']); ?><br>
				 <input type="radio" name="ans" value="2" /><?php echo e($result['option2']); ?><br>
				 <input type="radio" name="ans" value="3" /><?php echo e($result['option3']); ?><br>
				 <input type="radio" name="ans" value="4" /><?php echo e($result['option4']); ?>
				</td>
			</tr>
			<tr>
			  <td>
				  <input type="hidden" name="q" value="<?php echo (int) $que_no; ?>" />
				  <input type="hidden" name="n" value="<?php echo (int) $number; ?>" />
				  <input type="submit" name="submit" value="Next Question"/>
			</td>
			</tr>
		</table>
	</form>
</div>
 </div>
<?php include 'inc/footer.php'; ?>
