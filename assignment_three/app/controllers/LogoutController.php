<?php
session_start();


unset($_SESSION);

session_destroy();

header("Location: http://localhost:8000/views/login.php");