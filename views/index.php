<?php
require_once('models/SqlConnection.php');

$db = new SqlConnection('127.0.0.1', 'root', '', 'memeageboard');
$db->connect();
$images = $db->fetchFiles();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CodingNeok Imageboard</title>
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>
        <?php include('components/navbar.php'); ?>
        <div class="container">
            <div class="image-grid-container">
                <?php foreach ($images as $image): ?>
                    <div class="image-container">
                        <img src="<?= $image['file_name'] ?>" alt="">
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>