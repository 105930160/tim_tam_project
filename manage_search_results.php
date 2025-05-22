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
        <meta charset="UTF-8">
        <title>Search EOIs - Results</title>
    </head>
    <body>
        <h1>EOI Manager</h1>
        <?php
        //require_once "settings.php";
        require_once "process_eoi.php";
        $conn = @mysqli_connect ($host,$username,$password,$database);
        if (!$conn) {
            echo "<p>Unable to connect to the db.</p>";
        }
        ?>
        <!--search boxes begin here-->
        <form method="GET" action="manage_search_results.php">
            <label>Job position:</label>
            <input type="text" name="Job_Reference_Number">
            <label>First name:</label>
            <input type="text" name="First_Name">
            <label>Last name:</label>
            <input type="text" name="Last_Name">
            <input type="submit" value="Search">
        </form>

        <form method="GET" action="manage_search_results.php">            
        <table> <caption>Pending Expressions of Interest:</caption>
            <tr>
                <th>EOI Num</th>
                <th>Job Ref Num</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skills (essential/preferred)</th>
                <th>Other Skills</th>
                <th>D.O.B</th>
                <th>Gender</th>
                <th>Status</th>
            </tr>
            <?php

            if (isset($_GET['Job_Reference_Number'], $_GET['First_Name'], $_GET['Last_Name'])) {
                $job_ref_num = mysqli_real_escape_string($conn, $_GET['Job_Reference_Number']);
                $first_name = mysqli_real_escape_string($conn, $_GET['First_Name']);
                $last_name = mysqli_real_escape_string($conn, $_GET['Last_Name']);
            
                $query = "SELECT * FROM eoi WHERE Job_Reference_Number LIKE '$job_ref_num' OR First_Name LIKE '$first_name' OR Last_Name LIKE '$last_name'";
                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        $eoi_num = ($row['EOI_ID']);
                        $job_ref_num = ($row['Job_Reference_Number']);
                        $first_name = htmlspecialchars($row['First_Name']);
                        $last_name = htmlspecialchars($row['Last_Name']);
                        $street = htmlspecialchars($row['Street_Address']);
                        $suburb = htmlspecialchars($row['Suburb/Town']);
                        $state = htmlspecialchars($row['State']);
                        $postcode = htmlspecialchars($row['Postcode']);
                        $email = htmlspecialchars($row['Email_Address']);
                        $phone_num = htmlspecialchars($row['Phone_Number']);
                        $skills = htmlspecialchars($row['Skills_ID']);  // link to skills table somehow
                        $other = htmlspecialchars($row['Other_Skills']);
                        $dob = htmlspecialchars($row['Date_Of_Birth']);
                        $gender = htmlspecialchars($row['Gender']);
                        $status = htmlspecialchars($row['Status']);

                        echo "<tr>";
                        echo "<td>" . $eoi_num . "</td>";
                        echo "<td>" . $job_ref_num . "</td>";
                        echo "<td>" . $first_name . "</td>";
                        echo "<td>" . $last_name . "</td>";
                        echo "<td>" . $street . "<br>" . $suburb . ", " . $state . ", " . $postcode . "</td>";
                        echo "<td>" . $email . "</td>";
                        echo "<td>" . $phone_num . "</td>";
                        echo "<td>";
                            echo "<p>";               
                        $skills_query = "SELECT id, essential FROM skills";
                        $skills_result = mysqli_query($conn, $skills_query);
                            if ($skills_result && mysqli_num_rows($skills_result) > 0) {
                                while ($row = mysqli_fetch_assoc($skills_result)){
                                    $desc = htmlspecialchars($row['id']);
                                    $essential = htmlspecialchars($row['essential']);
                                                // going to need some IFNULL() things going on for the skills that dont apply 
                                    
                                    echo "".$desc." (".$essential."), ";
                                    
                                }
                            } else {
                                echo "<p>No skills found.</p>";
                            }
                            echo "</p>";


                        echo "</td>";     // link to skills table somehow. 
                        echo "<td>" . $other . "</td>";
                        echo "<td>" . $dob . "</td>";
                        echo "<td>" . $gender . "</td>";
                        echo "<td>";
                        echo "<label for='status'> </label> <select id='status' name='status'>";
                        echo "<option value='".$status."' selected>".$status."</option>";
                        echo "<option value='New'>New</option>";
                        echo "<option value='Current'>Current</option>";
                        echo "<option value='Final'>Final</option>";
                        echo "</select>";
                        echo "</td>"; // make select input as part of form
                        echo "</tr>";
                        }
                        // add delete and update buttons. 'change database' form ends here
                }else{ 
                    echo "<td colspan='5'>No EOIs found with matching fields.</td>";
                }
            }
            mysqli_close($dbconn);    
            ?>
        </table>

        </form>
    </body>
</html>