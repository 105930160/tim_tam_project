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
        <?php 
            include "header.inc";
            session_start();
            if (!isset($_SESSION['manager_id'])) {
                //header('Location: manager_login.php');
            }
        ?>
        <main>
                 
            <!-- div encompasses whole table so that everything stays together sytlistically -->
            <div class='table_section'> 
                <h1 id="form_title">EOI Manager</h1>    
                    <!--search boxes begin here-->
                    <form method="POST" action="manage_search_results.php" id="search_bars">
                        <label for="job_ref">Job position:</label>
                        <input type="text" id="job_ref" name="Job_Reference_Number"  class="short_text">
                        <label for="fname">First name:</label>
                        <input type="text" id="fname" name="First_Name" maxlength="30"  class="long_text">
                        <label for="lname">Last name:</label>
                        <input type="text" id="lname" name="Last_Name" maxlength="35"  class="long_text">
                        <input type="submit" value="Search" class="small_button">
                    </form> <!-- search boxes end -->
                    <hr>
                    
                    <!-- begin EOI display table -->
                    <table> 
                        <caption id="tablecap">Pending Expressions of Interest:</caption>
                        <tr>
                            <th>EOI</th>
                            <th>Job Ref</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact details</th>
                            <th>Skills List</th>
                            <th>Other Skills</th>
                            <th>D.O.B</th>
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
                                    echo "\n\t\t\t\t\t<td scope='column'><span class='invisible'>eoi</span><br>".$eoi_num."</td>";    // <span> element there to be a hidden label for screen readers
                                    echo "\n\t\t\t\t\t<td scope='column'><span class='invisible'>job</span><br>".$job_ref_num."</td>";
                                    echo "\n\t\t\t\t\t<td>".$first_name." ".$last_name."</td>";
                                    echo "\n\t\t\t\t\t<td>".$street."<br>".$suburb.", ".$state.", ".$postcode."</td>";
                                    echo "\n\t\t\t\t\t<td>Email: ".$email."<br>Phone: ".$phone_num."</td>";
                                    
                                    // START skills table cell. 
                                    echo "\n\n\t\t\t\t\t<!-- skills list -->";
                                    echo "\n\t\t\t\t\t<td>";  
                                        $skills_query = "SELECT * FROM eoi_skills WHERE skills_id ='$skills_id'";
                                        $skills_result = mysqli_query($conn, $skills_query);
                                        if ($skills_result && mysqli_num_rows($skills_result) > 0) {
                                            while ($row = mysqli_fetch_assoc($skills_result)){

                                                // made array of skill names to print, using the 1 or 0 in the eoi_skills table to tell whether to print or not
                                                echo "<p><span class='invisible'>skills:</span><br>";
                                                $skills_list = array("", "j1s1", "j1s2", "j1s3", "j1s4", "j1s5", "j1s6", "j2s1", "j2s2", "j2s3", "j2s4", "j2s5", "j2s6");
                                                $i = 0;
                                                foreach ($row as $skill){
                                                    if ($skill == 1 ){
                                                        echo "".$skills_list[$i]."<br>";
                                                    }
                                                    $i++;  
                                                }
                                            }
                                        } else {
                                            echo "<p>No skills found.";
                                        }
                                    echo "</p></td>";
                                    // END skills list cell.

                                    // continue EOI table row
                                    echo "\n\t\t\t\t\t<td style='white-space:wrap'><span class='invisible'>Other skills</span><br>" . $other_skills . "</td>";
                                    echo "\n\t\t\t\t\t<td>" . $dob . "</td>";

                                    // the select boxes and update buttons to update status for an eoi.
                                    echo "\n\t\t\t\t\t<td>";    
                                    echo "<form method='POST' action='update_eoi.php'>";
                                        echo "\n\t\t\t\t\t\t<input type='hidden' name='eoi' value='".$eoi_num."'>";
                                        echo "\n\t\t\t\t\t\t<label for='".$eoi_num."_status' class='invisible'>Status</label> <select id='".$eoi_num."_status' name='status'>";
                                            echo "\n\t\t\t\t\t\t\t<option selected value='".$status."'>".$status."</option>";
                                            echo "\n\t\t\t\t\t\t\t<option value='New'>New</option>";
                                            echo "\n\t\t\t\t\t\t\t<option value='Current'>Current</option>";
                                            echo "\n\t\t\t\t\t\t\t<option value='Final'>Final</option>";
                                            echo "\n\t\t\t\t\t\t\t</select><br>";
                                        echo "\n\t\t\t\t\t\t<input type='submit' value='Update' class='small_button'></form>";
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
                    
                    <!-- allowing records to be deleted by the job reference number -->
                    <form method="POST" action="delete_eoi.php">
                        <span id="delete_section"> <!-- update + delete records form continues -->
                            <label for="delete">Delete EOIs with reference number:</label>
                            <input type="text" id="delete" name="delete_eois" maxlength="10" class="short_text">
                            <input type="submit" value="Delete EOIs" class="small_button">
                        </span>
                    </form> 
                    <!-- end delete records form -->
            </div>

        </main>
        <?php include "footer.inc"; ?>

    </body>
</html>