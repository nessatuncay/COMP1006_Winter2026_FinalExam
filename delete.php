<?php

require "auth.php";
require "connect.php";


if (!isset($_GET['id']))
    {
        die("No id");
    }


$imageId = $_GET['id'];

$sql = "DELETE FROM photos WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $imageId);
$stmt->execute();

exit;


?>