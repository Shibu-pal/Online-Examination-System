<?php 
include('inc/header.php');
?>

<div class="main">
	<h1>Admin Panel - Question List</h1>

	<?php
	$SQL="SELECT * FROM question;";
	$Query = mysqli_query($conn, $SQL);
	?>

<div class="quelist">
	<table class="tblone">
		
		<tr>
			<th width="10%">No</th>
			<th width="70%">Questions</th>
			<th width="20%">Action</th>
		</tr>
		
		<?php
		for ($i=1;$result=mysqli_fetch_assoc($Query);$i++) {			
		?>

		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $result['question']; ?></td>
			<td>
				<a onclick="return confirm('Are You Sure to Remove')" href="que_action.php?delque=<?php echo $result['question_id'] ?>">Remove</a>
			</td>

		</tr>
		<?php } ?>
	

	</table>

</div>

	
</div>
<?php include 'inc/footer.php'; ?>