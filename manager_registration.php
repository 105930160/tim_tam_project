<!-- Manager registration -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Manager Registration">
    <meta name="keywords" content="HTML5, PHP, Registration">
    <meta name="author" content="Ethan">
    <title>Manager Registration</title>
    <link href="./styles/global.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/styles.css">
</head>

<body>

<?php include_once 'header.inc'; ?>

    <h1 id="registration_heading">Registration</h1>

    <form method="post" action="process_registration.php">
        <div>
        <label for="username">username</label>
        <input type="text" name="username" id="manager_registration_username"><br>
        </div>

        <div>
        <label for="password">password</label>
        <input type="password" name="password" id="manager_registration_password"><br>
        </div>

        <div>
        <label for="password_confirmation">Repeat password</label>
        <input type="password" name="password_confirmation" id="manager_registration_password_confirmatiion"><br>
        </div>
        <br>
        <input type="submit" value="register">

    </form>

<?php include_once 'footer.inc'; ?>

</body>

</html>