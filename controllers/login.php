<?php
    require('models/SqlConnection.php');
    if (isset($_POST['username']) && isset($_POST['password'])){
        $SqlConnection = new SqlConnection('1234', 'root', 'memeageboard','127.0.0.1');
        print_r($SqlConnection);
        $SqlConnection->connect();

        print_r($SqlConnection);
    }