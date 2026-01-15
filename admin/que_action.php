<?php
include("../config/config.php");
session_start();
if(!isset($_SESSION['admin_login'])){
	header("location:login.php");
}
$id=$_GET['delque'];
$SQL="DELETE FROM question WHERE question_id = '$id'";
$Query=mysqli_query($conn,$SQL);
if ($Query) {
   header("location:queslist.php");
}
?>