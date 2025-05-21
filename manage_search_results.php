<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Search EOIs - Results</title>
    </head>
    <body>
        <h1>EOI Manager</h1>
        <?php
        require_once "settings.php";
        require_once "process_eoi.php";
        $conn = @mysqli_connect ($host,$username,$password,$database);
        if (!$conn) {
            echo "<p>Unable to connect to the db.</p>";
        }
        ?>
        <!--search boxes begin here-->
        <form method="GET" action="manage_search_results.php">
            <label>Job position:</label>
            <input type="text" name="job_ref_num">
            <label>First name:</label>
            <input type="text" name="first_name">
            <label>Last name:</label>
            <input type="text" name="last_name">
            <input type="submit" value="Search">
        </form>

        <table> <caption>Pending Expressions of Interest:</caption>
            <tr>
                <th>EOI Num</th>
                <th>Job Ref Num</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skills</th>
                <th>Other Skills</th>
                <th>Status</th>
            </tr>
        <?php

        if (isset($_GET['job_ref_num'], $_GET['first_name'], $_GET['last_name'])) {
            $job_ref_num = mysqli_real_escape_string($conn, $_GET['job_ref_num']);
            $first_name = mysqli_real_escape_string($conn, $_GET['first_name']);
            $last_name = mysqli_real_escape_string($conn, $_GET['last_name']);
        
            $query = "SELECT * FROM eoi WHERE job_ref_num LIKE '$job_ref_num' OR first_name LIKE '$first_name' OR last_name LIKE '$last_name'";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)){
                    $eoi_num = ($row['eoi_num']);
                    $job_ref_num = ($row['job_ref_num']);
                    $first_name = htmlspecialchars($row['first_name']);
                    $last_name = htmlspecialchars($row['last_name']);
                    $street = htmlspecialchars($row['street']);
                    $suburb = htmlspecialchars($row['suburb']);
                    $state = htmlspecialchars($row['state']);
                    $postcode = htmlspecialchars($row['postcode']);
                    $email = htmlspecialchars($row['email']);
                    $phone_num = htmlspecialchars($row['phone_num']);
                    $skills = htmlspecialchars($row['skills']);
                    $other = htmlspecialchars($row['other']);
                    $status = htmlspecialchars($row['status']);

                    echo "<tr>";
                    echo "<td>" . $eoi_num . "</td>";
                    echo "<td>" . $job_ref_num . "</td>";
                    echo "<td>" . $first_name . "</td>";
                    echo "<td>" . $last_name . "</td>";
                    echo "<td>" . $street . "<br>" . $suburb . ", " . $state . ", " . $postcode . "</td>";
                    echo "<td>" . $email . "</td>";
                    echo "<td>" . $phone_num . "</td>";
                    echo "<td>" . $skills . "</td>";
                    echo "<td>" . $other . "</td>";
                    echo "<td>" . $status . "</td>";
                    echo "</tr>";
                    }
            }else{ 
                echo "<td colspan='5'>No EOIs found with matching fields.</td>";
            }
        }
        mysqli_close($dbconn);    
        ?>
        </table>
    </body>
</html>