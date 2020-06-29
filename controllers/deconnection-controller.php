<?php

if (isset($_POST['deconnection'])) {
    session_destroy();
}
