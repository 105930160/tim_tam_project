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
        ?>
        <header>
            <!--nav is seperated into top and bottom in order to more easily deal with everything-->
            <div id="navtop">
                <!--likewise, navtop is seperated into two seperate divs-->
                <div id="navtopmiddle">
                    <a href="index.html"><img id="logo" src="Images/GenericITCompanyLogo.png" alt="Generic IT Company Logo"></a>
                </div>
                <aside>
                    <a href="mailto:info@genericitcompany.com.au" id="contactus"><p>Contact Us!</p></a>
                </aside>
           </div>
            <nav>
                <a id="homebutton" href="index.html"><p>Home</p></a>
                <a id="applybutton" href="apply.html"><p>Apply</p></a>
                <a href="about.html"><p>About</p></a>
                <a href="jobs.html"><p>Jobs</p></a>
            </nav>
        </header>

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
                                    <div class="col-75"><input type="text" id="first_name" name="first_name" size="15" maxlength="40" pattern="^[a-zA-Z]+$" required="required" placeholder="-----" title="please enter your first name." value = "<?= htmlspecialchars($_SESSION['past_submit']['first_name'] ?? '')?>"></div>
                            </div><br>
                            
                            <div class="row">
                                <div class="col-25"><label for="last_name">Last Name:</label></div>
                                    <div class="col-75"><input type="text" id="last_name" name="last_name" size="15" maxlength="40" pattern="^[a-zA-Z]+$" required="required" placeholder="-----" title="please enter your last name." value = "<?= htmlspecialchars($_SESSION['past_submit']['last_name'] ?? '')?>"></div> 
                            </div><br> 

                            <div class="row">
                                <div class="col-25"><label for="birth_date">Date of birth:</label></div>
                                        <div class="col-75"><input type="date" id="birth_date" name="birth_date" required="required" title="select your date of birth." value = "<?= htmlspecialchars($_SESSION['past_submit']['birth_date'] ?? '')?>"></div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-25"><span class="list_label">Gender:</span></div>
                                <fieldset id="gender_field">  <!--SP [1/4 3:11pm]: Gender feildset begins-->
                                    <legend><span class="col-25">Gender:</span></legend>
                                        <div class="col-75" id="gender_list">
                                            <label for="man"><input type="radio" id="man" name="gender" value="male" checked="checked">Male</label>
                                            <label for="woman"><input type="radio" id="woman" name="gender" value="female" <?= ($_SESSION['past_submit']['gender'] ?? '') == 'female' ? 'checked' : '' ?> >Female</label>
                                            <label for="non_binary"><input type="radio" id="non_binary" name="gender" value="non_binary" <?= ($_SESSION['past_submit']['gender'] ?? '') == 'non_binary' ? 'checked' : '' ?>>Non-Binary</label>
                                            <label for="g_other"><input type="radio" id="g_other" name="gender" value="other" <?= ($_SESSION['past_submit']['gender'] ?? '') == 'other' ? 'checked' : '' ?>>Other<span class="checkmark"></span></label>
                                            <label for="g_no"><input type="radio" id="g_no" name="gender" value="prefer not to say" <?= ($_SESSION['past_submit']['gender'] ?? '') == 'prefer not to say' ? 'checked' : '' ?>>Prefer not to say</label>
                                        </div>
                                </fieldset>  <!--SP [1/4 3:11pm]: Gender feildset ends-->
                            </div>
                        </section>  <!--end div personal_details-->  

                        <section class="form_section" id="address"> <!--SP [1/4 3:15pm]: begin address section-->
                        <h2>Address:</h2>
                            <div class="row">
                                <div class="col-25"><label for="street_address">Street Address:</label></div>
                                    <div class="col-75"><input type="text" id="street_address" name="street_address" maxlength="40" pattern="^[a-zA-Z0-9 ]+$" required="required" placeholder="00 Road St" value = "<?= htmlspecialchars($_SESSION['past_submit']['street_address'] ?? '')?>"></div>
                            </div>
                            <br>
                            
                            <div class="row">
                                <div class="col-25"><label for="suburb_address">Suburb:</label></div>
                                    <div class="col-75"><input type="text" id="suburb_address" name="subtown_address"maxlength="40" pattern="^[a-zA-Z]+$" required="required" placeholder="e.g. Richmond" title="suburb" value = "<?= htmlspecialchars($_SESSION['past_submit']['subtown_address'] ?? '')?>"></div>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-25"><label for="state_address">State:</label></div>
                                    <div class="custom_select col-75">
                                    <select id="state_address" name="state" required>
                                        <option value="" selected>----------</option>
                                        <option value="VIC" <?= ($_SESSION['past_submit']['state'] ?? '') == 'VIC' ? 'selected' : '' ?>>Victoria</option>
                                        <option value="NSW" <?= ($_SESSION['past_submit']['state'] ?? '') == 'NSW' ? 'selected' : '' ?>>New South Wales</option>
                                        <option value="QLD" <?= ($_SESSION['past_submit']['state'] ?? '') == 'QLD' ? 'selected' : '' ?>>Queensland</option>
                                        <option value="NT" <?= ($_SESSION['past_submit']['state'] ?? '') == 'NT' ? 'selected' : '' ?>>Northern Territory</option>
                                        <option value="WA" <?= ($_SESSION['past_submit']['state'] ?? '') == 'WA' ? 'selected' : '' ?>>West Australia</option>
                                        <option value="SA" <?= ($_SESSION['past_submit']['state'] ?? '') == 'SA' ? 'selected' : '' ?>>South Australia</option>
                                        <option value="TAS" <?= ($_SESSION['past_submit']['state'] ?? '') == 'TAS' ? 'selected' : '' ?>>Tasmania</option>
                                        <option value="ACT" <?= ($_SESSION['past_submit']['state'] ?? '') == 'ACT' ? 'selected' : '' ?>>Aus. Capital Territory</option>
                                    </select>
                                    </div> <!--custom select div -->
                            </div> <!--row div -->

                            <div class="row">
                                <div class="col-25"><label for="postcode">Postcode:</label></div>
                                    <div class="col-75"><input type="text" id="postcode" name="postcode" size="4" maxlength="4" minlength="4" pattern="^[0-9]{4}$" required="required" placeholder="0000" value = "<?= htmlspecialchars($_SESSION['past_submit']['postcode'] ?? '')?>"></div>
                            </div>  
                            
                        </section><!--SP [1/4 3:15pm]: end address div-->
                    
                        <section class="form_section" id="contact"> <!--SP [1/4 4:06pm]: begin contact detals div-->
                            <h2>How can we reach you?</h2>
                            <div class="row">
                                <div class="col-25"><label for="applicant_email">Email:</label></div>
                                    <div class="col-75"><input type="text" id="applicant_email" name="applicant_email" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="name@example.com" title="email" required="required" value = "<?= htmlspecialchars($_SESSION['past_submit']['applicant_email'] ?? '')?>"></div>
                            </div>
                            <br>
                                
                            <div class="row">
                                <div class="col-25"><label for="applicant_phone">Phone:</label></div>
                                    <div class="col-75"><input type="tel" id="applicant_phone" name="applicant_phone" minlength="8" maxlength="12" pattern="^\d+" placeholder="+X (XXX) XXX XXXX" title="phone number" value = "<?= htmlspecialchars($_SESSION['past_submit']['applicant_phone'] ?? '')?>"></div>
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
                                                $count = $result->num_rows;
                                                for ($i = 0; $i < $count; $i++)
                                                {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $selected = ($_SESSION['past_submit']['job_reference_number'] ?? '') == $row['id'] ? 'selected' : '';
                                                    $array = [$row['id'],$row['title']];
                                                    $GLOBALS['array'] = $array;
                                                    echo "<option value = '".$row['id']."' $selected >" .$row['id']. " - " .$row['title']."</option>";
                                                    
                                                }
                                            ?>                                  
                                        </select>
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
                                            for ($j = 0; $j < count($GLOBALS['array']); $j++)
                                            {
                                                echo "<li class='subtitle col-75'>----- For ".$GLOBALS['array'][$j][1].": -----</li>";
                                                for ($i = 0; $i < $result->num_rows; $i++)
                                                {
                                                    $row = mysqli_fetch_assoc($result);
                                                    if ($row["job_id"]==$GLOBALS['array'][$j][0])
                                                    {
                                                        echo "<li><div class='col-75'><label for='job".$j."_skill".$i."'><input type='checkbox' id='job".$j."_skill".$i."' name='skills[j".$j."s".$i."]' value='1'>
                                        ".$row['description']."</label></div></li>";
                                                    }
                                                }
                                            }
                                        
                                        
                                        
                                        ?>
                                        <li class="subtitle col-75">----- For Network Admin: -----</li>
                                        <li><div class="col-75"><label for="job1_skill1"><input type="checkbox" id="job1_skill1" name="skills[j1s1]" value="1" checked="checked">
                                        Bachelor's degree in Information Tech, Computer Science, or related field.</label></div></li>
                        
                                        <li><div class="col-75"><label for="job1_skill2"><input type="checkbox" id="job1_skill2" name="skills[j1s2]" value="1">
                                        3 years of experience in network administration.</label></div></li>
                        
                                        <li><div class="col-75"><label for="job1_skill3"><input type="checkbox" id="job1_skill3" name="skills[j1s3]" value="1">
                                        Proficiency in configuring routers and switches.</label></div></li>
                        
                                        <li><div class="col-75"><label for="job1_skill4"><input type="checkbox" id="job1_skill4" name="skills[j1s4]" value="1">
                                        Strong troubleshooting and problem-solving skills.</label></div></li>
                        
                                        <li><div class="col-75"><label for="job1_skill5"><input type="checkbox" id="job1_skill5" name="skills[j1s5]" value="1">
                                        Certifications such as CCNA.</label></div></li>
                        
                                        <li><div class="col-75"><label for="job1_skill6"><input type="checkbox" id="job1_skill6" name="skills[j1s6]" value="1">
                                        Experience with cloud networking</label></div></li>
                                        
                                        <li class="subtitle col-75">----- For Software Developer: -----</li> <!--software developer skills-->
                                        <li><div class="col-75"><label for="job2_skill1"><input type="checkbox" id="job2_skill1" name="skills[j2s1]" value="1">
                                        Bachelor's degree in Computer Science or related field</label></div></li>
                        
                                        <li><div class="col-75"><label for="job2_skill2"><input type="checkbox" id="job2_skill2" name="skills[j2s2]" value="1">
                                        3+ years of experience in software development</label></div></li>
                        
                                        <li><div class="col-75"><label for="job2_skill3"><input type="checkbox" id="job2_skill3" name="skills[j2s3]" value="1">
                                        Proficiency in Python, or C++</label></div></li>
                        
                                        <li><div class="col-75"><label for="job2_skill4"><input type="checkbox" id="job2_skill4" name="skills[j2s4]" value="1">
                                        Strong problem-solving skills.</label></div></li>
                        
                                        <li><div class="col-75"><label for="job2_skill5"><input type="checkbox" id="job2_skill5" name="skills[j2s5]" value="1">
                                        Experience with cloud technologies</label></div></li>
                        
                                        <li><div class="col-75"><label for="job2_skill6"><input type="checkbox" id="job2_skill6" name="skills[j2s6]" value="1">
                                        Familiarity with Agile frameworks</label></div></li>

                                        <li class="subtitle col-75">--------------------------------</li>

                                        <li><div class="col-75"><label for="other"><input type="checkbox" id="other" name="other_checked" value="1">
                                        Other Skills</label></div></li>
                                    </ul>
                            </fieldset>
                            </div>
                            <br>

                            <div class="row">
                                <div class="col-25"><label for="other_skills">Other applicable skills: <br></label></div>
                                    <div class="col-75"><textarea id="other_skills" name="other_skills" rows="4" cols="30" placeholder="enter other applicable skills you may have here."></textarea></div>
                            </div>
                        </section>  <!--SP [6/4 5:21]: end skills section-->              
                         <?php 
                            if (isset($_SESSION['errors']))
                            {
                                echo $_SESSION['errors']['postcode'];
                                echo $_SESSION['past_submit']['first_name'];
                            }
                            else{
                                echo "hi";
                            }
                        
                        ?>
                        <div class="form_bottom">   
                            <input class="button" type="reset" Value="Reset" title="reset form">
                            <input class="button" type="submit" value="Apply" title="submit form">
                        </div> <!--end form bottom-->       
            </section>         
            </form>
        </main>
        <br>
        <footer></footer>
    </body>
</html>