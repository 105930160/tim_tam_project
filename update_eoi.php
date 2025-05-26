<?php
require_once("settings.php"); 
$conn = mysqli_connect($host, $username, $password, $database);

session_start();
if (!isset($_SESSION['manager_id'])) {
    header('Location: manager_login.php');
}

if (!$conn) {
    die("Database connection failed: ".mysqli_connect_error());
}

    // gets the eoi number and the status to update the corresponding reccord to
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $eoi = $_POST['eoi'];
        $update = trim($_POST['status']);

        $query = "UPDATE eoi SET Status = '$update' WHERE EOI_ID = '$eoi'";
        $result = mysqli_query($conn, $query);
        header('Location:manage.php');
    }
            
?>
