<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_login();

$profile_message = '';

if (isset($_POST['update'])) {
    $id        = (int) $_SESSION['id'];
    $name      = trim((string) ($_POST['name'] ?? ''));
    $user_name = trim((string) ($_POST['user_name'] ?? ''));
    $email     = trim((string) ($_POST['email'] ?? ''));

    if ($name === '' || $user_name === '' || $email === '') {
        $profile_message = "<span class='error'>Fields Must Not be Empty !</span>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $profile_message = "<span class='error'>Invalid Email Address !</span>";
    } else {
        $check = db_prepare(
            $conn,
            'SELECT student_id FROM student WHERE email = ? AND student_id != ? LIMIT 1',
            'si',
            array($email, $id)
        );
        $check->execute();
        $taken = $check->get_result()->fetch_assoc();
        $check->close();

        if ($taken) {
            $profile_message = "<span class='error'>Email Address Already Exists !</span>";
        } else {
            $stmt = db_prepare(
                $conn,
                'UPDATE student SET name = ?, user_name = ?, email = ? WHERE student_id = ?',
                'sssi',
                array($name, $user_name, $email, $id)
            );
            if ($stmt->execute()) {
                $_SESSION['name']      = $name;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['email']     = $email;
                $profile_message = "<span class='success'>User Data Updated !</span>";
            } else {
                $profile_message = "<span class='error'>User Data Not Updated !</span>";
            }
            $stmt->close();
        }
    }
}

require_once __DIR__ . '/inc/header.php';
?>
<style>
	.profile{width: 440px;margin: 0 auto;border: 1px solid #ddd;padding: 30px 50px 50px 138px;}
</style>
<div class="main">
<h1>Your Profile</h1>
<div class="profile">
	<?php echo $profile_message; ?>
	<form action="" method="post">
		<table class="tbl">
		     <tr>
			   <td>Name</td>
			   <td><input name="name" type="text" value="<?php echo e($_SESSION['name']); ?>" required /></td>
			 </tr>
			  <tr>
			   <td>Username</td>
			   <td><input name="user_name" type="text" value="<?php echo e($_SESSION['user_name']); ?>" required /></td>
			 </tr>
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="email" value="<?php echo e($_SESSION['email']); ?>" required /></td>
			 </tr>
			  <tr>
			  <td></td>
			   <td><input type="submit" value="Update" name="update">
			   </td>
			 </tr>
       </table>
	   </form>
	   </div>
</div>
<?php include 'inc/footer.php'; ?>
