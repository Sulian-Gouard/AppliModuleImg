<?php
session_start();

$usersArray = [
    'admin' => 'navet',
    'guest' => 'carotte'
];

$error = array();

if (!empty($_POST['login']) && (!empty($_POST['password']))) {
    if (!array_key_exists($_POST['login'], $usersArray)) {
        $error['login'] = 'login ou password invalide';
    } elseif ($usersArray[$_POST['login']] == $_POST['password']) {
        if ($_POST['login'] == 'admin') {
            $_SESSION['login'] = 'admin';
            header("Location: dashboard.php");
        }
        if ($_POST['login'] == 'guest') {
            $_SESSION['login'] = 'guest';
            header("Location: gallery.php");
        }
    } else {
        $error['login'] = 'login ou password invalide';
    }
}

