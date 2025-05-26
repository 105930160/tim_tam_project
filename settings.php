<?php
$host = "localhost";
$username = "root";          // default username for XAMPP's MySQL
$password = "";              // default password is empty in XAMPP
$database = "dummy_eois";  // replace with the actual name of your database

$conn = @mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>