<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/form_style.css">
    </head>
    <body>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Bug Report</a>
                <div class="dropdown-content">
                    <a href="create_report.php">Create</a>
                    <a href="search_reports.php?source=update">Update</a>
                    <a href="search_reports.php?source=search">Search</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn, active">Manage Database</a>
                <div class="dropdown-content">
                    <a href="manage_programs.php">Programs</a>
                    <a href="manage_functional_areas.php">Functional Areas</a>
                    <a href="manage_employees.php">Employees</a>
					<a href="manage_export.php">Exports</a>
                </div>
            </li>
            <li>
                <a href="search.php">Search</a>
            </li>
        </ul>

        <h2>
            <center>
                <?php
                    $source = $_GET['source'];
                    if($source == 'edit') {
                        echo '<font color="gray">Search for Program Information to Edit</font>';
                    }
                    if($source == 'delete') {
                        echo '<font color="gray">Search for Program Information to Delete</font>';
                    }
                    if($source == 'search') {
                        echo '<font color="gray">Search for a Program Information Entry</font>';
                    }
                ?>
            </center>
        </h2>

        <form name="edit_search_programs_form" action="search_program_post.php?source=<?php echo $source; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr>
                    <td>Program Name:</td><td><input type="Text" name="program_name" /></td>
                    <td><input type="submit" name="search_prog_input" value="Search by Program Name" /></td>
                </tr>
                <tr>
                    <td>Program Version:</td><td><input type="Number" name="program_version" /></td>
                    <td><input type="submit" name="search_prog_input" value="Search by Program Version" /></td>
                </tr>
                <tr>
                    <td>Program Release:</td><td><input type="Number" name="program_release" /></td>
                    <td><input type="submit" name="search_prog_input" value="Search by Program Release" /></td>
                </tr>
                <tr>
                    <td>Program Release Date:</td><td><input type="Date" name="program_release_date" /></td>
                    <td><input type="submit" name="search_prog_input" value="Search by Program Release Date" /></td>
                </tr>     
            </table>
            <input class="button" type="button" onclick="window.location.replace('search_program.php?source=<?php echo $source; ?>')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.program_name.value === "" && theform.search_emps_input === "Search by Program Name") {
                    alert ("Program Name field must contain characters");
                    return false;
                }
                if(theform.program_version.value === "" && theform.search_emps_input === "Search by Program Version") {
                    alert ("Program Version field must contain characters");
                    return false;
                }
                if(theform.program_release.value === "" && theform.search_emps_input === "Search by Program Release") {
                    alert ("Program Release field must contain characters");
                    return false;
                }
                if(theform.program_release_date.value === "" && theform.search_emps_input === "Search by Program Release Date") {
                    alert ("Program Release Date field must contain characters");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
