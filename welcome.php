<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_guest();

$welcome = $_SESSION['flash_welcome'] ?? null;
unset($_SESSION['flash_welcome']);
if (!$welcome) {
    redirect('register.php');
}

require_once __DIR__ . '/inc/header.php';
?>
<div class="main">
<h1>Welcome <?php echo e($welcome['name']); ?></h1>
    <div class="a">
    Your email address is: <?php echo e($welcome['email']); ?><br>
    Your user name is: <?php echo e($welcome['username']); ?><br>
    <p><a href="index.php">Login</a> Here</p>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
