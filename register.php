<?php

require "connect.php";

$errors = [];
$success = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));

        $password = $_POST['password'] ?? '';
        $confirmPasswords = $_POST['confirm_password'] ?? '';

    

        if ($username === '')
            {
                $errors[] = "Username is required";
            }

        if ($email === '')
            {
                $errors[] = "Email is required";
            }

        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors[] = "Email must be valid";
            }

        if ($password === '')
            {
                $errors = "Password is required";
            }

        if ($confirmPassword === '')
            {
                $errors[] = "Confirm your password";
            }

        if ($password !== $confirmPassword)
            {
                $errors[] = "Paswword doesn't match";
            }

        if (strlen($password) < 12)
            {
                
            }
    }