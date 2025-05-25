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
<!-- NOTE: delete above for final submission and uncomment 'require settings.php' below -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Search Expressions of Interest">
        <meta name="keywords" content="IT, EOI, Expression of Interest, job applications">
        <meta name="author" content="Sasha Panisset">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search EOIs</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>

    <body>
        <?php require_once "header.inc";
        session_start();
        $_SESSION['username'] = "John";
        ?>
        <main>
                 
            <h1>EOI Manager</h1>

            <!--search boxes begin here-->
            <form method="POST" action="manage_search_results.php">
                <label for="job_ref">Job position:</label>
                <input type="text" id="job_ref" name="Job_Reference_Number">
                <label for="fname">First name:</label>
                <input type="text" id="fname" name="First_Name">
                <label for="lname">Last name:</label>
                <input type="text" id="lname" name="Last_Name">
                <input type="submit" value="Search">
            </form> <!-- search boxes end -->
            <hr> 
            
            <!-- begin delete and update form (has to be up here to include the select inputs in the table)-->
            <form method="POST" action="update_eoi.php">

            <!-- begin EOI display table -->
            <table> 
                <caption>Pending Expressions of Interest:</caption>
                <tr>
                    <th>EOI</th>
                    <th>Job Ref</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Contact details</th>
                    <th>Skills List</th>
                    <th>Other Skills</th>
                    <th>D.O.B</th>
                    <th>Gender</th>
                    <th>Status</th>
                </tr>

                <!-- begin table body + EOI displays -->
                <?php
                    require_once "settings.php";
                    $conn = @mysqli_connect ($host,$username,$password,$database);
                    if (!$conn) {
                        echo "<p>Unable to connect to the db.</p>";
                    }
                    
                    // begin table body + EOI displays:
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
                            $email = htmlspecialchars($row['Email_Address']);
                            $phone_num = htmlspecialchars($row['Phone_Number']);
                            $skills_id = htmlspecialchars($row['Skills_ID']);  // link the skills table to here somehow..
                            $other_skills = htmlspecialchars($row['Other_Skills']);
                            $dob = htmlspecialchars($row['Date_Of_Birth']);
                            $gender = htmlspecialchars($row['Gender']);
                            $status = htmlspecialchars($row['Status']);
                                // htmlspecialchars used here to ensure the values in the databasee can be displayed properly

                            // one EOI table row start
                            echo "\n\n\t\t\t\t <!-- new table row -->";
                            echo "\n\t\t\t\t<tr>";
                            echo "\n\t\t\t\t\t<td>".$eoi_num."</td>";
                            echo "\n\t\t\t\t\t<td>".$job_ref_num."</td>";
                            echo "\n\t\t\t\t\t<td>".$first_name." ".$last_name."</td>";
                            echo "\n\t\t\t\t\t<td>".$street."<br>".$suburb.", ".$state.", ".$postcode."</td>";
                            echo "\n\t\t\t\t\t<td>Email: ".$email."<br>Phone: ".$phone_num."</td>";
                            
                            // START skills table cell. 
                            // currently using skills table, must switch to skills key from eoi table.
                            // may want to use an array for the skills?
                            echo "\n\n\t\t\t\t\t<!-- skills list -->";
                            echo "\n\t\t\t\t\t<td><p>";  
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
                            echo "</p></td>";
                            // END skills list cell.

                            // continue EOI table row
                            echo "\n\t\t\t\t\t<td>" . $other_skills . "</td>";
                            echo "\n\t\t\t\t\t<td>" . $dob . "</td>";
                            echo "\n\t\t\t\t\t<td>" . $gender . "</td>";

                            echo "\n\n\t\t\t\t\t<!-- select status -->";
                            echo "\n\t\t\t\t\t<td>";    // select status to update
                                echo "\n\t\t\t\t\t\t<label for='".$eoi_num."_status'> </label> <select id='".$eoi_num."_status' name='status'>";
                                    echo "\n\t\t\t\t\t\t\t<option selected value='".$status."'>".$status."</option>";
                                    echo "\n\t\t\t\t\t\t\t<option value='new'>New</option>";
                                    echo "\n\t\t\t\t\t\t\t<option value='current'>Current</option>";
                                    echo "\n\t\t\t\t\t\t\t<option value='final'>Final</option>";
                                echo "\n\t\t\t\t\t\t</select>";
                            echo "\n\t\t\t\t\t</td>"; 
                            echo "\n\t\t\t\t</tr>\n";
                            // END EOI table row
                            }
                        }else{ 
                            echo "\n\t\t\t\t\t<td colspan='5'> no EOIs found in the database.</td>\n\t\t\t";
                        }
                    mysqli_close($dbconn);
                ?>

            </table> <!-- end EOI display table -->
            
            <!-- continue change database form -->
                <span id="delete_section"> <!-- update + delete records form continues -->
                    <label for="delete">Delete EOIs with reference number:</label>
                    <input type="text" id="delete" name="delete_eois">
                    <input type="submit" value="Delete EOIs">
                </span>
                <span id="update">
                    <input type="submit" value="Update">
                </span> 
            </form> <!-- end update + delete records form -->

        </main>
        <?php require_once "footer.inc"; ?>

    </body>
</html>