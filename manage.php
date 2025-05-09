<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Search Expressions of Interest">
        <meta name="keywords" content="IT, EOI, Expression of Interest, job applications">
        <meta name="author" content="Sasha Panisset">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Search EOIs</title>
    </head>
    <body>
        <h1>EOI Manager</h1>
        <!--search boxes begin here-->
        <form method="GET" action="manage_search_results.php">
            <label>Job position:</label>
            <input type="text" name="job_ref_num">
            <label>First name:</label>
            <input type="text" name="first_name">
            <label>Last name:</label>
            <input type="text" name="last_name">
            <input type="submit" value="Search">
        </form>
        <table> <caption>Pending Expressions of Interest:</caption>
            <tr>
                <th>EOI Num</th>
                <th>Job Ref Num</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Skills</th>
                <th>Other Skills</th>
            </tr>
            
        </table>
    </body>
</html>