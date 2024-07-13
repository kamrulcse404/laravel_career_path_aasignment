<?php

session_start();


$data = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['feedback'])) {
        $data['feedback'] = $_POST['feedback'];
    }
    $data['userID'] = $_POST['user'];
}



if (!empty($data)) {
    $_SESSION['data'] = $data;
    header("Location: http://localhost:8000/app/models/FeedbackModel.php");
}