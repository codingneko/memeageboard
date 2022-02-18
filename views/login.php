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
            <h1>Log in</h1>
            <form action="" method="POST">
                <div class="form-field-container">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-field">
                </div>
                <div class="form-field-container">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-field">
                </div>
                <div class="form-submit-container">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </body>
</html>