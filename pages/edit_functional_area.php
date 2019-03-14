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

            $area_id = $_GET['area_id'];

            $sql = "SELECT * FROM areas WHERE area_id = $area_id";

            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            $area_name = $row[1];
            
            $conn->close();
        ?>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn, active">Bug Report</a>
                <div class="dropdown-content">
                    <a href="create_report.php">Create</a>
                    <?php
                        // See if user that logged in is of manager level (user level of 5)
                        session_start();
                        $user_level = $_SESSION['user_level'];
                        
                        if($user_level == 5) {
                            echo '<a href="search_reports.php?source=update">Update</a>';
                        }
                    ?>
                    <a href="search_reports.php?source=search">Search</a>
                </div>
            </li>
            <?php
                // See if user that logged in is of manager level (user level of 5)
                $user_level = $_SESSION['user_level'];
                
                if($user_level == 5) {
                    echo '<li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn">Manage Database</a>
                    <div class="dropdown-content">
                        <a href="manage_programs.php">Programs</a>
                        <a href="manage_functional_areas.php">Functional Areas</a>
                        <a href="manage_employees.php">Employees</a>
                        <a href="manage_export.php">Exports</a>
                    </div>
                    </li>';
                }
            ?>
        </ul>

        <h2><center><font color="gray">Edit a Functional Area Entry</font></center></h2>

        <form name="add_functional_area_form" action="edit_functional_area_post.php?area_id=<?php echo $area_id; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Area Name:</td><td><input type="Text" name="area_name" value="<?php echo $area_name; ?>" /></td></tr>    
            </table>
            <input type="submit" name="submit" value="Edit" />
            <input class="button" type="button" onclick="window.location.replace('manage_functional_areas.php')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.area_name.value === ""){
                    alert ("Area Name field must contain characters");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
