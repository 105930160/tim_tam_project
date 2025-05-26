<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ethan Roden">
    <meta name="description" content="About our Group">
    <meta name="keywords" content="About, Group information, Contributions">
    <title>About our Group</title>
    <link href="./styles/global.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>
    
    <?php include 'header.inc'; ?>

    <main class="aboutmain">
        <h1 id="aboutheading">Our Team</h1> <!-- descriptive id, easy to comprehend and avoids CSS conflicts with other <h1> elements from other pages -->

        <div class="containerabout"> <!-- put all 4 'sections' inside, so that i can set up CSS grid layout - ID for styling without conflict with any other <div> -->
            <section id="contributions"> <!-- 4 main parts of the page, each in a section as it holds a related set of info + its heading, id used for easy styling of whole section -->
                <h2 id="contributionsheading">Contributions</h2> <!-- descriptive id used for <h2> element for ease of understanding and avoiding CSS conflict with other <h2>-->
            <dl>
            <dt>Angel</dt>
                <dd>Part 1: Created github project. Created and styled the jobs page</dd>
                <dd>Part 2: Updated the jobs page to pull a list of jobs from a PHP database</dd>
                <dt>Sasha</dt>
                <dd>Part 1: Drew up initial design for header, navbar and footer. Created and styled the Application page</dd>
                <dd>Part 2: Created Manage.php with search functions for the EOI</dd>
                <dt>Akira</dt>
                <dd>Part 1: Created group email and Jira, created and styled HTML template. Created and styled the home page</dd>
                <dd>Part 2: Built EOI table, with validation for the records</dd>
                <dt>Ethan</dt>
                <dd>Part 1: Created and styled the About page</dd>
                <dd>part 2: Handled the extensions for manager registration and login</dd>
            </dl>
            </section>

            <section id="groupinfo"> <!-- 4 main parts of the page, each in a section as it holds a related set of info + its heading, id used for easy styling of whole section -->
                <h2 id="groupinfoheading">Group Information</h2> <!-- descriptive id used for <h2> element for ease of understanding and avoiding CSS conflict with other <h2>-->
            <ul>
                <li>Group name: Tim Tams</li>
                <li>Class day and time: Wednesday 4:30pm</li>
                <li>Group members
                    <ul>
                        <li>Angel - 105930160</li>
                        <li>Sasha - 106004587</li>
                        <li>Akira - 105913349</li>
                        <li>Ethan - 105784587</li>
                    </ul>
                </li>
                <li>Teacher: Rahul</li>
            </ul>
            </section>

            <section id="tablesection"> <!-- 4 main parts of the page, each in a section as it holds a related set of info + its heading, id used for easy styling of whole section -->
                <h2 id="intereststableheading">Group Interests</h2> <!-- descriptive id used for <h2> element for ease of understanding and avoiding CSS conflict with other <h2>-->
                <table id="intereststable">
                    <caption id="tablecap">Of course we all love HTML CSS, and PHP. It's so fun! (bonus marks please)</caption>
                    <thead>
                        <tr>
                            <th class="tableheading">Name</th> <!-- class used as multiple elements of the table require same styling -->
                            <th class="tableheading">Interests</th>
                            <th class="tableheading">Shared interest</th> <!--Need to show off merged section of table, this gives good reason to-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tablecell">Angel</td> <!-- class used as multiple elements of the table require same styling -->
                            <td class="tablecell">Music, Programming</td>
                            <td class="tablecell" rowspan="4">Using HTML, CSS and PHP to create webpages!</td> <!--merge this into all 4 cells of final column-->
                        </tr>
                        <tr>
                            <td class="tablecell">Sasha</td> <!-- class used as multiple elements of the table require same styling -->
                            <td class="tablecell">DnD, Drawing</td>
                        </tr>
                        <tr>
                            <td class="tablecell">Akira</td> <!-- class used as multiple elements of the table require same styling -->
                            <td class="tablecell">Programming, Doodling, Fish</td>
                        </tr>
                        <tr>
                            <td class="tablecell">Ethan</td> <!-- class used as multiple elements of the table require same styling -->
                            <td class="tablecell">Gaming, Reading</td>
                        </tr>
                    </tbody>
                </table>
            </section> 

            <section id="figsec"> <!-- 4 main parts of the page, each in a section as it holds a related set of info + its heading, id used for easy styling of whole section -->
                <h2 id="groupphotoheading">Group Photo</h2> <!-- descriptive id used for <h2> element for ease of understanding and avoiding CSS conflict with other <h2>-->
                <figure>
                    <img id="grouppic" src="images/Group_photo.jpg" alt="Group photo with all 4 members">
                    <figcaption id="figcapabout">From left to right: Sasha, Ethan, Angel and Akira</figcaption>
                </figure>
            </section>
        </div> 
    </main>

    <?php include 'footer.inc'; ?>
</body>

</html>