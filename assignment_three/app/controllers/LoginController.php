<?php

session_start();

$errors = [];
$data = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email field empty';
    } else {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $data['email'] = $email;
    }

    if (empty(trim($_POST['password']))) {
        $errors['password'] = 'Password field empty';
    } else {
        $data['password'] = $_POST['password'];
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: http://localhost:8000/views/login.php");
} else {
    $_SESSION['data'] = $data;
    header("Location: http://localhost:8000/app/models/LoginModel.php");
}
