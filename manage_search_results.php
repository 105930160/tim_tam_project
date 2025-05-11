<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Search EOIs - Results</title>
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
    </body>
</html>