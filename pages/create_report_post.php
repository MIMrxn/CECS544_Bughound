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
			
			if(isset($_FILES)){
				$has_attachments = 1;
				$target_dir = "C:/xampp/htdocs/CECS544_Bughound/uploads/"; // change this directory to whatever you want the file to be saved on 
				$target_file = $target_dir . basename($_FILES["attachments"]["name"]); // file name
				$uploadOk = 1;
				$file_name = basename($_FILES["attachments"]["name"]);
				$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // file type
				
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "Sorry, file already exists.";
					$uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
					if (move_uploaded_file($_FILES["attachments"]["tmp_name"], $target_file)) {
						echo "The file ". basename( $_FILES["attachments"]["name"]). " has been uploaded.";
					} else {
						echo "Sorry, there was an error uploading your file.";
					}
				}		
				
				//$report_id = _POST['report_id'];
				
				$conn = new mysqli($servername, $username, $password);
				mysqli_select_db($conn, "bughound_db");
				$stmt = $conn->prepare("INSERT INTO attachments (file_name, file_type) VALUES (?, ?)");
				$stmt->bind_param("ss", $file_name, $fileType);
				$stmt->execute();
			}
			else {
				$has_attachments = 0;
			}
			
			
            $comments = $_POST['comments'];

            if($area_id === "default") {
                $area_id = NULL;
            }
            if($assigned_to === "default") {
                $assigned_to = NULL;
            }
            if($status === "default") {
                $status = NULL;
				$is_visible = 1;
            }else if($status === "closed") {
				$is_visible = 0;
			}
			else {
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

            $conn = new mysqli($servername, $username, $password);
            mysqli_select_db($conn, "bughound_db");
            $stmt = $conn->prepare("INSERT INTO bugs (program_id, report_type, severity, summary, reproducible, problem_description, suggested_fix, reported_by, date_discovered, area_id, assigned_to, status, priority, resolution, resolution_version, resolved_by, date_resolved, tested_by, date_tested, treat_deferred, has_attachments, comments, is_visible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isissssisiisisiisissssi", $program_id, $report_type, $severity, $summary, $reproducible, $problem_description, $suggested_fix, $reported_by, $date_discovered, $area_id, $assigned_to, $status, $priority, $resolution, $resolution_version, $resolved_by, $date_resolved, $tested_by, $date_tested, $treat_deferred, $has_attachments, $comments, $is_visible);
            $stmt->execute();
            
            $stmt->close();
            $conn->close();
            
            header("Location: index.php");
            exit;
        ?>
    </body>
</html>
