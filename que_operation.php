<?php
include 'inc/header.php';
if(!isset($_SESSION['login'])){
    header("location:index.php");
}
if (!isset($_SESSION['score'])) {
    $_SESSION['score']=0;
}
if (isset($_POST['submit'])) {
    $ans=$_POST['ans'];
    $q=$_POST['q'];
    $_SESSION['user_answers'][$q] = $ans;
    $n=$_POST['n']+1;
    $SQL="SELECT * FROM question";
    $Query=mysqli_query($conn,$SQL);
    $total=mysqli_num_rows($Query);
    echo $total;
    while ($result=mysqli_fetch_assoc($Query)) {
        if ($result['question_id']==$q) {
            if ($result['correct_option']==$ans) {
                $_SESSION['score']+=1;
            }
            if ($total<$n) {
                header("location:final.php");
            }else {
                $result=mysqli_fetch_assoc($Query);
                $q=$result['question_id'];
                header("location:test.php?q=$q&n=$n");
            }
        }
    }
}
?>