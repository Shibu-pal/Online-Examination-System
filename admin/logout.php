<?php
define('ADMIN_AREA', true);
require_once __DIR__ . '/../inc/bootstrap.php';
session_unset();
session_destroy();
redirect('login.php');
