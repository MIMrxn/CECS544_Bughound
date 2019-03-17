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

        <?php
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
                        <a href="javascript:void(0)" class="dropbtn">Bug Report</a>
                        <div class="dropdown-content">
                            <a href="create_report.php">Create</a>
                            <a href="search_reports.php?source=update">Update</a>
                            <a href="search_reports.php?source=search">Search</a>
                        </div>
                    </li>';
                    if($user_level == 5) {
                        echo '<li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn, active">Manage Database</a>
                        <div class="dropdown-content">
                            <a href="manage_programs.php">Programs</a>
                            <a href="manage_functional_areas.php">Functional Areas</a>
                            <a href="manage_employees.php">Employees</a>
                            <a href="manage_export.php">Exports</a>
                        </div>
                        </li>';
                        echo '<li style="float:right"><a href="logout.php">Logout</a></li>';
                        echo '<li style="float:right"><a>Welcome, '.$user_name.'</a></li>';
                    }
                } else {
                    echo '<li style="float:right"><a href="login.php">Login</a></li>';
                }
            ?>
        </ul>

        <h2>
            <?php
                $source = $_GET['source'];
                if($source == 'edit') {
                    echo "<h2>Results for Functional Areas to Edit\n</h2><h3>Click on functional area ID number to edit.</h3>";
                }
                if($source == 'delete') {
                    echo "<h2>Results for Functional Areas to Delete\n</h2><h3>Click on functional area ID number to delete.</h3>";
                }
                if($source == 'search') {
                    echo "<h2>Results for Functional Areas Search\n</h2>";
                }

                $area_name = $_POST['area_name'];
                $program_name = $_POST['program_name'];

                
                $sql = "";
                if($area_name != "" && $program_name === "") {
                    $sql .= "SELECT A.area_id, A.area_name, P.program_name, P.program_release, P.program_version FROM areas as A, programs as P WHERE A.area_name = '".$area_name."' AND A.program_id = P.program_id AND A.is_visible = 1";
                    $previous_selection_exists = true;
                } else if($area_name === "" && $program_name != "") {
                    $sql .= "SELECT A.area_id, A.area_name, P.program_name, P.program_release, P.program_version FROM areas as A, programs as P WHERE P.program_name = '".$program_name."' AND A.program_id = P.program_id AND A.is_visible = 1";
                } else if($area_name != "" && $program_name != "") {
                    $sql = "SELECT A.area_id, A.area_name, P.program_name, P.program_release, P.program_version FROM areas as A, programs as P WHERE A.area_name = '".$area_name."' AND P.program_name = '".$program_name."' AND A.program_id = P.program_id AND A.is_visible = 1";
                }

                $none = 0;
                $result = $conn->query($sql);

                echo "<table border=1><th>Area ID</th><th>Area Name</th><th>Program Name</th><th>Release</th><th>Version</th>\n";
                while($row=mysqli_fetch_row($result)) {
                    $none=1;
                    if($source == 'edit') {
                        printf("<tr><td><a href='edit_functional_area.php?area_id=%d'>%d</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[0],$row[1],$row[2],$row[3],$row[4]);
                    }
                    if($source == 'delete') {
                        printf("<tr><td><a onclick='return confirm_delete(%d);' href='delete_functional_area.php?area_id=%d'>%d</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[0],$row[0],$row[1],$row[2],$row[3],$row[4]);
                    }
                    if($source == 'search') {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2],$row[3],$row[4]);
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
            function confirm_delete(area_id) {
                var str = "Are you sure you want to delete functional area ".concat(area_id, "?");
                return confirm(str);
            }
        </script>
    </body>
</html>
