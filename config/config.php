<?php
$hostname     = getenv('DB_HOST') ?: 'localhost';
$username     = getenv('DB_USER') ?: 'root';
$db_password  = getenv('DB_PASS');
if ($db_password === false) {
    $db_password = ''; // default XAMPP password
}
$databaseName = getenv('DB_NAME') ?: 'majorproject';

$conn = mysqli_connect($hostname, $username, $db_password, $databaseName);

if (!$conn) {
    die('Database connection failed: ' . mysqli_connect_error());
}

mysqli_set_charset($conn, 'utf8mb4');
