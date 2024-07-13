<?php

session_start();
$user_id = null;
$feedbacks = [];

if (isset($_SESSION['userID'])) {
    $user_id = $_SESSION['userID'];
}


$filename = realpath(__DIR__ . '/../../data/dashboard.json');

if (file_exists($filename)) {
    $contents = file_get_contents($filename);
    $decodeData = json_decode($contents, true);

    

    foreach ($decodeData as $value) {

        if ($value['userID'] == $user_id) {
            $feedbacks[] = $value['feedback'];
        }
    }

    $_SESSION['feedbacks'] = $feedbacks;
    header("Location: http://localhost:8000/views/dashboard.php");
    exit;
}
