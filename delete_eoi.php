
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
require_once("settings.php"); 

$dbconn = mysqli_connect($host, $username, $password, $database);

if (!$dbconn) {
    die("Database connection failed: ".mysqli_connect_error());
}
    // gets the job reference number, deletrs the records with that job ref num
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $jrn = $_POST['delete_eois'];

        $query = "DELETE FROM eoi WHERE Job_Reference_Number = '$jrn'";
        $result = mysqli_query($dbconn,$query);
        header('Location:manage.php');
    }
                
?>
