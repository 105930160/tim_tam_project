<?php 
session_start();

if (isset($_POST['job_reference_number'])) 
{
    require_once("settings.php");
    if ($conn) 
    {
        // $create_table_query = "CREATE TABLE IF NOT EXISTS `eoi` (
        // `EOI_ID` INT AUTO_INCREMENT PRIMARY KEY,
        // `Skills_ID` INT NOT NULL,
        // `Status` VARCHAR(10) DEFAULT 'New',
        // `Job_Reference_Number` VARCHAR(5) NOT NULL,
        // `First_Name` VARCHAR(20) NOT NULL,
        // `Last_Name` VARCHAR(20) NOT NULL,
        // `Street_Address` VARCHAR(40) NOT NULL,
        // `Suburb/Town` VARCHAR(40) NOT NULL,
        // `Postcode` VARCHAR(4) NOT NULL,
        // `Email_Address` VARCHAR() NOT NULL,
        // `Phone_Number` VARCHAR(20) NOT NULL,
        // `Other_Skills` TEXT,
        // `Date_Of_Birth` DATE,
        // `Gender` VARCHAR(10),
        // FOREIGN KEY (`Skills_ID`) REFERENCES `eoi_skills`(`skills_id`));";
        // mysqli_query($conn,$create_table_query);
        // // needs to copy and update table to be equal to the number of currently available jobs
        // $create_table_query = "CREATE TABLE IF NOT EXISTS `eoi_skills` (
        //     `skills_id` INT AUTO_INCREMENT PRIMARY KEY,
        //     `j1s1` BOOLEAN DEFAULT 0,
        //     `j1s2` BOOLEAN DEFAULT 0,
        //     `j1s3` BOOLEAN DEFAULT 0,
        //     `j1s4` BOOLEAN DEFAULT 0,
        //     `j1s5` BOOLEAN DEFAULT 0,
        //     `j1s6` BOOLEAN DEFAULT 0,
        //     `j2s1` BOOLEAN DEFAULT 0,
        //     `j2s2` BOOLEAN DEFAULT 0,
        //     `j2s3` BOOLEAN DEFAULT 0,
        //     `j2s4` BOOLEAN DEFAULT 0,
        //     `j2s5` BOOLEAN DEFAULT 0,
        //     `j2s6` BOOLEAN DEFAULT 0);";
        // mysqli_query($conn, $create_table_query);

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
        $other_check = mysqli_real_escape_string($conn,trim($_POST['other_checked']))??"";
        $dob = mysqli_real_escape_string($conn, trim($_POST['birth_date']));
        $gender = mysqli_real_escape_string($conn, trim($_POST['gender'])); 
        $skills = $_POST["skills"]??"";
        $errors = [];
        //Put Validation Here

        if (!preg_match('/^[a-zA-Z]+$/',$first_name))
        {
            $errors['f_name'] = "Invalid first name";
        }
        if (!preg_match('/^[a-zA-Z]+$/',$last_name))
        {
            $errors['l_name'] = "Invalid last name";
        }
        if (!preg_match('/^[a-zA-Z0-9 ]+$/',$street_address))
        {
            $errors['street_address'] = "Invalid street address";
        }
        if (!preg_match('/^[a-zA-Z]+$/',$subtown_address))
        {
            $errors['subtown_address'] = "Invalid suburb/town address";
        }
        if (!preg_match('/^\+?[0-9\s\-().]{8,12}$/',$phone)||strlen($phone)<8)
        {
            $errors['phone'] = "Please enter a valid phone number.";
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "Please enter a valid email.";
        }
        if (( (substr($dob,0,4) > date("Y")) || ((substr($dob,0,4) == date("Y") && substr($dob,5,2)> date("m")) || ((substr($dob,0,4) == date("Y") && substr($dob,5,2) == date("m")&&substr($dob,8,2) > date("d"))))) || !$dob)
        {
            $errors['birth_date'] = "invalid birth date";
        }
        if(!$job_reference_number)
            {
                $errors['job_reference_number'] = "Please select a job_reference number";            
            }
        if (!preg_match('/^[0-9]+$/',$postcode))
        {
            $errors['postcode'] = "invalid postcode";

            if(!$state)
            {
                $errors['state'] = "Please select a state or territory";            
            }
            else
            {
                switch ($state)
                {
                    case "NSW":
                        if ((($postcode < 1000)||($postcode>2599))&&(($postcode>=2600)||($postcode<=2618))&&($postcode < 2619 || $postcode > 2899)&&($postcode<2921 || $postcode > 2999))
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for NSW";
                        }
                        break;
                    case "VIC":
                        if ((($postcode >= 3000)&&($postcode<=3996)) || (($postcode >= 8000)&&($postcode<=8999))){}
                        else
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for VIC";
                        }
                        break;
                    case "NT":
                        if (($postcode < 800)||($postcode>999))
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for NT";

                        }
                        break;
                    case "SA":
                        if (($postcode < 5000)||($postcode>5999))
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for SA";

                        }
                        break;
                    case "WA":
                        if (($postcode < 6000)||($postcode>6999))
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for WA";

                        }
                        break;
                    case "TAS":
                        if (($postcode < 7000)||($postcode>7999))
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for TAS";

                        }
                        break;
                    case "QLD":
                        if (($postcode <4000 && postcode > 4999) && ($postcode <9000 && $postcode >9999))
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for QLD";

                        }
                        break;
                    case "ACT":
                        if (($postcode <200 && $postcode >299) &&  ($postcode <2600 && $postcode > 2618) && ($postcode <2900 && $postcode > 2921))
                        {
                            $errors['postcode'] = "Postcode is incorrect, $postcode is not a valid postcode for ACT";
                        }
                        break;
                }
            }
        }
        
        //validate email format


        //phone number digit validation

        //if other is ticked in the skills list then the other skills text box cannot be empty  
        if ($other_check && !$other_skills)
        {
            $errors['other'] = "You have checked 'other'. please indicate what other applicable skills you may have.";
        }
        if ($errors)
        {
            $_SESSION['errors']=$errors;
            $_SESSION['past_submit']=$_POST;
            header("Location: apply.php");
            exit;
        }




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
        $_SESSION['eoi_id'] = $eoi_id;
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
