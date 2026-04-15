<?php

require "connect.php";
require "auth.php";

$errors = [];

$success = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $title = trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS));

        $imagePath = null;

        if ($title === '')
            {
                $errors[] = "Title is required";
            }

        if (empty($errors))
            {
                $sql = "INSERT INTO photos (title, image_path) VALUES (:title, :image_path)";

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':image_path', $imagePath);

                $stmt->execute();

                $success = "You've uploaded the image";
            }
    }