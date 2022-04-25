<?php
    require_once('db/UserController.php');
    header('Content-Type: application/json; charset=utf-8');

    if (isset($_POST['username']) && isset($_POST['password'])){
        $userController = new UserController();
        $userController->login($_POST['username'], $_POST['password']);
    }