<?php

session_start();
$loginError = [];
$loginSuccess = [];
$data = [];
$userID = null;
$userName = null;

if (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];
}

$filename = realpath(__DIR__ . '/../../data/registration.json');

if (file_exists($filename)) {

    $contents = file_get_contents($filename);
    $decodeData = json_decode($contents, true);
    $userFound = false;

    if (!empty($decodeData)) {
        foreach ($decodeData as $value) {
            if ($value['email'] === $data['email']) {
                $userFound = true;
                if (password_verify($data['password'], $value['password'])) {
                    
                    $loginSuccess['auth'] = true;
                    $_SESSION['loginSuccess'] = $loginSuccess;
                    $userID = $value['id'];
                    $_SESSION['userID'] = $userID;

                    $userName = $value['name'];
                    $_SESSION['userName'] = $userName;

                    header("Location: http://localhost:8000/app/models/DashboardModel.php");
                    exit;
                } else {
                    $loginError['login_error'] = "your email or password wrong !";
                    $_SESSION['loginError'] = $loginError;
                    header("Location: http://localhost:8000/views/login.php");
                    exit;
                }
            }
        }

        if (!$userFound) {
            $loginError['email_not_found'] = "Email not found! your email is not registered !";
            $_SESSION['loginError'] = $loginError;
            header("Location: http://localhost:8000/views/login.php");
            exit;
        }
    } else {
        $loginError['not_reg'] = "you are not registered !";
        $_SESSION['loginError'] = $loginError;
        header("Location: http://localhost:8000/views/login.php");
        exit;
    }
}
