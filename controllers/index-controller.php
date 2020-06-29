<?php

if($_SESSION['login'] !='admin' || $_SESSION['login'] !='guest') {
    header('location: not-allowed.php');
    exit;
 }