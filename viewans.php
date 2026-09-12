<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_login();

$stmt = db_prepare($conn, 'SELECT * FROM question ORDER BY question_id ASC');
$stmt->execute();
$resultSet = $stmt->get_result();
$questionList = array();
while ($row = $resultSet->fetch_assoc()) {
    $questionList[] = $row;
}
$stmt->close();
$total = count($questionList);

$user_answers = isset($_SESSION['user_answers']) && is_array($_SESSION['user_answers'])
    ? $_SESSION['user_answers']
    : array();

require_once __DIR__ . '/inc/header.php';
?>
<div class="main">
<h1>All Question &amp; Ans: <?php echo (int) $total; ?></h1>
	<div class="viewans">
		<table>
			<?php
			foreach ($questionList as $index => $result) {
				$i = $index + 1;
				$user_ans = $user_answers[$result['question_id']] ?? 'Not Answered';
			?>
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $i; ?>: <?php echo e($result['question']); ?></h3>
				</td>
			</tr>
			<tr>
				<td>
				  <?php
					for ($j = 1; $j <= 4; $j++) {
						$option_text = $result['option' . $j];
						$style = '';
						$indicator = '';

						if ((int) $result['correct_option'] === $j) {
							$style = 'color:blue; font-weight:bold;';
						}

						if ((string) $user_ans === (string) $j) {
							if ((int) $user_ans === (int) $result['correct_option']) {
								$style = 'color:green; font-weight:bold;';
								$indicator = " <span style='color:green;'>(Correct)</span>";
							} else {
								$style = 'color:red;';
								$indicator = " <span style='color:red;'>(Your Answer)</span>";
							}
						}

						echo "<span style='" . e($style) . "'>" . e($option_text) . '</span>' . $indicator . '<br>';
					}
				  ?>
				  <div></div>
				</td>
			</tr>
			<?php } ?>
		</table>
		<a href="starttest.php">Start Again</a>
	</div>
</div>
<?php include 'inc/footer.php'; ?>
