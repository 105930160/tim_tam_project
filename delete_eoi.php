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
    // gets the job reference number, deletrs the records with that job ref num
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $jrn = $_POST['delete_eois'];

        $query = "DELETE FROM eoi WHERE Job_Reference_Number = '$jrn'";
        $result = mysqli_query($conn, $query);
        header('Location:manage.php');
    }
                
?>
