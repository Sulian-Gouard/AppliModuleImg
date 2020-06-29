<?php
require_once 'my-config.php';

if ($_SESSION['login'] != 'admin' && $_SESSION['login'] != 'guest') {
    header('location: not-allowed.php');
    exit;
}

$directory = 'img/';
$adminDirectory = scandir($directory, 1);


