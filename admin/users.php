<?php
include 'inc/header.php';

$stmt = db_prepare($conn, 'SELECT student_id, name, user_name, email, status FROM student ORDER BY student_id ASC');
$stmt->execute();
$users = $stmt->get_result();
?>
<div class="main">
	<h1>Admin Panel - Manage User</h1>
<div class="manageuser">
	<table class="tblone">
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>Action</th>
		</tr>
		<?php
		$i = 1;
		while ($result = $users->fetch_assoc()) {
		?>
		<tr>
			<td><?php
				if ($result['status']) {
					echo $i;
				} else {
					echo "<span class='error'>" . $i . '</span>';
				}
			?></td>
			<td><?php echo e($result['name']); ?></td>
			<td><?php echo e($result['user_name']); ?></td>
			<td><?php echo e($result['email']); ?></td>
			<td>
				<?php if ($result['status']) { ?>
					<a onclick="return confirm('Are You Sure to Disable')" href="user_action.php?dis=<?php echo (int) $result['student_id']; ?>">Disable</a>
				<?php } else { ?>
					<a onclick="return confirm('Are You Sure to Enable')" href="user_action.php?ena=<?php echo (int) $result['student_id']; ?>">Enable</a>
				<?php } ?>
				||<a onclick="return confirm('Are You Sure to Remove')" href="user_action.php?del=<?php echo (int) $result['student_id']; ?>">Remove</a>
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
