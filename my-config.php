<?php
session_start();

$usersArray = [
    'admin' => '$2y$10$JEvpz/gcswfywKeDMckJ9uxPf6WMByVuR1MwCgGGkI3gGSs.bYSIW',
    'guest' => '$2y$10$juuwP8ZxSAO6jM6AgK5G/emxgj7z/qJxLvVoW.ozT/q2SD6VrrS6y'
];

$error = array();

if (!empty($_POST['login']) && (!empty($_POST['password']))) {
    if (!array_key_exists($_POST['login'], $usersArray)) {
        $error['login'] = 'identifiant ou mot de passe';
    } elseif (password_verify($_POST['password'],$usersArray[$_POST['login']])) {
        if ($_POST['login'] == 'admin') {
            $_SESSION['login'] = 'admin';
            header("Location: dashboard.php");
        }
        if ($_POST['login'] == 'guest') {
            $_SESSION['login'] = 'guest';
            header("Location: gallery.php");
        }
    } else {
        $error['login'] = 'identifiant ou mot de passe';
    }
}

if (isset($_POST['submit'])) {
    if (empty($_POST['login']) || (empty($_POST['password']))) {
        $error['login'] = 'veuillez renseigner les champs';
    }
}
