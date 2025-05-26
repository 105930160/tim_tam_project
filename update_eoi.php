<?php
$host = "localhost";         // because XAMPP runs the server locally
$username = "root";          // default username for XAMPP's MySQL
$password = "";              // default password is empty in XAMPP
$database = "timtam_db";  // replace with the actual name of your database

$dbconn = @mysqli_connect($host,$username,$password,$database);

if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();
if (!isset($_SESSION['manager_id'])) {
    header('Location: manager_login.php');
}

require_once("settings.php"); 
$dbconn = mysqli_connect($host, $username, $password, $database);

if (!$dbconn) {
    die("Database connection failed: ".mysqli_connect_error());
}

    // gets the eoi number and the status to update the corresponding reccord to
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $eoi = $_POST['eoi'];
        $update = trim($_POST['status']);

        $query = "UPDATE eoi SET Status = '$update' WHERE EOI_ID = '$eoi'";
        $result = mysqli_query($dbconn,$query);
        header('Location:manage.php');
    }
            
?>
