<?php include 'inc/header.php'; ?>
<?php
if(isset($_SESSION['login'])){
  header("location:exam.php");
}
?>
<div class="main">
<h1>Welcome <?php echo $name; ?></h1>
    <div class="a">
    Your email address is: <?php echo $email; ?><br>
    Your user name is: <?php echo $username; ?><br>
    <p><a href="index.php">Login</a> Here</p>
    </div>
</body>
</html>