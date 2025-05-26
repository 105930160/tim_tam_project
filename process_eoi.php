<?php 
session_start();

if (isset($_POST['job_reference_number'])) 
{
    if (isset($_SESSION['errors']))  unset($_SESSION['errors']);
    if (isset($_SESSION['past_submit']))  unset($_SESSION['past_submit']);

    require_once("settings.php");
    if ($dbconn) 
    {
                                    /*-------------------------SQL Creation/ Verification-------------------------------*/
        
                                    //create the eoi table if it does not exist
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
        `Email_Address` VARCHAR(50) NOT NULL,
        `Phone_Number` VARCHAR(20) NOT NULL,
        `Other_Skills` TEXT,
        `Date_Of_Birth` DATE,
        `Gender` VARCHAR(10),
        FOREIGN KEY (`Skills_ID`) REFERENCES `eoi_skills`(`skills_id`));";
        mysqli_query($dbconn,$create_table_query);

        /*block of code dedicated to creating a skills list that responds to creation and deletion of new jobs and skills. */

        //gets and stores every id from the 'jobs_postings' table 
        $query = "SELECT id  FROM `job_postings`";
        $result = mysqli_query($dbconn, $query);
        $jobs_array = [];
        for ($i = 0; $i < $result->num_rows; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $jobs_array[] = $row; 
        }
        //gets and stores the existence of every job, categorized by job_id
        $query = "SELECT job_id FROM skills";
        $result = mysqli_query($dbconn,$query);
        $skills = [];
        for ($i = 0; $i < $result->num_rows; $i++)
        {
            $row = mysqli_fetch_assoc($result);
            $skills[$row['job_id']][] = 1;
        }
        //creates the string to be inserted into the MYSQL query that contains every job
        $skills_sorted=[];
        $input = "";
        for ($i=0; $i<count($skills);$i++)
        {
            for ($j = 1; $j <= count($skills[$jobs_array[$i]['id']]); $j++)
            {
                $skills_sorted[]= "j".$jobs_array[$i]['id']."s".$j."";
                //j1s1 means job 1 skill 1
                $input = $input . ",  `j".$jobs_array[$i]['id']."s".$j."` BOOLEAN DEFAULT 0";
            }
        }
        //checks if eoi_skills exists and then duplicates it 
        if (mysqli_num_rows(mysqli_query($dbconn, "SHOW TABLES LIKE 'eoi_skills'"))) 
        {
            mysqli_query($dbconn, "SET foreign_key_checks = 0");
            mysqli_query($dbconn, "DROP TABLE IF EXISTS eoi_skills_backup");
            mysqli_query($dbconn, "RENAME TABLE eoi_skills TO eoi_skills_backup");
            mysqli_query($dbconn, "SET foreign_key_checks = 1");
        }
        //creates a new version of eoi_skills
        $create_table_query = "CREATE TABLE `eoi_skills` (
            `skills_id` INT AUTO_INCREMENT PRIMARY KEY
            ".$input.");";
        mysqli_query($dbconn, $create_table_query);


        //checks if eoi_skills_backup exists and then assigns all old values to the new table
        if (mysqli_num_rows(mysqli_query($dbconn, "SHOW TABLES LIKE 'eoi_skills_backup'"))) 
        {
            function get_column_names($dbconn, $table_name) {
                $columns = [];
                $result = mysqli_query($dbconn, "SHOW COLUMNS FROM `$table_name`");
                while ($row = mysqli_fetch_assoc($result)) {
                    $columns[] = $row['Field'];
                }
                return $columns;
            }

            $new_cols = get_column_names($dbconn, 'eoi_skills');
            $old_cols = get_column_names($dbconn, 'eoi_skills_backup');

            $common_cols = array_intersect($new_cols, $old_cols);

            if (count($common_cols) > 1) {
                $columns_str = implode(", ", $common_cols);
                $copy_query = "
                    INSERT INTO eoi_skills ($columns_str)
                    SELECT $columns_str FROM eoi_skills_backup;
                ";
                !mysqli_query($dbconn, $copy_query);
            }
        }

        /*------------------------------------------------- data input/ Validation ---------------------------------------*/

        //inputs, making sure that no malicious stuff is hidden inside
        $job_reference_number = mysqli_real_escape_string($dbconn, trim($_POST['job_reference_number']));
        $first_name = mysqli_real_escape_string($dbconn, trim($_POST['first_name']));
        $last_name = mysqli_real_escape_string($dbconn, trim($_POST['last_name']));
        $street_address = mysqli_real_escape_string($dbconn, trim($_POST['street_address']));
        $subtown_address = mysqli_real_escape_string($dbconn, trim($_POST['subtown_address']));
        $state = mysqli_real_escape_string($dbconn, trim($_POST['state']));
        $postcode = mysqli_real_escape_string($dbconn, trim($_POST['postcode']));
        $email = mysqli_real_escape_string($dbconn, trim($_POST['applicant_email']));
        $phone = mysqli_real_escape_string($dbconn, trim($_POST['applicant_phone']));
        $other_skills = mysqli_real_escape_string($dbconn, trim($_POST['other_skills']));
        $other_check = mysqli_real_escape_string($dbconn,trim($_POST['other_checked']??""));
        $dob = mysqli_real_escape_string($dbconn, trim($_POST['birth_date']));
        $gender = mysqli_real_escape_string($dbconn, trim($_POST['gender'])); 
        $skills = $_POST["skills"]??"";
        $errors = [];

        //validaton
        //uses regex
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
        //birthdate cannot be after today or before 110 years ago (maybe someone could be that old)
        if (( (substr($dob,0,4) > date("Y")) || ((substr($dob,0,4) == date("Y") && substr($dob,5,2)> date("m")) || ((substr($dob,0,4) == date("Y") && substr($dob,5,2) == date("m")&&substr($dob,8,2) > date("d"))))) || (!$dob) || (substr($dob,0,4) < date("Y")-110))
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
        
        //if other is ticked in the skills list then the other skills text box cannot be empty  
        if ($other_check && !$other_skills)
        {
            $errors['other'] = "You have checked 'other'. please indicate what other applicable skills you may have.";
        }
        //if any errors are found then exit back to apply.php to fix
        if ($errors)
        {
            $_SESSION['errors']=$errors;
            $_SESSION['past_submit']=$_POST;
            header("Location: apply.php");
            exit;
        }

        /*--------------------------------------------SQL INSERT---------------------------------------------------*/
        $insert_to_query_values = "";
        $insert_to_query_columns = "";
        for ($i=0; $i < count($skills_sorted);$i++)
        {
            if ($i == count($skills_sorted)-1 )
            {
                $insert_to_query_values = $insert_to_query_values . "'".mysqli_real_escape_string($dbconn, $skills[$skills_sorted[$i]]??"")."'";
                $insert_to_query_columns = $insert_to_query_columns . $skills_sorted[$i] ;
            }
            else 
            {
               // echo $skills_sorted[$i];
                //echo $skills[$skills_sorted[$i]];
               //echo $skills["j1s2"];
                $insert_to_query_values = $insert_to_query_values . "'".mysqli_real_escape_string($dbconn, $skills[$skills_sorted[$i]]??"")."',";
                $insert_to_query_columns = $insert_to_query_columns . $skills_sorted[$i] .", ";
            }
        }

        $query = "INSERT INTO eoi_skills 
            (".$insert_to_query_columns.") 
            VALUES (
                ".$insert_to_query_values."
            )";


        mysqli_query($dbconn, $query);

        $result = mysqli_query($dbconn, "SELECT skills_id FROM eoi_skills ORDER BY skills_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $skills_id = $row['skills_id'];

        $query = "INSERT INTO eoi 
            (Skills_ID, Status, Job_Reference_Number, First_Name, Last_Name, Street_Address, `Suburb/Town`, `State` , Postcode, Email_Address, Phone_Number, Other_Skills, Date_Of_Birth, Gender) 
            VALUES (
                '$skills_id', 'New', '$job_reference_number', '$first_name', '$last_name', '$street_address', 
                '$subtown_address','$state' ,'$postcode', '$email', '$phone', '$other_skills', '$dob', '$gender')";
        mysqli_query($dbconn, $query);

        $result = mysqli_query($dbconn, "SELECT EOI_ID FROM eoi ORDER BY skills_id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($result);
        $eoi_id = $row['EOI_ID'];
        $_SESSION['message'] = "Application submitted successfully.";
        $_SESSION['eoi_id'] = $eoi_id;
        header("Location: apply.php");
        exit();
    }
} 
else 
{
    header("Location: apply.php");
    exit();
}
?>
