<header>
    <!--nav is seperated into top and bottom in order to more easily deal with everything-->
    <div id="navtop">
        <div id="login_signup_signout_buttons">
            <?php if (isset($_SESSION["manager_id"])): ?>
                <p>You are logged in. <a href="logout.php">Log out</a></p>
            <?php else: ?>
                <p><a href="manager_login.php">Log in</a> or <a href="manager_registration.php">Sign up</a></p>
            <?php endif; ?>
        </div>
        <!--likewise, navtop is seperated into two seperate divs-->
        <div id="navtopmiddle">
            <a href="index.php"><img id="logo" src="Images/GenericITCompanyLogo.png" alt="Generic IT Company Logo"></a>
        </div>
        <aside>
            <a href="mailto:info@genericitcompany.com.au" id="contactus"><p>Contact Us!</p></a>
        </aside>
    </div>
    <nav>
        <a id="homebutton" href="index.php"><p>Home</p></a>
        <a href="jobs.php"><p>Jobs</p></a>
        <a id="applybutton" href="apply.php"><p>Apply</p></a>
        <a href="about.php"><p>About</p></a>
        <a href="manage.php"><p>Manage</p></a>
    </nav>
</header>