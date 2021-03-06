<?php
    require_once('db/TagController.php');

    $tagController = new TagController();
    $tags = $tagController->getTags();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imageboard</title>
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <body>
        <?php include('components/navbar.php'); ?>
        <div class="container">
            <?php foreach ($tags as $tag): ?>
                <div class="users-container">
                    <a href="/tag/<?= $tag->getTagName(); ?>"><?= $tag->getTagName(); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>