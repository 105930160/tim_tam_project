<?php
$host = "localhost";         // because XAMPP runs the server locally
$username = "root";          // default username for XAMPP's MySQL
$password = "";              // default password is empty in XAMPP
$database = "timtam_db";  // replace with the actual name of your database

$conn = mysqli_connect($host,$username,$password,$database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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
