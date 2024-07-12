<?php

session_start();
$registerError = [];
$registerSuccess = [];
$data = [];

if (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];
}

$filename = realpath(__DIR__ . '/../../data/registration.json');
$decodeData = [];

if (file_exists($filename)) {

    $contents = file_get_contents($filename);
    $decodeData = json_decode($contents, true);

    if (!empty($decodeData)) {
        $lastItem = end($decodeData);
        $id = $lastItem['id'];

        $updateId = ['id' => $id + 1];
        $data = array_merge($updateId, $data);

        foreach ($decodeData as $value) {
            if ($value['email'] === $data['email']) {
                $registerError['reg_error'] = "This email already registered!";

                $_SESSION['registerError'] = $registerError;
                header("Location: http://localhost:8000/views/register.php");
                exit;
            }
        }

        $decodeData[] = $data;
        $encodeData = json_encode($decodeData, JSON_PRETTY_PRINT);
        file_put_contents($filename, $encodeData);

        $registerSuccess['success'] = "Registration successful !";
        $_SESSION['registerSuccess'] = $registerSuccess;

        header("Location: http://localhost:8000/views/login.php");
        exit;
    } else {
        $id = 1;
        $updateId = ['id' => $id];
        $data = array_merge($updateId, $data);

        $decodeData[] = $data;

        $encodeData = json_encode($decodeData, JSON_PRETTY_PRINT);
        file_put_contents($filename, $encodeData);

        $registerSuccess['success'] = "Registration successful !";
        $_SESSION['registerSuccess'] = $registerSuccess;

        header("Location: http://localhost:8000/views/login.php");
        exit;
    }
}
