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
                    <a href="manage_releases.php">Releases</a>
                    <a href="manage_functional_areas.php">Functional Areas</a>
                    <a href="manage_employees.php">Employees</a>
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
                ?>
            </center>
        </h2>

        <form name="search_employees_form" action="search_employees_post.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>First Name:</td><td><input type="Text" name="first_name" /></td></tr>
                <tr><td>Last Name:</td><td><input type="Text" name="last_name" /></td></tr>
                <tr><td>Username:</td><td><input type="Text" name="user_name" /></td></tr>
                <tr>
                    <td>Position:</td>
                    <td>
                    <select name="position" required>
                            <option value="">Select Position</option>
                            <option value="programmer">Programmer</option>
                            <option value="designer">Designer</option>
                            <option value="tester">Tester</option>
                            <option value="manager">Manager</option>
                    </select>
                    </td>
                </tr>     
                <tr><td>Group Number</td><td><input type="Text" name="group_num"></td></tr>
                <tr><td>Is a reporter?</td><td><input type="checkbox" name="is_reporter" value="True" /></td></tr>
                <tr><td>User Level:</td><td><input type="Text" name="user_level" /></td></tr>      
            </table>
            <input type="submit" name="submit" value="Search" />
            <input class="button" type="button" onclick="window.location.replace('search_employees.php')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.first_name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.last_name.value === ""){
                    alert ("Name field must contain characters");
                    return false;
                }
                if(theform.user_name.value === ""){
                    alert ("User name field must contain characters");
                    return false;
                }
                if(theform.position.value === ""){
                    alert ("Must select a position");
                    return false;
                }
                if(theform.group_num.value === ""){
                    alert ("Group number field must contain a number");
                    return false;
                }
                if(theform.user_level.value === ""){
                    alert ("User name field must contain characters");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
