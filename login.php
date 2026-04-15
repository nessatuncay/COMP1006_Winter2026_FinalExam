<?php

session_start();

require "connect.php";

$error = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $usernameOrEmail = trim($_POST['username_or_email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($usernameOrEmail === '' || $password === '')
            {
                $error = "Username and email are required";
            }
        else
            {
                $sql = "SELECT id, username, email, password FROM users WHERE username = :login OR email = :login LIMIT 1";

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':login', $usernameOrEmail);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($password, $user['password']))
                    {
                        session_regenerate_id(true);

                        $_SESSION['username'] = $user['username'];
                        $_SESSION['user_id'] = $user['id'];
                        
                        header("Location: orders.php");
                        exit;
                    }
                else 
                    {
                        $error = "Wrong username and email";
                    }
            }
    }



?>