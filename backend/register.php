<?php 
    require_once('db/UserController.php');
    header('Content-Type: application/json; charset=utf-8');

    if ((isset($_POST['username']) && isset($_POST['password']) && ($_POST['username'] != '' && $_POST['password'] != ''))) {
        $userController = new UserController();
        if ($userController->createUser($_POST['username'], $_POST['password'])) {
            echo json_encode(Array(
                'status' => 200,
                'message' => 'New user added.'
            ));

            http_response_code(200);
        } else {
            echo json_encode(Array(
                'status' => 400,
                'message' => 'Could not add user to the database, do you already have an account?'
            ));

            http_response_code(400);
        }

        
        exit;
    } else {
        echo json_encode(Array(
            'status' => 400,
            'message' => 'All fields are required'
        ));

        http_response_code(400);
        exit;
    }