<?php
include 'inc/header.php';

$add_message = '';

if (isset($_POST['add'])) {
    $ques     = trim((string) ($_POST['ques'] ?? ''));
    $ans1     = trim((string) ($_POST['ans1'] ?? ''));
    $ans2     = trim((string) ($_POST['ans2'] ?? ''));
    $ans3     = trim((string) ($_POST['ans3'] ?? ''));
    $ans4     = trim((string) ($_POST['ans4'] ?? ''));
    $rightAns = filter_input(INPUT_POST, 'rightAns', FILTER_VALIDATE_INT);

    if ($ques === '' || $ans1 === '' || $ans2 === '' || $ans3 === '' || $ans4 === '') {
        $add_message = "<span class='error'>Fields Must Not be Empty !</span>";
    } elseif ($rightAns === false || $rightAns === null || $rightAns < 1 || $rightAns > 4) {
        $add_message = "<span class='error'>Correct option must be between 1 and 4 !</span>";
    } else {
        $stmt = db_prepare(
            $conn,
            'INSERT INTO question (question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)',
            'ssssss',
            array($ques, $ans1, $ans2, $ans3, $ans4, (string) $rightAns)
        );
        if ($stmt->execute()) {
            $add_message = "<span class='success'>Question Added Successfully...</span>";
        } else {
            $add_message = "<span class='error'>Question could not be added !</span>";
        }
        $stmt->close();
    }
}

$countStmt = db_prepare($conn, 'SELECT COUNT(*) AS total FROM question');
$countStmt->execute();
$totalRow = $countStmt->get_result()->fetch_assoc();
$countStmt->close();
$nextNo = (int) ($totalRow['total'] ?? 0) + 1;
?>
<style>
.adminpanel{width: 480px;color: #999;margin: 20px auto 0;padding: 30px;border: 1px solid #ddd;}
</style>
<div class="main">
<h1>Admin Panel - Add Question</h1>
<?php echo $add_message; ?>
<div class="adminpanel">
	<form action="" method="post" autocomplete="off">
		<table>
			<tr>
				<td>Question No</td>
				<td>:</td>
				<td><input type="number" value="<?php echo $nextNo; ?>" name="quesNo" readonly></td>
			</tr>
			<tr>
				<td>Question</td>
				<td>:</td>
				<td><input type="text" name="ques" placeholder="Enter Question..." required></td>
			</tr>
			<tr>
				<td>Choice One</td>
				<td>:</td>
				<td><input type="text" name="ans1" placeholder="Enter Choice One..." required></td>
			</tr>
			<tr>
				<td>Choice Two</td>
				<td>:</td>
				<td><input type="text" name="ans2" placeholder="Enter Choice Two..." required></td>
			</tr>
			<tr>
				<td>Choice Three</td>
				<td>:</td>
				<td><input type="text" name="ans3" placeholder="Enter Choice Three..." required></td>
			</tr>
			<tr>
				<td>Choice Four</td>
				<td>:</td>
				<td><input type="text" name="ans4" placeholder="Enter Choice Four..." required></td>
			</tr>
			<tr>
				<td>Correct No.</td>
				<td>:</td>
				<td><input type="number" name="rightAns" min="1" max="4" required></td>
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
