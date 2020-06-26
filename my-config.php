<?php

$usersArray = [
    'admin' => 'navet',
    'guest' => 'carotte'
];

$error = array();

if (!empty($_POST['login']) && (!empty($_POST['password']))) {
    if (!array_key_exists($_POST['login'], $usersArray)) {
        $error['login'] = 'login ou password invalide';
    }
    elseif ($usersArray[$_POST['login']] == $_POST['password']) {
        header("Location: dashboard.php");
    } else {
        $error['login'] = 'login ou password invalide';
    }
}
