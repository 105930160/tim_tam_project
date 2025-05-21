<?php 
session_start();

if (isset($_POST['job_reference_number'])) 
{
    require_once("settings.php");
    if ($conn) {
        $create_table_query = "CREATE TABLE IF NOT EXISTS `eoi` (
        `EOI_ID` INT AUTO_INCREMENT PRIMARY KEY,
        `Skills_ID` INT NOT NULL,
        `Status` VARCHAR(10) DEFAULT 'New',
        `Job_Reference_Number` VARCHAR(5) NOT NULL,
        `First_Name` VARCHAR(20) NOT NULL,
        `Last_Name` VARCHAR(20) NOT NULL,
        `Street_Address` VARCHAR(40) NOT NULL,
        `Suburb/Town` VARCHAR(40) NOT NULL,
        `Postcode` VARCHAR(4) NOT NULL,
        `Email_Address` VARCHAR() NOT NULL,
        `Phone_Number` VARCHAR(20) NOT NULL,
        `Other_Skills` TEXT,
        `Date_Of_Birth` DATE,
        `Gender` VARCHAR(10),
        FOREIGN KEY (`Skills_ID`) REFERENCES `eoi_skills`(`skills_id`));";
        mysqli_query($conn,$create_table_query);

        $create_table_query = "CREATE TABLE IF NOT EXISTS `eoi_skills` (
            `skills_id` INT AUTO_INCREMENT PRIMARY KEY,
            `j1s1` BOOLEAN DEFAULT 0,
            `j1s2` BOOLEAN DEFAULT 0,
            `j1s3` BOOLEAN DEFAULT 0,
            `j1s4` BOOLEAN DEFAULT 0,
            `j1s5` BOOLEAN DEFAULT 0,
            `j1s6` BOOLEAN DEFAULT 0,
            `j2s1` BOOLEAN DEFAULT 0,
            `j2s2` BOOLEAN DEFAULT 0,
            `j2s3` BOOLEAN DEFAULT 0,
            `j2s4` BOOLEAN DEFAULT 0,
            `j2s5` BOOLEAN DEFAULT 0,
            `j2s6` BOOLEAN DEFAULT 0);";
        mysqli_query($conn, $create_table_query);

        $job_reference_number = mysqli_real_escape_string($conn, trim($_POST['job_reference_number']));
        $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
        $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
        $street_address = mysqli_real_escape_string($conn, trim($_POST['street_address']));
        $subtown_address = mysqli_real_escape_string($conn, trim($_POST['subtown_address']));
        $state = mysqli_real_escape_string($conn, trim($_POST['state']));
        $postcode = mysqli_real_escape_string($conn, trim($_POST['postcode']));
        $email = mysqli_real_escape_string($conn, trim($_POST['applicant_email']));
        $phone = mysqli_real_escape_string($conn, trim($_POST['applicant_phone']));
        $other_skills = mysqli_real_escape_string($conn, trim($_POST['other_skills']));
        $dob = mysqli_real_escape_string($conn, trim($_POST['birth_date']));
        $gender = mysqli_real_escape_string($conn, trim($_POST['gender'])); 
        $skills = $_POST["skills"];

        //Put Validation Here

        //maxlengthof first/lastname/street address/suburb and town

        //postcode needs to match state

        //validate email format

        //phone number digit validation

        //if other is ticked in the skills list then the other skills text box cannot be empty  






        $query = "INSERT INTO eoi_skills 
            (j1s1, j1s2, j1s3, j1s4, j1s5, j1s6, j2s1, j2s2, j2s3, j2s4, j2s5, j2s6) 
            VALUES (
                '".mysqli_real_escape_string($conn, $skills["j1s1"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j1s2"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j1s3"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j1s4"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j1s5"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j1s6"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j2s1"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j2s2"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j2s3"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j2s4"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j2s5"] ?? "")."',
                '".mysqli_real_escape_string($conn, $skills["j2s6"] ?? "")."'
            )";
        mysqli_query($conn, $query);

        $result = mysqli_query($conn, "SELECT skills_id FROM eoi_skills ORDER BY skills_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $skills_id = $row['skills_id'];

        $query = "INSERT INTO eoi 
            (Skills_ID, Status, Job_Reference_Number, First_Name, Last_Name, Street_Address, `Suburb/Town`, `State` , Postcode, Email_Address, Phone_Number, Other_Skills, Date_Of_Birth, Gender) 
            VALUES (
                '$skills_id', 'New', '$job_reference_number', '$first_name', '$last_name', '$street_address', 
                '$subtown_address','$state' ,'$postcode', '$email', '$phone', '$other_skills', '$dob', '$gender')";
        mysqli_query($conn, $query);

        $result = mysqli_query($conn, "SELECT EOI_ID FROM eoi ORDER BY skills_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $eoi_id = $row['EOI_ID'];

        $_SESSION['message'] = "Application submitted successfully.";
        $_SESSION['eoi_id'] = $eoi_id
        header("Location: apply.php");
        exit();
    } 
    else 
    {
        echo "Database connection failed.";
    }
} 
else 
{
    header("Location: apply.php");
    exit();
}
?>
