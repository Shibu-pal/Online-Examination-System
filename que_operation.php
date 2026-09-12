<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_student_login();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit'])) {
    redirect('exam.php');
}

$q = filter_input(INPUT_POST, 'q', FILTER_VALIDATE_INT);
$n = filter_input(INPUT_POST, 'n', FILTER_VALIDATE_INT);
$ans = filter_input(INPUT_POST, 'ans', FILTER_VALIDATE_INT);

if ($q === false || $q === null || $n === false || $n === null || $q < 1 || $n < 1) {
    redirect('starttest.php');
}

if ($ans === false || $ans === null || $ans < 1 || $ans > 4) {
    redirect('test.php?q=' . (int) $q . '&n=' . (int) $n . '&e=1');
}

if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
if (!isset($_SESSION['user_answers']) || !is_array($_SESSION['user_answers'])) {
    $_SESSION['user_answers'] = array();
}

$stmt = db_prepare($conn, 'SELECT question_id, correct_option FROM question WHERE question_id = ? LIMIT 1', 'i', array($q));
$stmt->execute();
$question = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$question) {
    redirect('starttest.php');
}

if (!isset($_SESSION['user_answers'][$q])) {
    if ((int) $question['correct_option'] === (int) $ans) {
        $_SESSION['score'] += 1;
    }
    $_SESSION['user_answers'][$q] = $ans;
}

$nextStmt = db_prepare(
    $conn,
    'SELECT question_id FROM question WHERE question_id > ? ORDER BY question_id ASC LIMIT 1',
    'i',
    array($q)
);
$nextStmt->execute();
$next = $nextStmt->get_result()->fetch_assoc();
$nextStmt->close();

if ($next) {
    redirect('test.php?q=' . (int) $next['question_id'] . '&n=' . ((int) $n + 1));
}

redirect('final.php');
