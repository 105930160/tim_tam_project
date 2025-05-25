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
                $delete_ref = trim($_POST['delete_eois']);
                $update = trim($_POST['status']);
            }
            
        ?>
    </body>
</html>