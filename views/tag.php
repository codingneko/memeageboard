<?php
    require_once('db/ImageController.php');
    require_once('db/TagController.php');
    
    $imageController = new ImageController();
    $tagController = new TagController();

    $tag = $tagController->getTagByTagName($tag_name);

    $images = $imageController->getImagesByTagId($tag->getId());
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imageboard</title>
        <link rel="stylesheet" href="/styles/main.css">
        <link rel="stylesheet" href="/styles/img-grid.css">
    </head>
    <body>
        <?php include('components/navbar.php'); ?>
        <div class="container">
            <div class="image-grid-container">
                <?php foreach ($images as $image): ?>
                    <div class="image-container">
                        <a href="/image/<?= $image->getId(); ?>"><img src="<?= $image->getFileName(); ?>" alt=""></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </body>
</html>