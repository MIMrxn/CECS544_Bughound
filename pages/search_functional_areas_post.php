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
                $search_functional_areas_input = $_POST['search_functional_areas_input'];
                $sql = "";
                
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

                if($search_functional_areas_input == 'Search by Area Name') {
                    $sql = " SELECT * FROM areas WHERE area_name = '".$area_name."' ";
                }

                $none = 0;
                $result = $conn->query($sql);

                echo "<table border=1><th>ID</th><th>Area Name</th>\n";
                while($row=mysqli_fetch_row($result)) {
                    $none=1;
                    if($source == 'edit') {
                        printf("<tr><td><a href='edit_functional_area.php?area_id=%d'>%d</a></td><td>%s</td></tr>\n",$row[0],$row[0],$row[1]);
                    }
                    if($source == 'delete') {
                        printf("<tr><td><a onclick='return confirm_delete(%d);' href='delete_functional_area.php?area_id=%d'>%d</a></td><td>%s</td></tr>\n",$row[0],$row[0],$row[0],$row[1]);
                    }
                    if($source == 'search') {
                        printf("<tr><td>%d</td><td>%s</td></tr>\n",$row[0],$row[1]);
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
