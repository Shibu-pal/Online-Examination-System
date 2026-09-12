<?php
define('ADMIN_AREA', true);
require_once __DIR__ . '/../inc/bootstrap.php';
require_admin_login();

$id = filter_input(INPUT_GET, 'delque', FILTER_VALIDATE_INT);
if ($id === false || $id === null || $id < 1) {
    redirect('queslist.php');
}

$stmt = db_prepare($conn, 'DELETE FROM question WHERE question_id = ?', 'i', array($id));
$stmt->execute();
$stmt->close();
redirect('queslist.php');
