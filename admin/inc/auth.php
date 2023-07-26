<?php

$authError = '';

if ($_SERVER['REQUEST_URI'] == '/admin/login.php' && $_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['login'] == ADMIN_LOGIN && $_POST['password'] == ADMIN_PASSWORD) {
        $_SESSION['is_admin'] = 1;
    } else {
        $authError = 'Невірний логін або пароль';
    }
}

$isAdmin = ($_SESSION['is_admin'] ?? '') == 1;

if (!$isAdmin && $_SERVER['REQUEST_URI'] != '/admin/login.php') {
    redirect('/admin/login.php');
}

if ($isAdmin && $_SERVER['REQUEST_URI'] == '/admin/login.php') {
    redirect('/admin/');
}
