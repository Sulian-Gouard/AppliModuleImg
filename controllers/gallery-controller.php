<?php
require_once 'my-config.php';

if ($_SESSION['login'] != 'admin') {
    header('location: not-allowed.php');
    exit;
}

$directory = 'img/';
$adminDirectory = scandir($directory, 1);


