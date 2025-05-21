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
            <input type="text" name="job_ref_num">
            <label>First name:</label>
            <input type="text" name="first_name">
            <label>Last name:</label>
            <input type="text" name="last_name">
            <input type="submit" value="Search">
        </form>
        <?php
        require_once "settings.php";
        require_once "process_eoi.php";
        $conn = @mysqli_connect ($host,$username,$password,$database);
        ?>
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
                    echo "<tr>";
                    echo "<td>" . $eoi_num . "</td>";
                    echo "<td>" . $job_ref_num . "</td>";
                    echo "<td>" . $first_name . "</td>";
                    echo "<td>$" . $last_name . "</td>";
                    echo "<td>" . $street . "<br>" . $suburb . ", " . $state . ", " . $postcode . "</td>";
                    echo "<td>" . $email . "</td>";
                    echo "<td>" . $phone_num . "</td>";
                    echo "<td>" . $skills . "</td>";
                    echo "<td>" . $other . "</td>";
                    echo "</tr>";
                    }
            }else{ 
                echo "<td colspan='5'> no EOIs found in the database.</td>";
            }
        mysqli_close($dbconn);
        }    
        ?>
        </table>
    </body>
</html>