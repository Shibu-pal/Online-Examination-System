<?php include 'inc/header.php'; ?>
<?php
if(!isset($_SESSION['login'])){
  header("location:index.php");
}
$SQL="SELECT * FROM question;";
$Query=mysqli_query($conn,$SQL);
$total=mysqli_num_rows($Query);
?>
<div class="main">
<h1>All Question & Ans:<?php echo $total; ?></h1>
	<div class="viewans">
		<table> 
			<?php
			for ($i=1;$result=mysqli_fetch_assoc($Query);$i++) {
				$user_ans = isset($_SESSION['user_answers'][$result['question_id']]) ? $_SESSION['user_answers'][$result['question_id']] : "Not Answered";
			?>
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $i; ?>: <?php echo $result['question']; ?></h3>
				</td>
			</tr>
			<tr>
				<td>
				 <!-- <input type="radio"/> -->
				  <?php
					for ($j = 1; $j <= 4; $j++) {
						$option_text = $result['option' . $j];
						$style = "";
						$indicator = "";

						// Highlight correct answer in Blue (Existing logic)
						if ($result['correct_option'] == $j) {
							$style = "color:blue; font-weight:bold;";
						}

						// Show "Your Answer" indicator
						if ($user_ans == $j) {
							if ($user_ans == $result['correct_option']) {
								$style = "color:green; font-weight:bold;";
								$indicator = " <span style='color:green;'>(Correct)</span>";
							} else {
								$style = "color:red;"; // Highlight wrong answer in Red
								$indicator = " <span style='color:red;'>(Your Answer)</span>";
							}
						}

						echo "<span style='$style'>$option_text</span>$indicator<br>";
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