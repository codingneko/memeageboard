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
            <h1>Upload a file</h1>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-field-container">
                    <label for="username">Tags:</label>
                    <input type="text" name="tags" id="tags" placeholder="shrek, crab_rave, jake_paul" class="form-field">
                </div>
                <div class="form-field-container">
                    <label for="password">File:</label>
                    <input type="file" name="file" id="file" class="form-field">
                </div>
                <div class="form-submit-container">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </body>
</html>