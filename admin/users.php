<?php 
include('inc/header.php');
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
		$SQL="SELECT student_id, name, user_name, email, status FROM student";
		$Query=mysqli_query($conn,$SQL);
		$i=1;
		for ($i=1;$result=mysqli_fetch_assoc($Query);$i++) {
		?>

		<tr>
			<td><?php 
				if ($result['status']) {
					echo $i; 
				}else{
					echo "<span class='error'>".$i."</span>";
				}
			?></td>

			<td><?php echo $result['name'] ; ?></td>
			<td><?php echo $result['user_name'] ; ?></td>
			<td><?php echo $result['email'] ; ?></td>

			<td>
				<?php
					if ($result['status']) { ?>
						<a onclick="return confirm('Are You Sure to Disable')" href="user_action.php?dis=<?php echo $result['student_id'];?>">Disable</a>
					<?php } else{ ?>
						<a onclick="return confirm('Are You Sure to Enable')" href="user_action.php?ena=<?php echo $result['student_id'];?>">Enable</a>
					<?php }?>
				||<a onclick="return confirm('Are You Sure to Remove')" href="user_action.php?del=<?php echo $result['student_id'];?>">Remove</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
</div>
<?php include 'inc/footer.php'; ?>