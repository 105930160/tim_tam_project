<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PHP Manager Registration">
    <meta name="keywords" content="HTML5, PHP, Registration">
    <meta name="author" content="Ethan">
    <title>Manager Registration</title>
    <link href="./styles/global.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/styles.css">
</head>

<body>

<?php include_once 'header.inc'; ?>

<h1 id="enhancements_heading">Enhancements</h1>
<br>
<div class="enhance">
<h3>ENHANCEMENT 1:</h3>
<h4>Create a manager registration page with server side validation requiring unique username and a password rule, and store this information in a table.</h4>

<p>
<h4>To design this enhancement feature I created 2 files:</h4>
- manager_registration.php<br>
- process_registration.php<br>
</p>
<p>
<h5>What I did in manager_registration.php:</h5>
- A HTML form with username, password and pasword confirmation fields. Re-using styling from the apply.php page, for design consistency<br>
- Used 'id' for each field to add styling, which was placed in the linked styles.css<br>
- Used php include to have the consistent header/nav and footer that the whole website uses.<br>
</p>
<p>
<h5>What I did in process_registration.php:<h5>
- Added various validations for the input form/registration fields:<br>
    - Making a username required<br>
    - Requiring 8 character password length<br>
    - Requiring the password to contain 1 letter and 1 number<br>
    - Checking both passwords typed in, match<br>
- Added a 'require' for settings.php to enable connection to the database<br>
- Used password hashing so that the password is saved securely<br>
- Used the INSERT INTO function to add the registration data to the database, with security based additions:<br>
    -Used placeholder values in the sql query - and then 'stmt bind param' later to add the proper values, so that sql injection is prevented<br>
    -Creating a 'stmt' value with 'stmt_init' - to allow the use of all the other stmt functions, preparing proper security for our query<br>
    -'stmt prepare' to catch any syntax errors in the sql query<br>
    -'stmt execute' to finally execute the query now that all preparation is finished<br>
-A success or failure message was added, with a link to go to the log in page if it was successful<br>
</p>
</div>
<br>
<div class="enhance">
<h3>ENHANCEMENT 2:</h3>
<h4>Control access to manage.php by checking username and password.</h4>
<p>
<h4>To design this enhancement feature I created 2 files:</h4>
- manager_login.php<br>
- logout.php<br>
</p>
<p>
<h5>What I did in manager_login.php:</h5>
- The form and styling:<br>
    - A HTML form to enter username and password. Re-using styling from the manager_registration.php page, for design consistency<br>
    - Used 'id' for each field to add styling, which was placed in the linked styles.css<br>
    - Used php include to have the consistent header/nav and footer that the whole website uses.<br>
- Processing the login request:<br>
    - For processing the login request I had it contained with the login.php. where instead of the form having an action to go to another page, there was an if statement at the top of the page set to receive any POST request methods and handle it there<br>
    - Include settings.php to handle the connection to the database and check our login details<br>
    - Used the 'sprintf' and 'real escape string' to prevent sql injection in the 'query' being sent for 'username'<br>
    - Save the query result as 'result' and using this to initialise a new 'manager (functionally username)' variable<br>
    - Used 'password verify' as we have a hashed password to confirm against<br>
    - Our first 'session start' statement, so that a successful login can be used across the website via 'sessions'<br>
    - Used the primary key 'id' along with our 'manager' variable to create the session id<br>
    - Forwarded the now logged in manager to manage.php using a header statement<br>
            - In manage.php used 'session start' to maintain the logged in session as well<br>
            - In manage.php used an 'if' statement containing an '!isset' (is not set), linked to the 'session' variable containing the session id created earlier, so if the 'session' variable is NOT set, it redirects them to manager_login.php<br>
    - Through the use of if statements and a boolean variable of 'is valid' to display if a login was invalid<br>
</p>
<p>
<h5>What I did in logout.php:</h5>
- Called 'session start' first so we not what session to logout<br>
- Use 'session destroy' to destroy the current session.<br>
- This logs out the manager and via a header statement, is redirected autmoatically to the home page 'index.php'<br>
</p>
</div>
<br>
<div class="enhance">
    <h3>ENHANCEMENT 3:</h3>
    <p>- Date added column added to job_posting table <br>
        - loads from table and displays on each job posting<br>
        - auto gets the date the row was added and adds it<br>
    </p>
</div>
<br>
<div class="enhance">
<h3>Things I had to do for both these enhancements, not sure where to write them:</h3>
<p>
- Add 'session start' statements to all other main pages, so login carries across<br>
- Added a div section to the top of the header/nav bar that added log in and register buttons if not logged in, or a logout button if logged in<br>
    - Did this using a php 'if else' statement<br>
            - If 'session' 'isset' - show "logged in" and a hyperlinked 'log out' that sends you to logout.php<br>
            - Else shows a hyperlinked 'log in' or 'register'<br>
- With the combination of these login and logout buttons being part of the 'header.inc' and a 'session start' being included on every page, your login status is tracked across the whole website and you can login/logout from any page, with it being reflected site wide<br>
</p>
</div>


<?php include_once 'footer.inc'; ?>

</body>

</html>