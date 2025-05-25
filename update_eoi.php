<?php
$host = "localhost";         // because XAMPP runs the server locally
$username = "root";          // default username for XAMPP's MySQL
$password = "";              // default password is empty in XAMPP
$database = "dummy_eois";  // replace with the actual name of your database

$dbconn = @mysqli_connect($host,$username,$password,$database);

if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>update_eoi.php</title>
    </head>
    <body>
        <?php 
            session_start();
            require_once("settings.php"); // from lab09

            $dbconn = mysqli_connect($host, $username, $password, $database);

            if (!$dbconn) {
                die("Database connection failed: ".mysqli_connect_error());
            }

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $eoi = $_POST['eoi'];
                echo "this is the eoi_num: ".$eoi."";
                $update = trim($_POST['status']);
                echo "\nthis is what is in update: '$update'";

                $query = "UPDATE eoi SET Status = '$update' WHERE EOI_ID = '$eoi'";
                $result = mysqli_query($dbconn,$query);
                header('Location:manage.php');
            }
            
        ?>
    </body>
</html>