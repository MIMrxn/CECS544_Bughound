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

        <h2>
            <?php
                $sql = "";
                
                $source = $_GET['source'];
                if($source == 'update') {
                    echo "<h2>Results for Reports to Update\n</h2><h3>Click on report ID number to update.</h3>";
                }
                if($source == 'search') {
                    echo "<h2>Results for Reports Search\n</h2>";
                }

                $program_name = $_POST['program_name'];
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
                $functional_area_name = $_POST['functional_area_name'];
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

                $previous_selection_exists = false;
                $sql = "SELECT * FROM bugs WHERE ";
                if($program_name != "default") {
                    $sql .= " program_name = '".$program_name."' ";
                    $previous_selection_exists = true;
                }
                if($report_type != "default" && $previous_selection_exists === true) {
                    $sql .= " AND report_type = '".$report_type."' ";
                } else if($report_type != "default" && $previous_selection_exists === false) {
                    $sql .= " report_type = '".$report_type."' ";
                    $previous_selection_exists = true;
                }
                if($severity != "default" && $previous_selection_exists === true) {
                    $sql .= " AND severity = '".$severity."' ";
                } else if($severity != "default" && $previous_selection_exists === false) {
                    $sql .= " severity = '".$severity."' ";
                    $previous_selection_exists = true;
                }
                if($reported_by != "default" && $previous_selection_exists === true) {
                    $sql .= " AND reported_by = '".$reported_by."' ";
                } else if($reported_by != "default" && $previous_selection_exists === false) {
                    $sql .= " reported_by = '".$reported_by."' ";
                    $previous_selection_exists = true;
                }
                if($date_discovered != "" && $previous_selection_exists === true) {
                    $sql .= " AND date_discovered = '".$date_discovered."' ";
                } else if($date_discovered != "" && $previous_selection_exists === false) {
                    $sql .= " date_discovered = '".$date_discovered."' ";
                    $previous_selection_exists = true;
                }
                if($functional_area_name != "default" && $previous_selection_exists === true) {
                    $sql .= " AND functional_area_name = '".$functional_area_name."' ";
                } else if($functional_area_name != "default" && $previous_selection_exists === false) {
                    $sql .= " functional_area_name = '".$functional_area_name."' ";
                    $previous_selection_exists = true;
                }
                if($assigned_to != "default" && $previous_selection_exists === true) {
                    $sql .= " AND assigned_to = '".$assigned_to."' ";
                } else if($assigned_to != "default" && $previous_selection_exists === false) {
                    $sql .= " assigned_to = '".$assigned_to."' ";
                    $previous_selection_exists = true;
                }
                if($status != "default" && $previous_selection_exists === true) {
                    $sql .= " AND status = '".$status."' ";
                } else if($status != "default" && $previous_selection_exists === false) {
                    $sql .= " status = '".$status."' ";
                    $previous_selection_exists = true;
                }
                if($priority != "default" && $previous_selection_exists === true) {
                    $sql .= " AND priority = '".$priority."' ";
                } else if($priority != "default" && $previous_selection_exists === false) {
                    $sql .= " priority = '".$priority."' ";
                    $previous_selection_exists = true;
                }
                if($resolution != "default" && $previous_selection_exists === true) {
                    $sql .= " AND resolution = '".$resolution."' ";
                } else if($resolution != "default" && $previous_selection_exists === false) {
                    $sql .= " resolution = '".$resolution."' ";
                    $previous_selection_exists = true;
                }
                if($resolution_version != "" && $previous_selection_exists === true) {
                    $sql .= " AND resolution_version = '".$resolution_version."' ";
                } else if($resolution_version != "" && $previous_selection_exists === false) {
                    $sql .= " resolution_version = '".$resolution_version."' ";
                    $previous_selection_exists = true;
                }
                if($resolved_by != "default" && $previous_selection_exists === true) {
                    $sql .= " AND resolved_by = '".$resolved_by."' ";
                } else if($resolved_by != "default" && $previous_selection_exists === false) {
                    $sql .= " resolved_by = '".$resolved_by."' ";
                    $previous_selection_exists = true;
                }
                if($date_resolved != "" && $previous_selection_exists === true) {
                    $sql .= " AND date_resolved = '".$date_resolved."' ";
                } else if($date_resolved != "" && $previous_selection_exists === false) {
                    $sql .= " date_resolved = '".$date_resolved."' ";
                    $previous_selection_exists = true;
                }
                if($tested_by != "default" && $previous_selection_exists === true) {
                    $sql .= " AND tested_by = '".$tested_by."' ";
                } else if($tested_by != "default" && $previous_selection_exists === false) {
                    $sql .= " tested_by = '".$tested_by."' ";
                    $previous_selection_exists = true;
                }
                if($date_tested != "" && $previous_selection_exists === true) {
                    $sql .= " AND date_tested = '".$date_tested."' ";
                } else if($date_tested != "" && $previous_selection_exists === false) {
                    $sql .= " date_tested = '".$date_tested."' ";
                    $previous_selection_exists = true;
                }
                
                //echo $sql;

                $none = 0;
                $result = $conn->query($sql);

                echo "<table border=1><th>Bug Report ID</th><th>Program Name</th><th>Report Type</th><th>Severity</th><th>Has Attachments</th><th>Summary</th><th>Is Reproducible</th><th>Problem Description</th><th>Suggested Fix</th><th>Reported By</th><th>Date Discovered</th><th>Functional Area Name</th><th>Assigned To</th><th>Comments</th><th>Status</th><th>Priority</th><th>Resolution</th><th>Resolution Version</th><th>Resolved By</th><th>Date Resolved</th><th>Tested By</th><th>Date Tested</th><th>Is Deffered</th>\n";
                while($row=mysqli_fetch_row($result)) {
                    $none=1;
                    if($source === 'update') {
                        printf("<tr><td><a href='update_report.php?report_id=%d'>%d</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22]);
                    }
                    if($source === 'search') {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[13],$row[14],$row[15],$row[16],$row[17],$row[18],$row[19],$row[20],$row[21],$row[22]);
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
