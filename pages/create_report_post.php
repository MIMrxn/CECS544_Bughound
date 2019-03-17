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

            $program_name = $_POST['program_name'];
            $report_type = $_POST['report_type'];
            $severity = $_POST['severity'];
            $summary = $_POST['summary'];
            if(isset($_POST['reproducible']) && $_POST['reproducible'] === "checked") {
                $reproducible = 1;
            } else {
                $reproducible = 0;
            }
            $problem_description = $_POST['problem_description'];
            $suggested_fix = $_POST['suggested_fix'];
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
            if(isset($_POST['treat_deferred']) && $_POST['treat_deferred'] === "checked") {
                $treat_deferred = 1;
            } else {
                $treat_deferred = 0;
            }
            if($_POST['attachments'] == "") {
                $has_attachments = 0;
            } else {
                $has_attachments = 1;
            }
            $comments = $_POST['comments'];

            $conn = new mysqli($servername, $username, $password);
            mysqli_select_db($conn, "bughound_db");
            $query = "INSERT INTO bugs (program_name, report_type, severity, summary, reproducible, problem_description, suggested_fix, reported_by, date_discovered, functional_area_name, assigned_to, status, priority, resolution, resolution_version, resolved_by, date_resolved, tested_by, date_tested, treat_deferred, has_attachments, comments) VALUES ('".$program_name."','".$report_type."','".$severity."','".$summary."','".$reproducible."','".$problem_description."','".$suggested_fix."','".$reported_by."','".$date_discovered."','".$functional_area_name."','".$assigned_to."','".$status."','".$priority."','".$resolution."','".$resolution_version."','".$resolved_by."','".$date_resolved."','".$tested_by."','".$date_tested."','".$treat_deferred."','".$has_attachments."','".$comments."')";
            echo $query;
            mysqli_query($conn, $query);
            header("Location: index.php");
            exit;
        ?>
    </body>
</html>
