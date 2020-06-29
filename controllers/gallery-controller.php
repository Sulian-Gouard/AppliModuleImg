<?php
    $directory = 'img/';
    $adminDirectory = scandir($directory);

    foreach ($adminDirectory as $key => $value) {
        $result = $value;
    }