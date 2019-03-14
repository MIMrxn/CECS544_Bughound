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
                    <a href="manage_functional_areas.php">Functional Areas</a>
                    <a href="manage_employees.php">Employees</a>
					<a href="manage_export.php">Exports</a>
                </div>
            </li>
            <li>
                <a href="search.php">Search</a>
            </li>
        </ul>

        <h2>
            <?php
                /*
                $search_prog_input = $_POST['search_prog_input'];
                $sql = "";
                */

                $source = $_GET['source'];
                if($source == 'edit') {
                    echo "<h2>Results for Program Information to Edit\n</h2><h3>Click on a Program Name to edit.</h3>";
                }
                if($source == 'delete') {
                    echo "<h2>Results for Program Information to Delete\n</h2><h3>Click on a Program Name to delete.</h3>";
                }
				if($source == 'search') {
                    echo "<h2>Results for Program Information\n</h2><h3></h3>";
                }

                $program_name = $_POST['program_name'];
                $program_version = $_POST['program_version'];
                $program_release = $_POST['program_release'];
                $program_release_date = $_POST['program_release_date'];

                //  NEW CODE
                $previous_selection_exists = false;
                $sql = "SELECT * FROM programs WHERE ";

                if($program_name != "") {
                    $sql .= " program_name = '".$program_name."' ";
                    $previous_selection_exists = true;
                }
                if($program_version != "" && $previous_selection_exists === true) {
                    $sql .= " AND program_version = '".$program_version."' ";
                } else if($program_version != "" && $previous_selection_exists === false) {
                    $sql .= " program_version = '".$program_version."' ";
                    $previous_selection_exists = true;
                }
                if($program_release != "" && $previous_selection_exists === true) {
                    $sql .= " AND program_release = '".$program_release."' ";
                } else if($program_release != "" && $previous_selection_exists === false) {
                    $sql .= " program_release = '".$program_release."' ";
                    $previous_selection_exists = true;
                }
                if($program_release_date != "" && $previous_selection_exists === true) {
                    $sql .= " AND program_release_date = '".$program_release_date."' ";
                } else if($program_release_date != "" && $previous_selection_exists === false) {
                    $sql .= " program_release_date = '".$program_release_date."' ";
                    $previous_selection_exists = true;
                }

                $none = 0;
                $result = $conn->query($sql);

                echo "<table border=1><th>Program Name</th><th>Program Version</th><th>Program Release </th><th>Program Release Date</th>\n";
                while($row=mysqli_fetch_row($result)) {
                    $none=1;
                    if($source == 'edit') {
                        printf("<tr><td><a href='edit_program.php?program_name=%s'>%s</a></td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0], $row[0], $row[1],$row[2],$row[3]);
                    }
                    if($source == 'delete') {
                        printf("<tr><td><a onclick='return confirm_delete();' href='delete_program.php?program_name=%s'>%s</a></td><td>%d</td><td>%d</td><td>%s</td></tr>\n",$row[0],$row[0],$row[1],$row[2],$row[3]);
                    }
                    if($source == 'search') {
                        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2],$row[3]);
                    }
                }
                echo "</table>";
                
                if($none==0) {
                    echo "<h3>No matching records found.</h3>\n";
                }

                $conn->close();
            ?>
        </h2>

        <script type="text/javascript">
            function confirm_delete() {
                return confirm("Are you sure you want to delete entry?");
            }
        </script>
    </body>
</html>
