<?php

require "connect.php";

$errord = [];
$success = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

        $password = $_POST['password'] ?? '';
        $confirmPasswords = $_POST['confirm_password'] ?? '';
    }