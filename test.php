<?php include 'inc/header.php'; ?>
<?php
if(!isset($_SESSION['login'])){
  header("location:index.php");
}
?>

<?php
if (isset($_GET['q'])&&isset($_GET['n'])) {
	$que_no=$_GET['q'];
	$number=$_GET['n'];
}
$SQL="SELECT * FROM question WHERE question_id = $que_no;";
$Query1=mysqli_query($conn,$SQL);
$SQL="SELECT * FROM question";
$Query2=mysqli_query($conn,$SQL);
$total=mysqli_num_rows($Query2);
$result=mysqli_fetch_assoc($Query1);
?>

<div class="main">
<h1>Question <?php echo $number; ?> of <?php echo $total; ?></h1>
	<div class="test">
		<form method="post" action="que_operation.php">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $number; ?>: <?php echo $result['question']; ?></h3>
				</td>
			</tr>
			<tr>
				<td>
				 <input type="radio" name="ans" value="1" /><?php echo $result['option1']; ?><br>
				 <input type="radio" name="ans" value="2" /><?php echo $result['option2']; ?><br>
				 <input type="radio" name="ans" value="3" /><?php echo $result['option3']; ?><br>
				 <input type="radio" name="ans" value="4" /><?php echo $result['option4']; ?>
				</td>
			</tr>
			<tr>
			  <td>
				  <input type="hidden" name="q" value="<?php echo $que_no; ?>" />
				  <input type="hidden" name="n" value="<?php echo $number; ?>" />
				  <input type="submit" name="submit" value="Next Question"/>
			</td>
			</tr>
			
		</table>
	</form>
</div>
 </div>
<?php include 'inc/footer.php'; ?>