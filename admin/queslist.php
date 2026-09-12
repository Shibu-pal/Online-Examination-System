<?php
include 'inc/header.php';

$stmt = db_prepare($conn, 'SELECT question_id, question FROM question ORDER BY question_id ASC');
$stmt->execute();
$questions = $stmt->get_result();
?>
<div class="main">
	<h1>Admin Panel - Question List</h1>
<div class="quelist">
	<table class="tblone">
		<tr>
			<th width="10%">No</th>
			<th width="70%">Questions</th>
			<th width="20%">Action</th>
		</tr>
		<?php
		$i = 1;
		while ($result = $questions->fetch_assoc()) {
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo e($result['question']); ?></td>
			<td>
				<a onclick="return confirm('Are You Sure to Remove')" href="que_action.php?delque=<?php echo (int) $result['question_id']; ?>">Remove</a>
			</td>
		</tr>
		<?php
			$i++;
		}
		$stmt->close();
		?>
	</table>
</div>
</div>
<?php include 'inc/footer.php'; ?>
