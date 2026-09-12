<?php
$configPath = __DIR__ . '/../config/config.php';
if (!is_file($configPath)) {
    die('Missing config/config.php. Copy config/config.example.php to config/config.php and update the database settings.');
}

require_once $configPath;
require_once __DIR__ . '/functions.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$message = '';

if (!defined('ADMIN_AREA')) {
    handle_student_auth($conn, $message);
}
