<?php 
    require('models/SqlConnection.php');

    if (isset($_POST['tags']) && isset($_FILES['file'])) {
        $SqlConnection = new SqlConnection('127.0.0.1', 'root', '', 'memeageboard');
        $SqlConnection->connect();

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $target_dir = "uploads/content/";
            $uploadOk = true;
            $imageFileType = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            $imageName = md5_file($_FILES['file']['tmp_name']) . '.' . explode('.', $_FILES['file']['name'])[1];

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

                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                echo "Your file is: " . $imageFileType;
                $uploadOk = false;
            }

            if ($uploadOk) {
                $uploadedFile = $target_dir . $imageName;
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $uploadedFile)) {
                    $sqlConnection = new SqlConnection('localhost', 'root', '', 'memeageboard');
                    $sqlConnection->connect();
                    $sqlConnection->uploadFile($uploadedFile, $_POST['tags']);
                    header("Location: /");
                } else {
                    echo 'File upload failed, go back and try again.';
                }
            }
        } else {
            echo "Possible file upload attack: FUCK YOU CUNT!";
            echo "filename '". $_FILES['file']['tmp_name'] . "'.";
            $uploadOk = false;
        }
    }