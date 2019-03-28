<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
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

            $report_id = $_GET['report_id'];

            $sql = "SELECT * FROM bugs WHERE report_id = $report_id";

            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            
            $program_id = $row[1];
            $report_type = $row[2];
            $severity = $row[3];
            $summary = $row[4];
            $reproducible = $row[5];
            $problem_description = $row[6];
            $suggested_fix = $row[7];
            $reported_by = $row[8];
            $date_discovered = $row[9];
            $area_id = $row[10];
            $assigned_to = $row[11];
            $status = $row[12];
            $priority = $row[13];
            $resolution = $row[14];
            $resolution_version = $row[15];
            $resolved_by = $row[16];
            $date_resolved = $row[17];
            $tested_by = $row[18];
            $date_tested = $row[19];
            $treat_deferred = $row[20];
            $has_attachments = $row[21];
            $comments = $row[22];

            //$conn->close();

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

        <h2><center><font color="gray">Update Bug Report</font></center></h2>

        <form name="update_report_form" action="update_report_post.php?report_id=<?php echo $report_id; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr>
                    <td>Program:</td>
                    <td>
                        <select name="program_id">
                            <option value="default">Select Program</option>
                            <!-- Get all program info from DB here -->
                            <?php
                                $sql = "SELECT program_id, program_name, program_release, program_version FROM programs WHERE program_id = '".$program_id."' ";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $fetched_program_id = $row['program_id'];
                                    $fetched_program_name = $row['program_name'];
                                    $fetched_program_release = $row['program_release'];
                                    $fetched_program_version = $row['program_version'];
                                    if($fetched_program_id === $program_id) {
                                        echo '<option value="'.$fetched_program_id.'" selected>'.$fetched_program_name.' Rel. '.$fetched_program_release.' Ver. '.$fetched_program_version.'</option>';
                                    } else {
                                        echo '<option value="'.$fetched_program_id.'">'.$fetched_program_name.' Rel. '.$fetched_program_release.' Ver. '.$fetched_program_version.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td>Report Type:</td>
                    <td>
                        <select name="report_type">
                            <option value="default">Select Report Type</option>
                            <?php
                                if($report_type === "code_error") {
                                    echo '<option value="code_error" selected>Coding Error</option>';
                                } else {
                                    echo '<option value="code_error">Coding Error</option>';
                                }
                                if($report_type === "design_issue") {
                                    echo '<option value="design_issue" selected>Design Issue</option>';
                                } else {
                                    echo '<option value="design_issue">Design Issue</option>';
                                }
                                if($report_type === "suggestion") {
                                    echo '<option value="suggestion" selected>Suggestion</option>';
                                } else {
                                    echo '<option value="suggestion">Suggestion</option>';
                                }
                                if($report_type === "documention") {
                                    echo '<option value="documention" selected>Documentation</option>';
                                } else {
                                    echo '<option value="documention">Documentation</option>';
                                }
                                if($report_type === "hardware") {
                                    echo '<option value="hardware" selected>Hardware</option>';
                                } else {
                                    echo '<option value="hardware">Hardware</option>';
                                }
                                if($report_type === "query") {
                                    echo '<option value="query" selected>Query</option>';
                                } else {
                                    echo '<option value="query">Query</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>Severity:</td>
                    <td>
                        <select name="severity">
                            <option value="default">Select Severity Level</option>
                            <?php
                                if($severity === "1") {
                                    echo '<option value="1" selected>Minor</option>';
                                } else {
                                    echo '<option value="1">Minor</option>';
                                }
                                if($severity === "2") {
                                    echo '<option value="2" selected>Serious</option>';
                                } else {
                                    echo '<option value="2">Serious</option>';
                                }
                                if($severity === "3") {
                                    echo '<option value="3" selected>Fatal</option>';
                                } else {
                                    echo '<option value="3">Fatal</option>';
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Problem Summary:</td>
                    <td><input type="Text" name="summary" size="60" value="<?php echo $summary; ?>"></td>
                    <td>Reproducible?</td>
                    <?php
                        if($reproducible === "1") {
                            echo '<td><input type="checkbox" name="reproducible" value="checked" checked></td>';
                        } else {
                            echo '<td><input type="checkbox" name="reproducible" value="checked"></td>';
                        }
                    ?>
                </tr>
                <tr>
                    <td>Problem Description:</td>
                    <td>
                        <textarea name="problem_description" rows="5" cols="50" placeholder="Explain why bug is a problem. Describe all steps and symptoms including error messages. Be careful to describe how to reproduce the problem. Even if you can’t reproduce it, describe all the steps taken to do so."><?php echo $problem_description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Suggested Fix:</td>
                    <td><textarea name="suggested_fix" rows="5" cols="50" placeholder="(OPTIONAL)"><?php echo $suggested_fix; ?></textarea></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Reported By:</td>
                    <td>
                        <select name="reported_by">
                            <option value="default">Select Reporter</option>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    if($reported_by === $employee_id) {
                                        echo '<option value="'.$employee_id.'" selected>'.$employee_name.'</option>';
                                    } else {
                                        echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td>Date Discovered:</td>
                    <td><input  type="date" name="date_discovered" value="<?php echo $date_discovered; ?>"></td>
                </tr>
            </table>

            <hr>

            <table>
                <tr>
                    <td>Functional Area:</td>
                    <td>
                        <select name="area_id">
                            <option value="default" selected>Select Area</option>
                            <!-- Get all program info from DB here -->
                            <?php
                                $sql = "SELECT area_id, area_name FROM areas WHERE program_id = '".$program_id."' ";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $fetched_area_id = $row['area_id'];
                                    $fetched_area_name = $row['area_name'];
                                    if($fetched_area_id === $area_id) {
                                        echo '<option value="'.$fetched_area_id.'" selected>'.$fetched_area_name.'</option>';
                                    } else {
                                        echo '<option value="'.$fetched_area_id.'">'.$fetched_area_name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </td>
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
                                    if($assigned_to === $employee_id) {
                                        echo '<option value="'.$employee_id.'" selected>'.$employee_name.'</option>';
                                    } else {
                                        echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option value="default">Select Status</option>
                            <?php
                                if($status === "open") {
                                    echo '<option value="open" selected>Open</option>';
                                } else {
                                    echo '<option value="open">Open</option>';
                                }
                                if($status === "closed") {
                                    echo '<option value="closed" selected>Closed</option>';
                                } else {
                                    echo '<option value="closed">Closed</option>';
                                }
                                if($status === "resolved") {
                                    echo '<option value="resolved" selected>Resolved</option>';
                                } else {
                                    echo '<option value="resolved">Resolved</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>Priority:</td>
                    <td>
                        <select name="priority">
                            <option value="default" selected>Select Priority</option>
                            <?php
                                if($priority === "1") {
                                    echo '<option value="1" selected>1. Fix immediately</option>';
                                } else {
                                    echo '<option value="1">1. Fix immediately</option>';
                                }
                                if($priority === "2") {
                                    echo '<option value="2" selected>2. Fix as soon as possible</option>';
                                } else {
                                    echo '<option value="2">2. Fix as soon as possible</option>';
                                }
                                if($priority === "3") {
                                    echo '<option value="3" selected>3. Fix before next milestone</option>';
                                } else {
                                    echo '<option value="3">3. Fix before next milestone</option>';
                                }
                                if($priority === "4") {
                                    echo '<option value="4" selected>4. Fix before release</option>';
                                } else {
                                    echo '<option value="4">4. Fix before release</option>';
                                }
                                if($priority === "5") {
                                    echo '<option value="5" selected>5. Fix if possible</option>';
                                } else {
                                    echo '<option value="5">5. Fix if possible</option>';
                                }
                                if($priority === "6") {
                                    echo '<option value="6" selected>6. Optional</option>';
                                } else {
                                    echo '<option value="6">6. Optional</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>Resolution:</td>
                    <td>
                        <select name="resolution">
                            <option value="default" selected>Select Resolution</option>
                            <?php
                                if($resolution === "pending") {
                                    echo '<option value="pending" selected>Pending</option>';
                                } else {
                                    echo '<option value="pending">Pending</option>';
                                }
                                if($resolution === "fixed") {
                                    echo '<option value="fixed" selected>Fixed</option>';
                                } else {
                                    echo '<option value="fixed">Fixed</option>';
                                }
                                if($resolution === "irreproducible") {
                                    echo '<option value="irreproducible" selected>Irreproducible</option>';
                                } else {
                                    echo '<option value="irreproducible">Irreproducible</option>';
                                }
                                if($resolution === "deferred") {
                                    echo '<option value="deferred" selected>Deferred</option>';
                                } else {
                                    echo '<option value="deferred">Deferred</option>';
                                }
                                if($resolution === "as_designed") {
                                    echo '<option value="as_designed" selected>As Designed</option>';
                                } else {
                                    echo '<option value="as_designed">As Designed</option>';
                                }
                                if($resolution === "withdrawn") {
                                    echo '<option value="withdrawn" selected>Withdrawn By Reporter</option>';
                                } else {
                                    echo '<option value="withdrawn">Withdrawn By Reporter</option>';
                                }
                                if($resolution === "more_info") {
                                    echo '<option value="more_info" selected>Need More Information</option>';
                                } else {
                                    echo '<option value="more_info">Need More Information</option>';
                                }
                                if($resolution === "disagreement") {
                                    echo '<option value="disagreement" selected>Disagree With Suggestion</option>';
                                } else {
                                    echo '<option value="disagreement">Disagree With Suggestion</option>';
                                }
                                if($resolution === "duplicate") {
                                    echo '<option value="duplicate" selected>Duplicate</option>';
                                } else {
                                    echo '<option value="duplicate">Duplicate</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>Resolution Version:</td>
                    <td><input type="Text" name="resolution_version" size="15" value="<?php echo $resolution_version; ?>"></td>
                </tr>
            </table>
            <table>
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
                                    if($resolved_by === $employee_id) {
                                        echo '<option value="'.$employee_id.'" selected>'.$employee_name.'</option>';
                                    } else {
                                        echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td>Date Resolved:</td>
                    <td><input  type="date" name="date_resolved" value="<?php echo $date_resolved; ?>"></td>
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
                                    if($tested_by === $employee_id) {
                                        echo '<option value="'.$employee_id.'" selected>'.$employee_name.'</option>';
                                    } else {
                                        echo '<option value="'.$employee_id.'">'.$employee_name.'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </td>
                    <td>Date Tested:</td>
                    <td><input  type="date" name="date_tested" value="<?php echo $date_tested; ?>"></td>
                    <td>Treat as deferred?</td>
                    <?php
                        if($treat_deferred === "1") {
                            echo '<td><input type="checkbox" name="treat_deferred" value="checked" checked></td>';
                        } else {
                            echo '<td><input type="checkbox" name="treat_deferred" value="checked"></td>';
                        }
                    ?>
                </tr>
            </table>

            <hr>

            <table>
                <tr>
                    <td>Additional Comments:</td>
                    <td><textarea name="comments" rows="5" cols="50" placeholder="Add any extra information that may be relevant."><?php echo $comments; ?></textarea></td>
                </tr>
                <tr>
                    <td>Attachments:</td>
                    <td><input type="file" name="attachments"></td>
                </tr>
                <?php
                    //echo "console.log('This is the attachments: '".$has_attachments."'');";
                    if($has_attachments === "1") {
                        $sql_attach = "SELECT file_name FROM attachments WHERE report_id = '".$report_id."'";
                        $attach_result = $conn->query($sql_attach);
                        $attach_row=$attach_result->fetch_assoc();
                        $file_name = $attach_row['file_name'];

                        echo "<tr>";
                        echo "<td>Current attachment: </td>";
                        echo "<td><a href=".$file_name." download>".basename($file_name)."</a></td>";
                        echo "</tr>";
                    }
                ?>
            </table>

            <?php
                $conn->close();
            ?>

            <input type="submit" name="submit" value="Update" />
            <input class="button" type="button" onclick="window.location.replace('update_report.php?report_id=<?php echo $report_id; ?>')" value="Reset" />
            <input class="button" type="button" onclick="window.location.replace('index.php')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.program_name.value === "default"){
                    alert ("Program must be selected");
                    return false;
                }
                if(theform.report_type.value === "default"){
                    alert ("Report Type must be selected");
                    return false;
                }
                if(theform.severity.value === "default"){
                    alert ("Severity must be selected");
                    return false;
                }
                if(theform.summary.value === ""){
                    alert ("Summary field must contain characters");
                    return false;
                }
                if(theform.problem_description.value === ""){
                    alert ("Problem description must be filled");
                    return false;
                }
                if(theform.reported_by.value === "default"){
                    alert ("Report By must be selected");
                    return false;
                }
                if(theform.date_discovered.value === ""){
                    alert ("Date Discovered must be filled");
                    return false;
                }
                if(theform.functional_area_name.value === "default"){
                    alert ("Functional area must be selected");
                    return false;
                }
                if(theform.assigned_to.value === "default"){
                    alert ("Assigned To must be selected");
                    return false;
                }
                if(theform.status.value === "default"){
                    alert ("Status must be selected");
                    return false;
                }
                if(theform.priority.value === "default"){
                    alert ("Priority must be selected");
                    return false;
                }
                if(theform.resolution.value === "default"){
                    alert ("Resolution must be selected");
                    return false;
                }
                if(theform.resolution_version.value === ""){
                    alert ("Resolution version must be filled");
                    return false;
                }
                if(theform.resolved_by.value === "default"){
                    alert ("Resolved By must be selected");
                    return false;
                }
                if(theform.date_resolved.value === ""){
                    alert ("Date Resolved must be selected");
                    return false;
                }
                if(theform.tested_by.value === "default"){
                    alert ("Tested By must be selected");
                    return false;
                }
                if(theform.date_tested.value === ""){
                    alert ("Date Tested must be selected");
                    return false;
                }

                return true;
            }
        </script>
    </body>
</html>
