<?php

function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

function is_student_logged_in()
{
    return !empty($_SESSION['login']);
}

function is_admin_logged_in()
{
    return !empty($_SESSION['admin_login']);
}

function require_student_login()
{
    if (!is_student_logged_in()) {
        redirect('index.php');
    }
}

function require_student_guest()
{
    if (is_student_logged_in()) {
        redirect('exam.php');
    }
}

function require_admin_login()
{
    if (!is_admin_logged_in()) {
        redirect('login.php');
    }
}

function require_admin_guest()
{
    if (is_admin_logged_in()) {
        redirect('index.php');
    }
}

function hash_password($plain)
{
    return password_hash($plain, PASSWORD_DEFAULT);
}

function password_is_legacy_md5($hash)
{
    return is_string($hash) && strlen($hash) === 32 && ctype_xdigit($hash);
}

function verify_password($plain, $hash)
{
    if (!is_string($hash) || $hash === '') {
        return false;
    }

    if (password_verify($plain, $hash)) {
        return true;
    }

    if (password_is_legacy_md5($hash) && hash_equals(strtolower($hash), md5($plain))) {
        return true;
    }

    return false;
}

function password_should_rehash($hash)
{
    if (password_is_legacy_md5($hash)) {
        return true;
    }

    return password_needs_rehash($hash, PASSWORD_DEFAULT);
}

function upgrade_password(mysqli $conn, $plain, $table, $idColumn, $id)
{
    $newHash = hash_password($plain);
    $allowed = array(
        'student' => 'student_id',
        'admin'   => 'admin_id',
    );
    if (!isset($allowed[$table]) || $allowed[$table] !== $idColumn) {
        return;
    }

    $sql  = "UPDATE {$table} SET password = ? WHERE {$idColumn} = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $id = (int) $id;
        $stmt->bind_param('si', $newHash, $id);
        $stmt->execute();
        $stmt->close();
    }
}

function db_prepare(mysqli $conn, $sql, $types = '', $params = array())
{
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Database error.');
    }
    if ($types !== '') {
        $stmt->bind_param($types, ...$params);
    }
    return $stmt;
}

function handle_student_auth(mysqli $conn, &$message)
{
    if (isset($_POST['signup'])) {
        $name     = trim((string) ($_POST['name'] ?? ''));
        $username = trim((string) ($_POST['username'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $email    = trim((string) ($_POST['email'] ?? ''));

        if ($name === '' || $username === '' || $password === '' || $email === '') {
            $message = "<span class='error'>Fields Must Not be Empty !</span>";
            return;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $message = "<span class='error'>Invalid Email Address !</span>";
            return;
        }
        if (strlen($password) < 4) {
            $message = "<span class='error'>Password must be at least 4 characters !</span>";
            return;
        }

        $stmt = db_prepare($conn, 'SELECT student_id FROM student WHERE email = ? LIMIT 1', 's', array($email));
        $stmt->execute();
        $exists = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($exists) {
            $message = "<span class='error'>Email Address Already Exists !</span>";
            return;
        }

        $hash = hash_password($password);
        $stmt = db_prepare(
            $conn,
            'INSERT INTO student (name, user_name, password, email, status) VALUES (?, ?, ?, ?, 1)',
            'ssss',
            array($name, $username, $hash, $email)
        );

        if ($stmt->execute()) {
            $stmt->close();
            $_SESSION['flash_welcome'] = array(
                'name'     => $name,
                'email'    => $email,
                'username' => $username,
            );
            redirect('welcome.php');
        }

        $stmt->close();
        $message = "<span class='error'>Error.. Not Registered !</span>";
        return;
    }

    if (isset($_POST['login']) && isset($_POST['email'])) {
        $email    = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $message = "<span class='error'>Fields Must Not be Empty !</span>";
            return;
        }

        $stmt = db_prepare(
            $conn,
            'SELECT student_id, name, user_name, email, status, password FROM student WHERE email = ? LIMIT 1',
            's',
            array($email)
        );
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$user || !verify_password($password, $user['password'])) {
            $message = "<span class='error'>Email or Password not matched !</span>";
            return;
        }

        if (empty($user['status'])) {
            $message = "<span class='error'>User Id disabled !</span>";
            return;
        }

        if (password_should_rehash($user['password'])) {
            upgrade_password($conn, $password, 'student', 'student_id', (int) $user['student_id']);
        }

        session_regenerate_id(true);
        $_SESSION['login']     = 1;
        $_SESSION['id']        = (int) $user['student_id'];
        $_SESSION['name']      = $user['name'];
        $_SESSION['user_name'] = $user['user_name'];
        $_SESSION['email']     = $user['email'];
        redirect('exam.php');
    }
}

function handle_admin_auth(mysqli $conn, &$message)
{
    if (!isset($_POST['login']) || !isset($_POST['user_name'])) {
        return;
    }

    $user_name = trim((string) ($_POST['user_name'] ?? ''));
    $password  = (string) ($_POST['password'] ?? '');

    if ($user_name === '' || $password === '') {
        $message = "<span class='error'>Fields Must Not be Empty !</span>";
        return;
    }

    $stmt = db_prepare(
        $conn,
        'SELECT admin_id, user_name, password FROM admin WHERE user_name = ? LIMIT 1',
        's',
        array($user_name)
    );
    $stmt->execute();
    $admin = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$admin || !verify_password($password, $admin['password'])) {
        $message = "<span class='error'>Username or Password not matched !</span>";
        return;
    }

    if (password_should_rehash($admin['password'])) {
        upgrade_password($conn, $password, 'admin', 'admin_id', (int) $admin['admin_id']);
    }

    session_regenerate_id(true);
    $_SESSION['admin_login']     = 1;
    $_SESSION['admin_id']        = (int) $admin['admin_id'];
    $_SESSION['admin_user_name'] = $admin['user_name'];
    redirect('index.php');
}
