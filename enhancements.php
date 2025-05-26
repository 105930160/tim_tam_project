<!-- Enahncements made
 
ENHANCEMENT 1:
• Create a manager registration page with server side validation requiring unique
username and a password rule, and store this information in a table.

To design this enhancement feature I created 2 files:
- manager_registration.php
- process_registration.php

What I did in manager_registration.php:
- A HTML form with username, password and pasword confirmation fields. Re-using styling from the apply.php page, for design consistency
- Used 'id' for each field to add styling, which was placed in the linked styles.css
- Used php include to have the consistent header/nav and footer that the whole website uses.

What I did in process_registration.php:
- Added various validations for the input form/registration fields:
    - Making a username required
    - Requiring 8 character password length
    - Requiring the password to contain 1 letter and 1 number
    - Checking both passwords typed in, match
- Added a 'require' for settings.php to enable connection to the database
- Used password hashing so that the password is saved securely
- Used the INSERT INTO function to add the registration data to the database, with security based additions:
    -Used placeholder values in the sql query - and then 'stmt bind param' later to add the proper values, so that sql injection is prevented
    -Creating a 'stmt' value with 'stmt_init' - to allow the use of all the other stmt functions, preparing proper security for our query
    -'stmt prepare' to catch any syntax errors in the sql query
    -'stmt execute' to finally execute the query now that all preparation is finished
-A success or failure message was added, with a link to go to the log in page if it was successful


ENHANCEMENT 2:
• Control access to manage.php by checking username and password. 

To design this enhancement feature I created 2 files:
- manager_login.php
- logout.php

What I did in manager_login.php:
- The form and styling:
    - A HTML form to enter username and password. Re-using styling from the manager_registration.php page, for design consistency
    - Used 'id' for each field to add styling, which was placed in the linked styles.css
    - Used php include to have the consistent header/nav and footer that the whole website uses.
- Processing the login request:
    - For processing the login request I had it contained with the login.php. where instead of the form having an action to go to another page,
      there was an if statement at the top of the page set to receive any POST request methods and handle it there
    - Include settings.php to handle the connection to the database and check our login details
    - Used the 'sprintf' and 'real escape string' to prevent sql injection in the 'query' being sent for 'username'
    - Save the query result as 'result' and using this to initialise a new 'manager (functionally username)' variable
    - Used 'password verify' as we have a hashed password to confirm against
    - Our first 'session start' statement, so that a successful login can be used across the website via 'sessions'
    - Used the primary key 'id' along with our 'manager' variable to create the session id
    - Forwarded the now logged in manager to manage.php using a header statement
       - In manage.php used 'session start' to maintain the logged in session as well
       - In manage.php used an 'if' statement containing an '!isset' (is not set), linked to the 'session' variable containing the session id created earlier,
         so if the 'session' variable is NOT set, it redirects them to manager_login.php 
    - Through the use of if statements and a boolean variable of 'is valid' to display if a login was invalid

What I did in logout.php:
- Called 'session start' first so we not what session to logout
- Use 'session destroy' to destroy the current session.
- This logs out the manager and via a header statement, is redirected autmoatically to the home page 'index.php'


THINGS I HAD TO DO FOR BOTH THESE ENHANCEMENTS, NOT SURE WHAT SECTION TO WRITE THEM:
- Add 'session start' statements to all other main pages, so login carries across
- Added a <div> section to the bottom of the header/nav bar that added log in and register buttons if not logged in, or a logour button if logged in
    - Did this using a php 'if else' statement
        - If 'session' 'isset' - show "logged in" and a hyperlinked 'log out' that sends you to logout.php
        - Else shows a hyperlinked 'log in' or 'register'
- With the combination of these login and logout buttons being part of the 'header.inc' and a 'session start' being included on every page,
  your login status is tracked across the whole website and you can login/logout from any page, with it being reflected site wide

-->