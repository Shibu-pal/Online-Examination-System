<?php
include("../config/config.php");
session_start();
if(!isset($_SESSION['admin_login'])){
	header("location:login.php");
}

if ($_GET['dis']) {
    $id=$_GET['dis'];
    $SQL="UPDATE student SET status = '0' WHERE student_id = '$id'";
} elseif ($_GET['ena']) {
    $id=$_GET['ena'];
    $SQL="UPDATE student SET status = '1' WHERE student_id = '$id'";    
} elseif ($_GET['del']) {
    $id=$_GET['del'];
    $SQL="DELETE FROM student WHERE student_id = '$id'";
}
$Query=mysqli_query($conn,$SQL);
if ($Query) {
   header("location:users.php");
}
?>