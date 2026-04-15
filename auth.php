<?php

session_start();

if (empty($_SESSION["user_id"]))
    {
        header('Location: restricted.php');
        exit();
    }


?>