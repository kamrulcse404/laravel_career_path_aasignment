<?php

session_start();

$errors = [];
$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty(trim($_POST['name']))) {
        $errors['name'] = 'Name field empty';
    } else {
        $name = strip_tags($_POST['name']);
        $name = htmlspecialchars($name);
        $name = preg_replace('/\s+/', ' ', $name);
        $name = trim($name);
        $data['name'] = $name;
    }

    if (empty($_POST['email'])) {
        $errors['email'] = 'Email field empty';
    } else {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $data['email'] = $email;
    }

    if (empty(trim($_POST['password']))) {
        $errors['password'] = 'Password field empty';
    } elseif (strlen($_POST['password']) < 6) {
        $errors['password'] = 'Password field must have at least 6 characters';
    } else {
        $data['password'] = $_POST['password'];
    }

    if (empty(trim($_POST['confirm_password']))) {
        $errors['confirm_password'] = 'Password confirm field empty';
    } elseif ($_POST['confirm_password'] !== $data['password']) {
        $errors['confirm_password'] = 'Password mismatch';
    }

    if (empty($errors['password']) && empty($errors['confirm_password'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: http://localhost:8000/views/register.php");
}else {
    $_SESSION['data'] = $data;
    header("Location: http://localhost:8000/app/models/RegisterModel.php");
}



