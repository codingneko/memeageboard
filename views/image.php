<?php
    require_once('db/ImageController.php');
    $imageController = new ImageController();

    $image = $imageController->getImageById($id);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Imageboard</title>
        <link rel="stylesheet" href="/styles/main.css">
        <link rel="stylesheet" href="/styles/image-layout.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    </head>
    <body>
        <?php include('components/navbar.php'); ?>
        <div class="container">
            <div class="single-image">
                <div class="side-pannel">
                    <div class="author-display">
                        <p>
                            Image uploaded by:
                        </p>
                        <p>
                            <a href="/user/<?= $image->getOwner()->getUsername(); ?>"><?= $image->getOwner()->getUsername(); ?></a>
                        </p>
                    </div>
                    <div class="tag-display">
                        <p>
                            Tagged as:
                        </p>
                        <p>
                            <ul class="tag-list">
                                <?php foreach($image->getTags() as $tag): ?>
                                    <li>
                                        <a href="/tag/<?= $tag->getTagName(); ?>"><?= $tag->getTagName(); ?></a>
                                        
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </p>
                    </div>
                    <div class="actions-container">
                        <i class="fa-solid fa-link"></i><a href="<?= $image->getFileName(); ?>">View full size image</a>
                    </div>
                </div>
                <div class="large-image-container">
                    <img src="<?= $image->getFileName(); ?>" alt="">
                </div>
            </div>
        </div>
    </body>
</html>