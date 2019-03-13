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
                    <a href="update_report.php">Update</a>
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
                $search_prog_input = $_POST['search_prog_input'];
                $sql = "";
                
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

                if($search_prog_input == 'Search by Program Name') {
                    $sql = " SELECT * FROM programs WHERE program_name = '".$program_name."' ";
                } else if($search_prog_input == 'Search by Program Version') {
                    $sql = " SELECT * FROM programs WHERE program_version = '".$program_version."' ";
                } else if($search_prog_input == 'Search by Program Release') {
                    $sql = " SELECT * FROM programs WHERE program_release = '".$program_release."' ";
                } else if($search_prog_input == 'Search by Program Release Date') {
                    $sql = " SELECT * FROM programs WHERE program_release_date = '".$program_release_date."' ";
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
                        printf("<tr><td><a onclick='return confirm_delete(%s);' href='delete_program.php?program_name=%s'>%s</a></td><td>%d</td><td>%d</td><td>%s</td></tr>\n",$row[0],$row[0],$row[0],$row[1],$row[2],$row[3]);
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
            function confirm_delete(program_name) {
                var str = "Are you sure you want to delete the program ".concat(program_name, "?");
                return confirm(str);
            }
        </script>
    </body>
</html>
