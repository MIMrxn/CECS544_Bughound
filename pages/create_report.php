<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/form_style.css">
    </head>
    <body>
        <h3>
            <!-- ADD YOUR DB INFO HERE -->
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $conn = new mysqli($servername, $username, $password);
                mysqli_select_db($conn, "bughound_db");
            ?>
        </h3>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn, active">Bug Report</a>
                <div class="dropdown-content">
                    <a href="create_report.php">Create</a>
                    <a href="update_report.php">Update</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Manage Database</a>
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

        <h2><font color="gray">New Bug Report Entry</font></h2>
        
        <form name="new_report_form" action="post_create_report.php" method="post" onsubmit="return validate(this)">
            <table>
                <tr>
                    <td>Program:</td>
                    <td>
                        <select>
							<!-- Get all program info from DB here -->
							<?php
                                $sql = "SELECT program_name FROM programs";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $program_name = $row['program_name'];
                                    echo '<option value="'.program_name.'">'.$program_name.'</option>';
                                }
                            ?>
							
                        </select>
                    </td>
                    <td>Report Type:</td>
                    <td>
                        <select>
                            <option value="code_error">Coding Error</option>
                            <option value="design_issue">Design Issue</option>
                            <option value="suggestion">Suggestion</option>
                            <option value="documention">Documentation</option>
                            <option value="hardware">Hardware</option>
                            <option value="query">Query</option>
                        </select>
                    </td>
                    <td>Severity:</td>
                    <td>
                        <select>
                            <option value="1">One</option>
                            <option value="5">Five</option>
                            <option value="10">Ten</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Problem Summary:</td>
                    <td><input type="Text" name="summary" size="60"></td>
                    <td>Reproducible?</td>
                    <td><input type="checkbox" name="reproducible"></td>
                </tr>
                <tr>
                    <td>Problem Description:</td>
                    <td>
                        <textarea name="problem_description" rows="5" cols="50" placeholder="Explain why bug is a problem. Describe all steps and symptoms including error messages. Be careful to describe how to reproduce the problem. Even if you can’t reproduce it, describe all the steps taken to do so."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Suggested Fix:</td>
                    <td><textarea name="suggested_fix" rows="5" cols="50" placeholder="(OPTIONAL)"></textarea></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Reported By:</td>
                    <td>
                        <select>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.employee_id.'">'.$employee_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>Date Discovered:</td>
                    <td><input  type="date" name="date_discovered"></td>
                </tr>
            </table>

            <hr>

            <table>
                <tr>
                    <td>Functional Area:</td>
                    <td>
                        <select>
							<!-- Get all program info from DB here -->
							<?php
                                $sql = "SELECT area_name FROM areas";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $area_name = $row['area_name'];
                                    echo '<option value="'.area_name.'">'.$area_name.'</option>';
                                }
                            ?>
							
                        </select>
                    </td>
                    <td>Assigned To:</td>
                    <td>
                        <select>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.employee_id.'">'.$employee_name.'</option>';
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
                        <select>
                            <option value="open">Open</option>
                            <option value="closed">Closed</option>
                            <option value="resolved">Resolved</option>
                        </select>
                    </td>
                    <td>Priority:</td>
                    <td>
                        <select>
                            <option value="one">1. Fix immediately</option>
                            <option value="two">2. Fix as soon as possible</option>
                            <option value="three">3. Fix before next milestone</option>
                            <option value="four">4. Fix before release</option>
                            <option value="four">5. Fix if possible</option>
                            <option value="four">6. Optional</option>
                        </select>
                    </td>
                    <td>Resolution:</td>
                    <td>
                        <select>
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
                    <td>Resolution Version:</td>
                    <td>
                        <select>
                            <option value="ver1">Version #</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>Resolved By:</td>
                    <td>
                        <select>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.employee_id.'">'.$employee_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>Date Resolved:</td>
                    <td><input  type="date" name="date_resolved"></td>
                    <td>Tested By:</td>
                    <td>
                        <select>
                            <?php
                                $sql = "SELECT employee_id, CONCAT(first_name, ' ', last_name) as employee_name FROM employees";
                                $result = $conn->query($sql);
                                while($row=$result->fetch_assoc()) {
                                    $employee_id = $row['employee_id'];
                                    $employee_name = $row['employee_name'];
                                    echo '<option value="'.employee_id.'">'.$employee_name.'</option>';
                                }
                            ?>
                        </select>
                    </td>
                    <td>Date Tested:</td>
                    <td><input  type="date" name="date_tested"></td>
                    <td>Treat as deferred?</td>
                    <td><input type="checkbox" name="treat_deferred"></td>
                </tr>
            </table>
            <?php
                $conn->close();
            ?>
            <input type="submit" name="submit_new_report" value="Submit">
            <input class="button" type="button" onclick="window.location.replace('create_report.php')" value="Reset" />
            <input class="button" type="button" onclick="window.location.replace('index.php')" value="Cancel" />
        </form>
    </body>
</html>
