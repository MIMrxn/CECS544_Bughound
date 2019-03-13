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

            $report_id = $_GET['report_id'];
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
            $treat_deferred = -1;
            if(isset($_POST['treat_deferred']) && $_POST['treat_deferred'] === "checked") {
                $treat_deferred = 1;
            } else {
                $treat_deferred = 0;
            }
            /*
            if($_POST['attachments'] == "") {
                $has_attachments = 0;
            } else {
                $has_attachments = 1;
            }
            */
            $comments = $_POST['comments'];
            
            $query = "UPDATE bugs SET program_name = '".$program_name."', report_type = '".$report_type."', severity = '".$severity."', summary = '".$summary."', reproducible = '".$reproducible."', problem_description = '".$problem_description."', suggested_fix = '".$suggested_fix."', reported_by = '".$reported_by."', date_discovered = '".$date_discovered."', functional_area_name = '".$functional_area_name."', assigned_to = '".$assigned_to."', status = '".$status."', priority = '".$priority."', resolution = '".$resolution."', resolution_version = '".$resolution_version."', resolved_by = '".$resolved_by."', date_resolved = '".$date_resolved."', tested_by = '".$tested_by."', date_tested = '".$date_tested."', treat_deferred = '".$treat_deferred."' WHERE report_num = '".$report_id."'";
            //echo $query;
            mysqli_query($conn, $query);
            $conn->close();
            header("Location: index.php");
            exit;
            
        ?>
    </body>
</html>
