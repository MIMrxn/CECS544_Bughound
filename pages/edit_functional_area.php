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
