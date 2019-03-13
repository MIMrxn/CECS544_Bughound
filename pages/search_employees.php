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
                    <a href="update_report.php">Update</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn, active">Manage Database</a>
                <div class="dropdown-content">
                    <a href="manage_programs.php">Programs</a>
                    <a href="manage_functional_areas.php">Functional Areas</a>
                    <a href="manage_employees.php">Employees</a>
					<<a href="manage_export.php">Exports</a>
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
                        echo '<font color="gray">Search for an Employee to Edit Entry</font>';
                    }
                    if($source == 'delete') {
                        echo '<font color="gray">Search for an Employee to Delete Entry</font>';
                    }
                    if($source == 'search') {
                        echo '<font color="gray">Search for an Employee Entry</font>';
                    }
                ?>
            </center>
        </h2>

        <form name="search_employees_form" action="search_employees_post.php?source=<?php echo $source; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr>
                    <td>First Name:</td><td><input type="Text" name="first_name" /></td>
                    <td><input type="submit" name="search_emps_input" value="Search by First Name" /></td>
                </tr>
                <tr>
                    <td>Last Name:</td><td><input type="Text" name="last_name" /></td>
                    <td><input type="submit" name="search_emps_input" value="Search by Last Name" /></td>
                </tr>
                <tr>
                    <td>Username:</td><td><input type="Text" name="user_name" /></td>
                    <td><input type="submit" name="search_emps_input" value="Search by Username" /></td>
                </tr>
                <tr>
                    <td>Position:</td>
                    <td>
                        <select name="position">
                                <option value="">Select Position</option>
                                <option value="programmer">Programmer</option>
                                <option value="designer">Designer</option>
                                <option value="tester">Tester</option>
                                <option value="manager">Manager</option>
                        </select>
                    </td>
                    <td><input type="submit" name="search_emps_input" value="Search by Position" /></td>
                </tr>     
                <tr>
                    <td>Group Number</td><td><input type="Text" name="group_num"></td>
                    <td><input type="submit" name="search_emps_input" value="Search by Group Number" /></td>
                </tr>
                <tr>
                    <td>Is a reporter?</td><td><input type="checkbox" name="is_reporter" value="True" /></td>
                    <td><input type="submit" name="search_emps_input" value="Search by Is a Reporter" /></td>
                </tr>
                <tr>
                    <td>User Level:</td><td><input type="Number" name="user_level" /></td>
                    <td><input type="submit" name="search_emps_input" value="Search by User Level" /></td>
                </tr>      
            </table>
            <input class="button" type="button" onclick="window.location.replace('search_employees.php?source=<?php echo $source; ?>')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.first_name.value === "" && theform.search_emps_input === "Search by First Name") {
                    alert ("First Name field must contain characters");
                    return false;
                }
                if(theform.last_name.value === "" && theform.search_emps_input === "Search by Last Name") {
                    alert ("Last Name field must contain characters");
                    return false;
                }
                if(theform.user_name.value === "" && theform.search_emps_input === "Search by Username") {
                    alert ("Username field must contain characters");
                    return false;
                }
                if(theform.position.value === "" && theform.search_emps_input === "Search by Position") {
                    alert ("Must select a position");
                    return false;
                }
                if(theform.group_num.value === "" && theform.search_emps_input === "Search by Group Number") {
                    alert ("Group number field must contain a number");
                    return false;
                }
                if(theform.user_level.value === "" && theform.search_emps_input === "Search by User Level"){
                    alert ("User Level field must contain a number from 1-5");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
