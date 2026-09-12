<?php
define('ADMIN_AREA', true);
require_once __DIR__ . '/../inc/bootstrap.php';
require_admin_login();

$disId = filter_input(INPUT_GET, 'dis', FILTER_VALIDATE_INT);
$enaId = filter_input(INPUT_GET, 'ena', FILTER_VALIDATE_INT);
$delId = filter_input(INPUT_GET, 'del', FILTER_VALIDATE_INT);

if ($disId !== false && $disId !== null && $disId > 0) {
    $stmt = db_prepare($conn, 'UPDATE student SET status = 0 WHERE student_id = ?', 'i', array($disId));
    $stmt->execute();
    $stmt->close();
} elseif ($enaId !== false && $enaId !== null && $enaId > 0) {
    $stmt = db_prepare($conn, 'UPDATE student SET status = 1 WHERE student_id = ?', 'i', array($enaId));
    $stmt->execute();
    $stmt->close();
} elseif ($delId !== false && $delId !== null && $delId > 0) {
    $stmt = db_prepare($conn, 'DELETE FROM student WHERE student_id = ?', 'i', array($delId));
    $stmt->execute();
    $stmt->close();
}

redirect('users.php');
