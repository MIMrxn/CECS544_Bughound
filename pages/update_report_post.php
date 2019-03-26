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

            $program_id = $_POST['program_id'];
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

            //  OPTIONAL

            if($area_id === "default") {
                $area_id = NULL;
            }
            if($assigned_to === "default") {
                $assigned_to = NULL;
            }
            if($status === "default") {
                $status = NULL;
            }
			else if($status === "closed") {
				$is_visible = 0;
			}
			
            if($priority === "default") {
                $priority = NULL;
            }
            if($resolution === "default") {
                $resolution = NULL;
            }
            if($resolution_version === "default") {
                $resolution_version = NULL;
            }
            if($resolved_by === "default") {
                $resolved_by = NULL;
            }
            if($date_resolved === "") {
                $date_resolved = NULL;
            }
            if($tested_by === "default") {
                $tested_by = NULL;
            }
            if($date_tested === "") {
                $date_tested = NULL;
            }

            $stmt = $conn->prepare("UPDATE bugs SET program_id = ?, report_type = ?, severity = ?, summary = ?, reproducible = ?, problem_description = ?, suggested_fix = ?, reported_by = ?, date_discovered = ?, area_id = ?, assigned_to = ?, status = ?, priority = ?, resolution = ?, resolution_version = ?, resolved_by = ?, date_resolved = ?, tested_by = ?, date_tested = ?, treat_deferred = ?, has_attachments = ?, comments = ?, is_visible = ? WHERE report_id = ?");
            $stmt->bind_param("isissssisiisisiisissssii", $program_id, $report_type, $severity, $summary, $reproducible, $problem_description, $suggested_fix, $reported_by, $date_discovered, $area_id, $assigned_to, $status, $priority, $resolution, $resolution_version, $resolved_by, $date_resolved, $tested_by, $date_tested, $treat_deferred, $has_attachments, $comments, $is_visible, $report_id);
            $stmt->execute();
			
			/**
			if($status === "closed") {
				$stmt = $conn->prepare("UPDATE bugs SET is_visible = 0, WHERE report_id = ?");
				$stmt->bind_param("i", $program_id);
				$stmt->execute();
				$stmt->close();
            }	
			*/			
			
            $stmt->close();
            $conn->close();
			

			
            header("Location: index.php");
            exit;
            
        ?>
    </body>
</html>
