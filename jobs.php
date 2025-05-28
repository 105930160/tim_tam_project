<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Position Descriptions</title>
    <meta charset="UTF-8">
    <meta name="description" content="Job description page">
    <meta name="keywords" content="HTML, Job description,"> 
    <meta name="author" content="Angel Parra">
    <meta name="viewport" content="width=device-width, install-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    <?php include 'header.inc'; ?>
    <h1 id="JobPostingTitle">Jobs Available</h1>

    <!-- Each posting layout

    <section class="jobPosting">
        <div>
            <h2>Jobname (REF: {number})</h2>
            <p>A short descript of the job</p>
            <p><strong>Salary Range:</strong>{salary range}</p>
            <p><strong>Reports To:</strong>{reports to}</p>
        </div>
        <aside>
            <h3>Key Responsibilities</h3>
            <ol>
                <li>responsibility 1</li>
                <li>ect</li>
            </ol>
        </aside>
        <aside>
            <h3>Required Qualifications, Skills, and Attributes</h3>
            <h4>Essential</h4>
            <ul>
                <li>ect</li>
                <li>ect</li>
                
            </ul>
            <h4>Preferable</h4>
            <ul>
                <li>ect</li>
                <li>ect</li>
            </ul>
        </aside>
    </section> -->

    <?php
require_once("settings.php");
if ($conn) {
    $query = "SELECT * FROM job_postings";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) { // getting every job posting in the db
            echo "<section class='jobPosting'>";
            echo "<div class='contentHolder'>";
            echo "<div>";
            echo "<h2>" . $row['title'] . "<br>(REF: " . str_pad($row['id'], 5, '0', STR_PAD_LEFT) . ")</h2>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<p><strong>Salary Range:</strong> $" . $row['salary_lower'] . " - $" . $row['salary_upper'] . " per year</p>";
            echo "<p><strong>Reports To:</strong> " . $row['reports_to'] . "</p>";
            echo "</div>";
            echo "<aside>";
                echo "<h3>Key Responsibilities</h3>";
                $query2 = "SELECT responsibilities.description FROM job_postings INNER JOIN responsibilities ON job_postings.id = responsibilities.job_id WHERE job_postings.id = " . $row['id'];
                $result2 = mysqli_query($conn, $query2);
                echo "<ol>";
                    while ($row2 = mysqli_fetch_assoc($result2)) {
                        echo "<li>" . $row2['description'] . "</li>";
                    }
                echo "</ol>";
            echo "</aside>";
            echo "<aside>";
                echo "<h3>Required Qualifications, Skills, and Attributes</h3>";
                $query2 = "SELECT skills.description FROM job_postings
                INNER JOIN skills ON job_postings.id = skills.job_id
                WHERE job_postings.id = " . $row['id'] . " AND skills.essential = TRUE"; // this finds skills decription from job id
                $result2 = mysqli_query($conn, $query2);
                echo "<h4>Essential</h4>";
                echo "<ul>";
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        echo "<li>" . $row2['description'] . "</li>";
                    }
                    
            echo "</ul>";
            echo "<h4>Preferable</h4>";
            echo "<ul>";
                $query3 = "SELECT skills.description FROM job_postings
                INNER JOIN skills ON job_postings.id = skills.job_id
                WHERE job_postings.id = " . $row['id'] . " AND skills.essential = FALSE"; // same again unessential ones
                $result3 = mysqli_query($conn, $query3);
                while ($row3 = mysqli_fetch_assoc($result3)){
                    echo "<li>" . $row3['description'] . "</li>";
                }
            echo "</ul>";
        echo "</aside>";
        echo '</div>';
        echo "<p class='dateAdded'>Date added: " . $row['date_added'];
    echo "</section>";

        }
    } else {
        echo "<p>There are no jobs to display.</p>";
    }
    mysqli_close($conn);
} else {
    echo "<p>Unable to connect</p>";
}
?>
    
    <?php include 'footer.inc'; ?>
</body>
</html>

