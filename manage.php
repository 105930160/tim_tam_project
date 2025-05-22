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
        <meta name="description" content="Search Expressions of Interest">
        <meta name="keywords" content="IT, EOI, Expression of Interest, job applications">
        <meta name="author" content="Sasha Panisset">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search EOIs</title>
    </head>
    <body>
        <h1>EOI Manager</h1>
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
        <?php
        //require_once "settings.php";
        require_once "process_eoi.php";
        $conn = @mysqli_connect ($host,$username,$password,$database);
        ?>
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
                <th>Skills List</th>
                <th>Other Skills</th>
                <th>D.O.B</th>
                <th>Gender</th>
                <th>Status</th>
            </tr>
            <?php
            if (!$conn) {
                echo "<p>Unable to connect to the db.</p>";
            }
            else{
                $query = "SELECT * FROM eoi";
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
                        $email = htmlspecialchars($row['EmaiL_Address']);
                        $phone_num = htmlspecialchars($row['Phone_Number']);
                        $skills_id = htmlspecialchars($row['Skills_ID']);  // link the skills table to here somehow..
                        $other_skills = htmlspecialchars($row['Other_Skills']);
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
                                echo "<li>No skills found.</li>";
                            }
                            echo "</p>";
                        echo "</td>";        // link to the skills table somehow
                        echo "<td>" . $other_skills . "</td>";
                        echo "<td>" . $dob . "</td>";
                        echo "<td>" . $gender . "</td>";
                        echo "<td>";
                        echo "<label for='status'>.</label> <select id='status' name='status'>";
                        echo "<option selected value='".$status."'>".$status."</option>";
                        echo "<option value='new'>New</option>";
                        echo "<option value='current'>Current</option>";
                        echo "<option value='final'>Final</option>";
                        echo "</select>";
                        echo "</td>"; // make select input as part of form
                        echo "</tr>";
                        // add delete and update buttons. 'change database' form ending here
                        }
                }else{ 
                    echo "<td colspan='5'> no EOIs found in the database.</td>";
                }
            mysqli_close($dbconn);
            }    
            ?>
        </table>
        </form>
    </body>
</html>