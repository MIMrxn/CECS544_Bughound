<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/vertical_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/form_style.css">
    </head>
    <body>
        <!-- ADD YOUR DB INFO HERE -->
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $conn = new mysqli($servername, $username, $password);
            mysqli_select_db($conn, "bughound_db");

            $emp_id = $_GET['emp_id'];

            $sql = "SELECT * FROM employees WHERE employee_id = $emp_id";

            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            $first_name = $row[1];
            $last_name = $row[2];
            $user_name = $row[3];
            $user_pass = $row[4];
            $position = $row[5];
            $group_num = $row[6];
            $is_reporter = $row[7];
            $user_level = $row[8];
            
            $conn->close();
        ?>
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
                    <a href="manage_releases.php">Releases</a>
                    <a href="manage_functional_areas.php">Functional Areas</a>
                    <a href="manage_employees.php">Employees</a>
                </div>
            </li>
            <li>
                <a href="search.php">Search</a>
            </li>
        </ul>

        <h2><center><font color="gray">Edit an Employee Entry</font></center></h2>

        <form name="edit_employee_form" action="edit_employee_post.php?emp_id=<?php echo $emp_id; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>First Name:</td><td><input type="Text" name="first_name" value="<?php echo $first_name; ?>" /></td></tr>
                <tr><td>Last Name:</td><td><input type="Text" name="last_name" value="<?php echo $last_name; ?>" /></td></tr>
                <tr><td>Username:</td><td><input type="Text" name="user_name" value="<?php echo $user_name; ?>" /></td></tr>
                <tr><td>Password:</td><td><input type="Text" name="user_pass" value="<?php echo $user_pass; ?>" /></td></tr>
                <tr>
                    <td>Position:</td>
                    <td>
                        <select name="position" required >
                            <option value="">Select Position</option>
                            <?php
                                if($position === "programmer") {
                                    echo '<option selected="selected" value="programmer">Programmer</option>';
                                } else {
                                    echo '<option value="programmer">Programmer</option>';
                                }
                                if($position === "designer") {
                                    echo '<option selected="selected" value="designer">Designer</option>';
                                } else {
                                    echo '<option value="designer">Designer</option>';
                                }
                                if($position === "tester") {
                                    echo '<option selected="selected" value="tester">Tester</option>';
                                } else {
                                    echo '<option value="tester">Tester</option>';
                                }
                                if($position === "manager") {
                                    echo '<option selected="selected" value="manager">Manager</option>';
                                } else {
                                    echo '<option value="manager">Manager</option>';
                                }
                            ?>        
                        </select>
                    </td>
                </tr>     
                <tr><td>Group Number</td><td><input type="Text" name="group_num" value="<?php echo $group_num; ?>" ></td></tr>
                <tr>
                    <?php
                        if($is_reporter === "0") {
                            echo '<td>Is a reporter?</td><td><input type="checkbox" name="is_reporter" value="True" /></td>';
                        } else if ($is_reporter === "1") {
                            echo '<td>Is a reporter?</td><td><input type="checkbox" name="is_reporter" value="True" checked /></td>';
                        }
                    ?>
                    
                </tr>
                <tr><td>User Level:</td><td><input type="Number" name="user_level" value="<?php echo $user_level; ?>" /></td></tr>      
            </table>
            <input type="submit" name="submit" value="Edit" />
            <input class="button" type="button" onclick="window.location.replace('manage_employees.php')" value="Cancel" />
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
                if(theform.password.value === ""){
                    alert ("Password field must contain characters");
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
                    alert ("User Level field must contain a number from 1-5");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
