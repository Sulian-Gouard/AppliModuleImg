<?php
require_once 'my-config.php';

$directory = 'img/';
$adminDirectory = scandir($directory);

if ($_SESSION['login'] != 'admin') {
    header('location: not-allowed.php');
    exit;
}
