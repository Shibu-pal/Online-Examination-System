<?php 
include('inc/header.php');
?>

<style>
.adminpanel{width: 480px;color: #999;margin: 20px auto 0;padding: 30px;border: 1px solid #ddd;}	
</style>
<div class="main">
<h1>Admin Panel - Add Question</h1>

<?php
if (isset($_POST['add'])){
	$ques=$_POST['ques'];
	$ans1=$_POST['ans1'];
	$ans2=$_POST['ans2'];
	$ans3=$_POST['ans3'];
	$ans4=$_POST['ans4'];
	$rightAns=$_POST['rightAns'];
	$SQL=
	"INSERT INTO question (question, option1, option2, option3, option4, correct_option)
	VALUES ('$ques', '$ans1', '$ans2', '$ans3', '$ans4', '$rightAns');";
	$Query = mysqli_query($conn, $SQL);
	if ($Query) {
		echo "<span class='success'>Question Added Successfully...</span>";
	}
}
?>

<?php
$SQL="SELECT * FROM question;";
$Query = mysqli_query($conn, $SQL);
$Query=mysqli_num_rows($Query);
?>

<div class="adminpanel">
	
	<form action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="off">
		<table>
			<tr>
				<td>Question No</td>
				<td>:</td>
				<td><input type="number" value="<?php echo $Query+1; ?>"  name="quesNo"></td>
			</tr>

			<tr>
				<td>Question</td>
				<td>:</td>
				<td><input type="text"  name="ques" placeholder="Enter Question..." required></td>
			</tr>

			<tr>
				<td>Choice One</td>
				<td>:</td>
				<td><input type="text"  name="ans1" placeholder="Enter Question..." required></td>
			</tr>

			<tr>
				<td>Choice Two</td>
				<td>:</td>
				<td><input type="text"  name="ans2" placeholder="Enter Question..." required></td>
			</tr>

			<tr>
				<td>Choice Three</td>
				<td>:</td>
				<td><input type="text"  name="ans3" placeholder="Enter Question..." required></td>
			</tr>

			<tr>
				<td>Choice Four</td>
				<td>:</td>
				<td><input type="text"  name="ans4" placeholder="Enter Question..." required></td>
			</tr>

			<tr>
				<td>Correct No.</td>
				<td>:</td>
				<td><input type="number"  name="rightAns" required></td>
			</tr>

			<tr>
				
				<td colspan="3" align="center">
					<input type="submit" value="Add A Question" name="add">
				</td>
			</tr>

		</table>


	</form>

</div>

	
</div>
<?php include 'inc/footer.php'; ?>