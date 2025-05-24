<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="job application form">
        <meta name="keywords" content="Form, HTML, Job application,"> <!--add company name here-->
        <meta name="author" content="Sasha Panisset">
        <meta name="viewport" content="width=device-width, install-scale=1.0">

        <title>Job Application - Generic IT Company ltd.</title>
        <link rel="stylesheet" href="styles/styles.css">
    </head>

    <body>    
        <?php 
            session_start();
            require_once("settings.php");
            if (isset($_SESSION['errors']))
            {
                $errors = $_SESSION['errors'];
                unset($_SESSION['errors']);
            }
            if (isset($_SESSION['past_submit']))
            {
                $past_submit = $_SESSION['past_submit'];
                unset($_SESSION['past_submit']);
            }
        ?>
        <?php include 'header.inc'; ?>
        <!--Main for all the... Main stuff (:O)-->
        <main>

            <!--SP [1/4 3:00pm]: form begins-->
            <form action="process_eoi.php" method="post" novalidate>
                <section class="form_main">
                    <h1 id="form_title">Application Form</h1>       
                    <!--SP [1/4 3:00pm]: applicant's personal details begin:-->
                        <section class="form_section" id="personal_details">
                        <h2>Your Details:</h2>
                            <div class="row">
                                <div class="col-25"><label for="first_name">First Name:</label></div>
                                    <div class="col-75"><input type="text" id="first_name" name="first_name" size="15" maxlength="20" pattern="^[a-zA-Z]+$" required="required" placeholder="-----" title="please enter your first name." value = "<?= htmlspecialchars($past_submit['first_name'] ?? '')?>"></div>
                                    <?= $errors['f_name'] ?? ""?>
                                </div><br>
                            
                            <div class="row">
                                <div class="col-25"><label for="last_name">Last Name:</label></div>
                                    <div class="col-75"><input type="text" id="last_name" name="last_name" size="15" maxlength="20" pattern="^[a-zA-Z]+$" required="required" placeholder="-----" title="please enter your last name." value = "<?= htmlspecialchars($past_submit['last_name'] ?? '')?>"></div> 
                                    <?= $errors['l_name'] ?? ""?>                                
                                </div><br> 

                            <div class="row">
                                <div class="col-25"><label for="birth_date">Date of birth:</label></div>
                                        <div class="col-75"><input type="date" id="birth_date" name="birth_date" required="required" title="select your date of birth." value = "<?= htmlspecialchars($past_submit['birth_date'] ?? '')?>"></div>
                                        <?= $errors['birth_date'] ?? ""?>
                                    </div>
                            <br>

                            <div class="row">
                                <div class="col-25"><span class="list_label">Gender:</span></div>
                                <fieldset id="gender_field">  <!--SP [1/4 3:11pm]: Gender feildset begins-->
                                    <legend><span class="col-25">Gender:</span></legend>
                                        <div class="col-75" id="gender_list">
                                            <label for="man"><input type="radio" id="man" name="gender" value="male" checked="checked">Male</label>
                                            <label for="woman"><input type="radio" id="woman" name="gender" value="female" <?= ($past_submit['gender'] ?? '') == 'female' ? 'checked' : '' ?> >Female</label>
                                            <label for="non_binary"><input type="radio" id="non_binary" name="gender" value="non_binary" <?= ($past_submit['gender'] ?? '') == 'non_binary' ? 'checked' : '' ?>>Non-Binary</label>
                                            <label for="g_other"><input type="radio" id="g_other" name="gender" value="other" <?= ($past_submit['gender'] ?? '') == 'other' ? 'checked' : '' ?>>Other<span class="checkmark"></span></label>
                                            <label for="g_no"><input type="radio" id="g_no" name="gender" value="prefer not to say" <?= ($past_submit['gender'] ?? '') == 'prefer not to say' ? 'checked' : '' ?>>Prefer not to say</label>
                                        </div>
                                </fieldset>  <!--SP [1/4 3:11pm]: Gender feildset ends-->
                            </div>
                        </section>  <!--end div personal_details-->  

                        <section class="form_section" id="address"> <!--SP [1/4 3:15pm]: begin address section-->
                        <h2>Address:</h2>
                            <div class="row">
                                <div class="col-25"><label for="street_address">Street Address:</label></div>
                                    <div class="col-75"><input type="text" id="street_address" name="street_address" maxlength="40" pattern="^[a-zA-Z0-9 ]+$" required="required" placeholder="00 Road St" value = "<?= htmlspecialchars($past_submit['street_address'] ?? '')?>"></div>
                                    <?= $errors['street_address'] ?? ""?>
                                </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-25"><label for="suburb_address">Suburb:</label></div>
                                    <div class="col-75"><input type="text" id="suburb_address" name="subtown_address"maxlength="40" pattern="^[a-zA-Z]+$" required="required" placeholder="e.g. Richmond" title="suburb" value = "<?= htmlspecialchars($past_submit['subtown_address'] ?? '')?>"></div>
                                    <?= $errors['subtown_address'] ?? ""?>
                                </div>
                            <br>

                            <div class="row">
                                <div class="col-25"><label for="state_address">State:</label></div>
                                    <div class="custom_select col-75">
                                    <select id="state_address" name="state" required>
                                        <option value="" selected>----------</option>
                                        <option value="VIC" <?= ($past_submit['state'] ?? '') == 'VIC' ? 'selected' : '' ?>>Victoria</option>
                                        <option value="NSW" <?= ($past_submit['state'] ?? '') == 'NSW' ? 'selected' : '' ?>>New South Wales</option>
                                        <option value="QLD" <?= ($past_submit['state'] ?? '') == 'QLD' ? 'selected' : '' ?>>Queensland</option>
                                        <option value="NT" <?= ($past_submit['state'] ?? '') == 'NT' ? 'selected' : '' ?>>Northern Territory</option>
                                        <option value="WA" <?= ($past_submit['state'] ?? '') == 'WA' ? 'selected' : '' ?>>West Australia</option>
                                        <option value="SA" <?= ($past_submit['state'] ?? '') == 'SA' ? 'selected' : '' ?>>South Australia</option>
                                        <option value="TAS" <?= ($past_submit['state'] ?? '') == 'TAS' ? 'selected' : '' ?>>Tasmania</option>
                                        <option value="ACT" <?= ($past_submit['state'] ?? '') == 'ACT' ? 'selected' : '' ?>>Aus. Capital Territory</option>
                                    </select>
                                    <?= $errors['state']??""?>
                                    </div> <!--custom select div -->
                            </div> <!--row div -->

                            <div class="row">
                                <div class="col-25"><label for="postcode">Postcode:</label></div>
                                    <div class="col-75"><input type="text" id="postcode" name="postcode" size="4" maxlength="4" minlength="4" pattern="^[0-9]{4}$" required="required" placeholder="0000" value = "<?= htmlspecialchars($past_submit['postcode'] ?? '')?>"></div>
                                    <?= $errors['postcode'] ?? ""?>
                                </div>  
                            
                        </section><!--SP [1/4 3:15pm]: end address div-->
                    
                        <section class="form_section" id="contact"> <!--SP [1/4 4:06pm]: begin contact detals div-->
                            <h2>How can we reach you?</h2>
                            <div class="row">
                                <div class="col-25"><label for="applicant_email">Email:</label></div>
                                    <div class="col-75"><input type="text" id="applicant_email" name="applicant_email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="name@example.com" title="email" required="required" value = "<?= htmlspecialchars($past_submit['applicant_email'] ?? '')?>"></div>
                                    <?= $errors['email'] ?? ""?>
                                </div>
                            <br>
                                
                            <div class="row">
                                <div class="col-25"><label for="applicant_phone">Phone:</label></div>
                                    <div class="col-75"><input type="tel" id="applicant_phone" name="applicant_phone" minlength="8" maxlength="12" pattern="^\d+" placeholder="+X (XXX) XXX XXXX" title="phone number" value = "<?= htmlspecialchars($past_submit['applicant_phone'] ?? '')?>"></div>
                                    <?= $errors['phone'] ?? ""?>
                                </div>
                        </section>  <!--end contact section-->
                    
                        <section class="form_section" id="skills">   <!--SP [1/4 3:51]: begin skills div. technical skills checkboxes-->
                        <h2>Relevant Skills:</h2>
                            <div class="row">
                                <div class="col-25"><label for="job_ref_num">Job Reference Number:</label></div>
                                    <div class="custom_select col-75">    
                                    <select id="job_ref_num" name="job_reference_number" required>
                                            <option value="" selected>---------- </option>
                                            <?php 
                                                $query = "SELECT id , title  FROM `job_postings`";
                                                $result = mysqli_query($conn, $query);
                                                $jobs_array = [];
                                                for ($i = 0; $i < $result->num_rows; $i++)
                                                {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $jobs_array[] = $row;
                                                    $selected = ($past_submit['job_reference_number'] ?? '') == $row['id'] ? 'selected' : '';
                                                    echo "<option value = '".$row['id']."' $selected >" .$row['id']. " - " .$row['title']."</option>";
                                                    
                                                }
                                            ?>                                  
                                        </select>
                                    <?= $errors['job_reference_number'] ?? ""?>
                                    </div> <!--custon select-->
                            </div>
                            <br>
                            
                            <div class="row">
                            <div class="col-25"><span class="list_label">Required skills:</span></div>
                            <fieldset> <!--begin required skills-->  
                                <legend><span>Required Skills:</span></legend>
                                    <ul id="skills_list"> <!--network admin skills-->
                                        <?php 
                                            $query = "SELECT job_id,`description` FROM skills";
                                            $result = mysqli_query($conn,$query);
                                            $skills = [];
                                            for ($i = 0; $i < $result->num_rows; $i++)
                                            {
                                                $row = mysqli_fetch_assoc($result);
                                                $skills[$row['job_id']][] = $row['description'];
                                            }
                                            for ($i = 0; $i < count($jobs_array); $i++)
                                            {
                                                echo "<li class='subtitle col-75'>----- For ".$jobs_array[$i]['title'].": -----</li>";
                                                for ($j = 0; $j < count($skills[$jobs_array[$i]['id']]); $j++)
                                                {
                                                    $checked = ($past_submit['skills']["j".$i."s".$j.""] ?? '') == 1 ? 'checked' : '';
                                                    echo "<li><div class='col-75'><label for='job".$i."_skill".$j."'><input type='checkbox' id='job".$i."_skill".$j."' name='skills[j".$i."s".$j."]' value='1' ".$checked.">"
                                                    .$skills[$jobs_array[$i]['id']][$j]."</label></div></li>";
                                                }
                                            }
                                        ?>

                                        <li class="subtitle col-75">--------------------------------</li>

                                        <li><div class="col-75"><label for="other"><input type="checkbox" id="other" name="other_checked" value="1" <?= ($past_submit['other_checked'] ?? '') == 1 ? 'checked' : '' ?> >
                                        Other Skills</label></div></li>
                                    </ul>
                            </fieldset>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-25"><label for="other_skills">Other applicable skills: <br></label></div>
                                    <div class="col-75"><textarea id="other_skills" name="other_skills" rows="4" cols="30" placeholder="enter other applicable skills you may have here."><?= htmlspecialchars($past_submit['other_skills'] ?? '')?></textarea></div>
                                    <?= $errors['other'] ?? ""?>
                                </div>
                        </section>  <!--SP [6/4 5:21]: end skills section-->              
                        <div class="form_bottom">   
                            <input class="button" type="reset" Value="Reset" title="reset form">
                            <input class="button" type="submit" value="Apply" title="submit form">
                        </div> <!--end form bottom-->       
            </section>         
                    <?php 
                        echo $_SESSION['message']??"";
                        unset($_SESSION['message']);
                        echo $_SESSION['eoi_id']??"";
                        unset($_SESSION['eoi_id']);
                    ?>
            </form>
        </main>
        <br>
        <?php include 'footer.inc'; ?>
    </body>
</html>