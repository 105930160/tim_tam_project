<?php

if (empty($_POST["username"])) {
    die("Username is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}


require_once("settings.php");

$conn = mysqli_connect($host, $username, $password, $database);

//$username = trim($_POST['username']);
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$query = "INSERT INTO managers (username, password_hash) VALUES (?, ?)";

$stmt = $conn->stmt_init();

if ( ! $stmt->prepare($query)) {
    die("SQL error: " . $conn->error);
}

$stmt->bind_param("ss", $_POST["username"], $password_hash);

if ($stmt->execute()) {
    //echo "Registration successful. Login from <a href='manager_login.php'>login</a>.";
    echo "Registration Successful. You will be redirected to login page shortly";
    header("Refresh: 5; manager_login.php");
    exit;
} else {
    die($conn->error . " " . $conn->errno);
}



//$result = mysqli_query($conn, $query);

//if ($result) {
//  echo "Registration successful. Login from <a href='manager_login.php'>login</a>.";
//} else {
//  echo "Registration failed. Please try again.";
//}
?>