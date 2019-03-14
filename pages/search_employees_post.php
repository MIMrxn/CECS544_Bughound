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
                $sql = "";

                $source = $_GET['source'];
                if($source == 'edit') {
                    echo "<h2>Results for Employees to Edit\n</h2><h3>Click on employee ID number to edit.</h3>";
                }
                if($source == 'delete') {
                    echo "<h2>Results for Employees to Delete\n</h2><h3>Click on employee ID number to delete.</h3>";
                }
                if($source == 'search') {
                    echo "<h2>Results for Employees Search\n</h2>";
                }

                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $user_name = $_POST['user_name'];
                $position = $_POST['position'];
                $group_num = $_POST['group_num'];
                $is_reporter = -1;
                if(isset($_POST['is_reporter']) && $_POST['is_reporter'] == 'True') {
                    $is_reporter = 1;
                } else {
                    $is_reporter = 0;
                }
                $user_level = $_POST['user_level'];

                $previous_selection_exists = false;
                $sql = "SELECT * FROM employees WHERE ";
                if($first_name != "") {
                    $sql .= " first_name = '".$first_name."' ";
                    $previous_selection_exists = true;
                }
                if($last_name != "" && $previous_selection_exists === true) {
                    $sql .= " AND last_name = '".$last_name."' ";
                } else if($last_name != "" && $previous_selection_exists === false) {
                    $sql .= " last_name = '".$last_name."' ";
                    $previous_selection_exists = true;
                }
                if($user_name != "" && $previous_selection_exists === true) {
                    $sql .= " AND user_name = '".$user_name."' ";
                } else if($user_name != "" && $previous_selection_exists === false) {
                    $sql .= " user_name = '".$user_name."' ";
                    $previous_selection_exists = true;
                }
                if($position != "" && $previous_selection_exists === true) {
                    $sql .= " AND position = '".$position."' ";
                } else if($position != "" && $previous_selection_exists === false) {
                    $sql .= " position = '".$position."' ";
                    $previous_selection_exists = true;
                }
                if($group_num != "" && $previous_selection_exists === true) {
                    $sql .= " AND group_num = '".$group_num."' ";
                } else if($group_num != "" && $previous_selection_exists === false) {
                    $sql .= " group_num = '".$group_num."' ";
                    $previous_selection_exists = true;
                }
                if($is_reporter != "" && $previous_selection_exists === true) {
                    $sql .= " AND is_reporter = '".$is_reporter."' ";
                } else if($is_reporter != "" && $previous_selection_exists === false) {
                    $sql .= " is_reporter = '".$is_reporter."' ";
                    $previous_selection_exists = true;
                }
                if($user_level != "" && $previous_selection_exists === true) {
                    $sql .= " AND user_level = '".$user_level."' ";
                } else if($user_level != "" && $previous_selection_exists === false) {
                    $sql .= " user_level = '".$user_level."' ";
                    $previous_selection_exists = true;
                }

                $none = 0;
                $result = $conn->query($sql);

                echo "<table border=1><th>ID</th><th>First Name</th><th>Last Name</th><th>Username</th><th>Password</th><th>Position</th><th>Group Number</th><th>Is Reporter</th><th>User Level</th>\n";
                while($row=mysqli_fetch_row($result)) {
                    $none=1;
                    if($source == 'edit') {
                        printf("<tr><td><a href='edit_employee.php?emp_id=%d'>%d</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]);
                    }
                    if($source == 'delete') {
                        printf("<tr><td><a onclick='return confirm_delete(%d);' href='delete_employee.php?emp_id=%d'>%d</a></td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[0],$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]);
                    }
                    if($source == 'search') {
                        printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n",$row[0],$row[1],$row[2],$row[3],$row[4],$row[5],$row[6],$row[7],$row[8]);
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
            function confirm_delete(emp_id) {
                var str = "Are you sure you want to delete employee ".concat(emp_id, "?");
                return confirm(str);
            }
        </script>
    </body>
</html>
