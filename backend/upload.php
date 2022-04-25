<?php 
    require_once('db/ImageController.php');
    header('Content-Type: application/json; charset=utf-8');

    if (isset($_POST['tags']) && isset($_FILES['file'])) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $target_dir = "uploads/content/";
            $uploadOk = true;
            $imageFileType = strtolower(
                                pathinfo($_FILES['file']['name'], 
                                PATHINFO_EXTENSION));

            $imageName = 
                        md5_file($_FILES['file']['tmp_name']) 
                        . '.' 
                        . explode('.', $_FILES['file']['name'])[1];

            $tags = explode(',', $_POST['tags']);

            if(
                $imageFileType != "jpg" &&
                $imageFileType != "png" &&
                $imageFileType != "jpeg" &&
                $imageFileType != "mp4" &&
                $imageFileType != "gif" &&
                $imageFileType != "webm" &&
                $imageFileType != "mp3" &&
                $imageFileType != "mpeg" &&
                $imageFileType != "flv") {

                echo json_encode(Array(
                    'status' => 415,
                    'message' => 'Sorry, only JPG, JPEG, PNG & GIF files
                                  are allowed. ' 
                                  . "Your file is: " 
                                  . $imageFileType
                ));

                http_response_code(415);
                exit;
            }

            if (!isset($_POST['tags']) || $_POST['tags'] == '') {
                echo json_encode(Array(
                    'status' => 400,
                    'message' => 'You did not specify any tags. 
                                  Tags are required.'
                ));

                http_response_code(400);
                exit;
            };

            if ($uploadOk) {
                $uploadedFile = $target_dir . $imageName;
                $imageController = new ImageController();
                $file_save_result = move_uploaded_file($_FILES["file"]["tmp_name"], $uploadedFile);

                if ($file_save_result) {
                    $db_insert_result = $imageController->createImage($uploadedFile, $_POST['tags']);

                    if ($db_insert_result === 23000) {

                        echo json_encode(Array(
                            'status' => 403,
                            'message' => 'This image already exists.'
                        ));
            
                        http_response_code(403);
                        exit;

                    } else if ($db_insert_result) {
                        echo json_encode(Array(
                            'status' => 200,
                            'message' => 'File uploaded successfuly'
                        ));
                    } else {
                        echo json_encode(Array(
                            'status' => 500,
                            'message' => "There was a server side error. We got SQLSTATE $db_insert_result"
                        ));

                        http_response_code(500);
                        exit;
                    }
                }
            }
        } else {
            echo json_encode(Array(
                'status' => 403,
                'message' => 'The file provided was not a valid 
                              image. What are you trying to do?'
            ));

            http_response_code(403);
            exit;
        }
    }