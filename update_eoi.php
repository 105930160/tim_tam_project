<?php
$host = "localhost";         // because XAMPP runs the server locally
$username = "root";          // default username for XAMPP's MySQL
$password = "";              // default password is empty in XAMPP
$database = "dummy_eois";  // replace with the actual name of your database

$dbconn = @mysqli_connect($host,$username,$password,$database);

if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
require_once("settings.php"); // from lab09

$dbconn = mysqli_connect($host, $username, $password, $database);

if (!$dbconn) {
    die("Database connection failed: ".mysqli_connect_error());
}

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $eoi = $_POST['eoi'];
        $update = trim($_POST['status']);

        $query = "UPDATE eoi SET Status = '$update' WHERE EOI_ID = '$eoi'";
        $result = mysqli_query($dbconn,$query);
        header('Location:manage.php');
    }
            
?>
