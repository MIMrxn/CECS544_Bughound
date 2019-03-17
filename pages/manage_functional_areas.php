<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/vertical_menu_style.css">
    </head>
    <body>
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

        <h2><center><font color="gray">Functional Area Management Options</font></center></h2>

        <div class="vertical-menu">
            <a href="add_functional_area.php" onclick="return check_programs_exist();">Add a new functional area</a>
            <a href="search_functional_areas.php?source=edit">Edit a functional area's information</a>
            <a href="search_functional_areas.php?source=delete">Delete a functional area</a>
            <a href="search_functional_areas.php?source=search">Search for a functional area</a>  
        </div>

        <script language=Javascript>
            function check_programs_exist() {
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $conn = new mysqli($servername, $username, $password);
                    mysqli_select_db($conn, "bughound_db");

                    $sql = "SELECT * FROM programs";
                    $result = $conn->query($sql);
                    $none = 0;
                    while($row=$result->fetch_assoc()) {
                        $none = 1;
                    }
                    
                    if($none === 0) {
                        echo "alert('No programs to add area to.'); return false;";
                    }
                ?>
            }
        </script>
    </body>
</html>
