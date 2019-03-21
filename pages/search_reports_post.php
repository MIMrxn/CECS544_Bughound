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
            <?php
                $sql = "";
                
                $source = $_GET['source'];
                if($source == 'update') {
                    echo "<h2><center>Results for Reports to Update\n</center></h2><h3>Click on report ID number to update.</h3>";
                }
                if($source == 'search') {
                    echo "<h2><center>Results for Reports Search\n</center></h2>";
                }

                //$program_name = $_POST['program_name'];
                $program_id = $_POST['program_id'];
                $report_type = $_POST['report_type'];
                $severity = $_POST['severity'];
                /*
                $reproducible = -1;
                if(isset($_POST['reproducible']) && $_POST['reproducible'] == 'True') {
                    $reproducible = 1;
                } else {
                    $reproducible = 0;
                }
                */
                $reported_by = $_POST['reported_by'];
                $date_discovered = $_POST['date_discovered'];
                $area_id = $_POST['area_id'];
                $assigned_to = $_POST['assigned_to'];
                $status = $_POST['status'];
                $priority = $_POST['priority'];
                $resolution = $_POST['resolution'];
                $resolution_version = $_POST['resolution_version'];
                $resolved_by = $_POST['resolved_by'];
                $date_resolved = $_POST['date_resolved'];
                $tested_by = $_POST['tested_by'];
                $date_tested = $_POST['date_tested'];
                /*
                $treat_deferred = -1;
                if(isset($_POST['treat_deferred']) && $_POST['treat_deferred'] == 'True') {
                    $treat_deferred = 1;
                } else {
                    $treat_deferred = 0;
                }
                */

                $search_type = $_POST['search_reports_submit'];

                $previous_selection_exists = false;
                //$sql = "SELECT b.report_id, p.program_name, b.report_type, b.severity, b.summary, b.reproducible, b.problem_description, b.suggested_fix, b.reported_by, b.date_discovered, a.area_name, b.assigned_to, b.status, b.priority, b.resolution, b.resolution_version, b.resolved_by, b.date_resolved, b.tested_by, b.date_tested, b.treat_deferred, b.has_attachments, b.comments FROM bugs AS b, programs AS p, areas AS a WHERE ";
                $sql = "SELECT * FROM bugs as b WHERE ";
                
                if($search_type === "Search") {
                    if($program_id != "default") {
                        $sql .= " b.program_id = '".$program_id."' ";
                        $previous_selection_exists = true;
                    }
                    if($report_type != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.report_type = '".$report_type."' ";
                    } else if($report_type != "default" && $previous_selection_exists === false) {
                        $sql .= " b.report_type = '".$report_type."' ";
                        $previous_selection_exists = true;
                    }
                    if($severity != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.severity = '".$severity."' ";
                    } else if($severity != "default" && $previous_selection_exists === false) {
                        $sql .= " b.severity = '".$severity."' ";
                        $previous_selection_exists = true;
                    }
                    if($reported_by != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.reported_by = '".$reported_by."' ";
                    } else if($reported_by != "default" && $previous_selection_exists === false) {
                        $sql .= " b.reported_by = '".$reported_by."' ";
                        $previous_selection_exists = true;
                    }
                    if($date_discovered != "" && $previous_selection_exists === true) {
                        $sql .= " AND b.date_discovered = '".$date_discovered."' ";
                    } else if($date_discovered != "" && $previous_selection_exists === false) {
                        $sql .= " b.date_discovered = '".$date_discovered."' ";
                        $previous_selection_exists = true;
                    }
                    if($area_id != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.area_id = '".$area_id."' ";
                    } else if($area_id != "default" && $previous_selection_exists === false) {
                        $sql .= " b.area_id = '".$area_id."' ";
                        $previous_selection_exists = true;
                    }
                    if($assigned_to != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.assigned_to = '".$assigned_to."' ";
                    } else if($assigned_to != "default" && $previous_selection_exists === false) {
                        $sql .= " b.assigned_to = '".$assigned_to."' ";
                        $previous_selection_exists = true;
                    }
                    if($status != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.status = '".$status."' ";
                    } else if($status != "default" && $previous_selection_exists === false) {
                        $sql .= " b.status = '".$status."' ";
                        $previous_selection_exists = true;
                    }
                    if($priority != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.priority = '".$priority."' ";
                    } else if($priority != "default" && $previous_selection_exists === false) {
                        $sql .= " b.priority = '".$priority."' ";
                        $previous_selection_exists = true;
                    }
                    if($resolution != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.resolution = '".$resolution."' ";
                    } else if($resolution != "default" && $previous_selection_exists === false) {
                        $sql .= " b.resolution = '".$resolution."' ";
                        $previous_selection_exists = true;
                    }
                    if($resolution_version != "" && $previous_selection_exists === true) {
                        $sql .= " AND b.resolution_version = '".$resolution_version."' ";
                    } else if($resolution_version != "" && $previous_selection_exists === false) {
                        $sql .= " b.resolution_version = '".$resolution_version."' ";
                        $previous_selection_exists = true;
                    }
                    if($resolved_by != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.resolved_by = '".$resolved_by."' ";
                    } else if($resolved_by != "default" && $previous_selection_exists === false) {
                        $sql .= " b.resolved_by = '".$resolved_by."' ";
                        $previous_selection_exists = true;
                    }
                    if($date_resolved != "" && $previous_selection_exists === true) {
                        $sql .= " AND b.date_resolved = '".$date_resolved."' ";
                    } else if($date_resolved != "" && $previous_selection_exists === false) {
                        $sql .= " b.date_resolved = '".$date_resolved."' ";
                        $previous_selection_exists = true;
                    }
                    if($tested_by != "default" && $previous_selection_exists === true) {
                        $sql .= " AND b.tested_by = '".$tested_by."' ";
                    } else if($tested_by != "default" && $previous_selection_exists === false) {
                        $sql .= " b.tested_by = '".$tested_by."' ";
                        $previous_selection_exists = true;
                    }
                    if($date_tested != "" && $previous_selection_exists === true) {
                        $sql .= " AND b.date_tested = '".$date_tested."' ";
                    } else if($date_tested != "" && $previous_selection_exists === false) {
                        $sql .= " b.date_tested = '".$date_tested."' ";
                        $previous_selection_exists = true;
                    }
                    $sql .= "AND is_visible = 1";
                } else {
                    $sql .= "is_visible = 1";
                }
                

                //echo $sql;
                
                $none = 0;
                $result = $conn->query($sql);

                echo "<table border=1 class='searchTable'><th>Bug Report ID</th><th>Program Name</th><th>Report Type</th><th>Severity</th><th>Summary</th><th>Is Reproducible</th><th>Problem Description</th><th>Suggested Fix</th><th>Reported By</th><th>Date Discovered</th><th>Functional Area Name</th><th>Assigned To</th><th>Status</th><th>Priority</th><th>Resolution</th><th>Resolution Version</th><th>Resolved By</th><th>Date Resolved</th><th>Tested By</th><th>Date Tested</th><th>Is Deffered</th><th>Has Attachments</th><th>Comments</th>\n";
                while($row=mysqli_fetch_row($result)) {
                    $none=1;

                    $fetched_program_id = $row[1];
                    $fetched_area_id = $row[10];
                    $sql_p = "SELECT p.program_name FROM programs AS p WHERE p.program_id = '".$fetched_program_id."' ";
                    $sql_a = "SELECT a.area_name FROM areas AS a WHERE a.area_id = '".$fetched_area_id."' ";
                    $result_p = $conn->query($sql_p);
                    $result_a = $conn->query($sql_a);
                    $row_p=mysqli_fetch_row($result_p);
                    $row_a=mysqli_fetch_row($result_a);
                    $program_name = $row_p[0];
                    $area_name = $row_a[0];

                    if($source === 'update') {
                        printf("<tr><td><a href='update_report.php?report_id=%d'>%d</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[0],$program_name,$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$area_name,$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22]);
                    }
                    if($source === 'search') {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$program_name,$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$area_name,$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22]);
                    }
                }
                echo "</table>";
                
                if($none==0) {
                    echo "<h3>No matching records found.</h3>\n";
                }
                
                $conn->close();
                
            ?>
        </h2>
        
    </body>
</html>
