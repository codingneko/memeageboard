<?php
    require_once('db/UserController.php');

    $userController = new UserController();
    $users = $userController->getUsers();
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
            <?php foreach ($users as $user): ?>
                <div class="users-container">
                    <a href="/user/<?= $user->getUsername(); ?>"><?= $user->getUsername(); ?></a>
                </div>
            <?php endforeach; ?>
        </div>
    </body>
</html>