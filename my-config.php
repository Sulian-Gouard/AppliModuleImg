<?php
require_once 'my-config.php';

$usersArray = [
    'admin' => 'navet',
    'guest' => 'carotte'
];

$error = array();

if (!empty($_POST['login']) && (!empty($_POST['password']))) {
    if ($usersArray[$_POST['login']] == $_POST['password']) {
        header("Location: dashboard.php");
    } else {
        $error['login'] = 'champs invalides';
    }
}
var_dump($_POST['login']);

?>