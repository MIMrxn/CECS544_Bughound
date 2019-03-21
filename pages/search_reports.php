<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/form_style.css">
    </head>
    <body>
        <?php
            session_start();
            if(isset($_SESSION['user_name']) && isset($_SESSION['user_level'])) {
                $user_level = $_SESSION['user_level'];
                $user_name = $_SESSION['user_name'];
            }
        ?>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php
                if(isset($_SESSION['user_name']) && isset($_SESSION['user_level'])) {
                    echo '<li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn, active">Bug Report</a>
                        <div class="dropdown-content">
                            <a href="create_report.php">Create</a>
                            <a href="search_reports.php?source=update">Update</a>
                            <a href="search_reports.php?source=search">Search</a>
                        </div>
                    </li>';
                    if($user_level == 5) {
                        echo '<li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn">Manage Database</a>
                        <div class="dropdown-content">
                            <a href="manage_programs.php">Programs</a>
                            <a href="manage_functional_areas.php">Functional Areas</a>
                            <a href="manage_employees.php">Employees</a>
                            <a href="manage_export.php">Exports</a>
                        </div>
                        </li>';
                    }
                    echo '<li style="float:right"><a href="logout.php">Logout</a></li>';
                    echo '<li style="float:right"><a>Welcome, '.$user_name.'</a></li>';
                } else {
                    echo '<li style="float:right"><a href="login.php">Login</a></li>';
                }
            ?>
        </ul>

        <h2>
            <center>
                <?php
                    $source = $_GET['source'];
                    if($source == 'update') {
                        echo '<font color="gray">Search for a Report to Update Entry</font>';
                    }
                    if($source == 'search') {
                        echo '<font color="gray">Search for a Report Entry</font>';
                    }
                ?>
            </center>
        </h2>

        <h2>
            <!-- ADD YOUR DB INFO HERE -->
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $conn = new mysqli($servername, $username, $password);
                mysqli_select_db($conn, "bughound_db");
            ?>
        </h2>

        <form name="search_reports_form" action="search_reports_post.php?source=<?php echo $source; ?>" method="post" onsubmit="return validate(this)">
        <!-- <form id="s_form" name="search_reports_form" action="search_reports_post.php?source=<?php echo $source; ?>" method="post"> -->
            <table>
                <tr>
                    <td>Program:</td>
                    <td>
                        <select name="program_id">
                            <option value="default" selected>Select Program</option>
                            <!-- Get all program info from DB here -->
                            <?php
                                $sql = "SELECT program_id, program_name, program_release, program_version FROM programs WHERE is_visible = 1";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $program_id = $row['program_id'];
                                    $program_name = $row['program_name'];
                                    $program_release = $row['program_release'];
                                    $program_version = $row['program_version'];
                                    echo '<option value="'.$program_id.'">'.$program_name.' Rel. '.$program_release.' Ver. '.$program_version.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Report Type:</td>
                    <td>
                        <select name="report_type">
                            <option value="default" selected>Select Report Type</option>
                            <option value="code_error">Coding Error</option>
                            <option value="design_issue">Design Issue</option>
                            <option value="suggestion">Suggestion</option>
                            <option value="documention">Documentation</option>
                            <option value="hardware">Hardware</option>
                            <option value="query">Query</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Severity:</td>
                    <td>
                        <select name="severity">
                            <option value="default" selected>Select Severity Level</option>
                            <option value="1">Minor</option>
                            <option value="2">Serious</option>
                            <option value="3">Fatal</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Reported By:</td>
                    <td>
                        <select name="reported_by">
                            <option value="default" selected>Select Reporter</option>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>     
                <tr>
                    <td>Date Bug Discovered:</td>
                    <td><input  type="date" name="date_discovered"></td>
                </tr>
                <tr>
                    <td>Functional Area:</td>
                    <td>
                        <select name="area_id">
                            <option value="default" selected>Select Area</option>
                            <!-- Get all program info from DB here -->
                            <?php
                                $sql = "SELECT area_id, area_name FROM areas";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $area_id = $row['area_id'];
                                    $area_name = $row['area_name'];
                                    echo '<option value="'.$area_id.'">'.$area_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Assigned To:</td>
                    <td>
                        <select name="assigned_to">
                            <option value="default" selected>Select Assignee</option>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option value="default">N/A</option>
                            <option value="open" selected>Open</option>
                            <option value="closed">Closed</option>
                            <option value="resolved">Resolved</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Priority:</td>
                    <td>
                        <select name="priority">
                            <option value="default" selected>Select Priority</option>
                            <option value="1">1. Fix immediately</option>
                            <option value="2">2. Fix as soon as possible</option>
                            <option value="3">3. Fix before next milestone</option>
                            <option value="4">4. Fix before release</option>
                            <option value="5">5. Fix if possible</option>
                            <option value="6">6. Optional</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Resolution:</td>
                    <td>
                        <select name="resolution">
                            <option value="default" selected>Select Resolution</option>
                            <option value="pending">Pending</option>
                            <option value="fixed">Fixed</option>
                            <option value="irreproducible">Irreproducible</option>
                            <option value="deferred">Deferred</option>
                            <option value="as_designed">As Designed</option>
                            <option value="withdrawn">Withdrawn By Reporter</option>
                            <option value="more_info">Need More Information</option>
                            <option value="disagreement">Disagree With Suggestion</option>
                            <option value="duplicate">Duplicate</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Resolution Version:</td>
                    <td><input type="Text" name="resolution_version" size="15"></td>
                </tr>
                <tr>
                    <td>Resolved By:</td>
                    <td>
                        <select name="resolved_by">
                            <option value="default" selected>Select Resolver</option>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Date Resolved:</td>
                    <td><input  type="date" name="date_resolved"></td>
                </tr>
                    <td>Tested By:</td>
                    <td>
                        <select name="tested_by">
                            <option value="default" selected>Select Tester</option>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                <tr>
                    <td>Date Tested:</td>
                    <td><input  type="date" name="date_tested"></td>
                <!-- 
                </tr>
                    <td>Treated as deferred?</td>
                    <td><input type="checkbox" name="treat_deferred"></td>
                <tr>
                -->
                <tr>
                    <td>
                        <!-- <input type="submit" name="search_reports_submit" value="Search" onclick="return validate(this)" /> -->
                        <input type="submit" id="search" name="search_reports_submit" value="Search" onclick="this.form.submitted=this.value" />
                        <input class="button" type="button" onclick="window.location.replace('search_reports.php?source=<?php echo $source; ?>')" value="Reset" />
                        <input class="button" type="button" onclick="window.location.replace('index.php')" value="Cancel" />
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" id="search" name="search_reports_submit" value="Search All Bugs" onclick="this.form.submitted=this.value"/></td>
                </tr>
            </table>
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.submitted === "Search") {
                    var at_least_one_selected = true;
                    if(theform.program_id.value === "default") {
                        at_least_one_selected = false;
                    }
                    if(theform.report_type.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.severity.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.reported_by.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.date_discovered.value != "" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.area_id.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.assigned_to.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.status.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.priority.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.resolution.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.resolution_version.value.trim() != "" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.resolved_by.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.date_resolved.value != "" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.tested_by.value != "default" && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    if(theform.date_tested.value != "" && at_least_one_selected === false){
                        at_least_one_selected = true;
                    }
                    /*
                    if(isset(theform.treat_deferred) && theform.treat_deferred.value === 'True' && at_least_one_selected === false) {
                        at_least_one_selected = true;
                    }
                    */

                    if(at_least_one_selected === true) {
                        return true;
                    } else {
                        alert ("At least one search term must be selected/filled in.");
                        return false;
                    }
                }
                
            }
        </script>
        
    </body>
</html>
