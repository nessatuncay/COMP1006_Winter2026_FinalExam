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
                $errors[] = "Password needs to be at least 12 characters";
            }



        if (empty($errors))
            {
                $sql = "SELECT id FROM users WHERE username = :username OR email = :email";

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);

                $stmt->execute();

                if ($stmt->fetch())
                    {
                        $errors[] = "The username and email is already used";
                    }
            }

        


        if (empty($errors))
            {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password) ";

                $stmt = $pdo->prepare($sql);


                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);

                $stmt->execute();

                $success = "Account has been created, you can log in now";
            }
    }

    ?>