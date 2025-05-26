<!-- Manager Login -->
 <?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once("settings.php");
        
    $query = sprintf("SELECT * FROM managers WHERE username = '%s'", $conn->real_escape_string($_POST["username"]));

    $result = $conn->query($query);

    $manager = $result->fetch_assoc();
        
    if ($manager) {
       if (password_verify($_POST["password"], $manager["password_hash"])) {
            session_start();
            $_SESSION["manager_id"] = $manager["id"];
            header("Location: manage.php");
            exit;
       }
    }
    $is_invalid = true;
}

 ?>

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

    <h1 id="login_heading">Login</h1>

    <?php if ($is_invalid): ?>
        <p>Invalid Login</p>
    <?php endif; ?>

    <form method="post">
        <div>
        <label for="username">username</label>
        <input type="text" name="username" id="manager_login_username"><br>
        </div>

        <div>
        <label for="password">password</label>
        <input type="password" name="password" id="manager_login_password"><br>
        </div>
        <br>
        <input type="submit" value="login">
        <a class="register" href="manager_registration.php"><button type = "button" >register an account</button></a>

    </form>

<?php include_once 'footer.inc'; ?>

</body>

</html>

<!-- 

session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $username, $password, $database);

// Get user input

$username = trim($_POST['username']);
$password = trim($_POST['password']);

// Simple query to check credentials
$query = "SELECT * FROM managers WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
  $_SESSION['username'] = $user['username'];
  header("Location: manage.php");
  exit();
} else {
  echo "Incorrect username or password.";
}
?>