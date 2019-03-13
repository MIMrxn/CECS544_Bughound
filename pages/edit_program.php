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

            $program_name = $_GET['program_name'];

			
            $sql = "SELECT * FROM programs WHERE program_name = '$program_name'";

            $result = $conn->query($sql);
            $row = mysqli_fetch_row($result);
            $program_name = $row[0];
            $program_version = $row[1];
            $program_release = $row[2];
            $program_release_date = $row[3];
            
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
                    <a href="manage_functional_areas.php">Functional Areas</a>
                    <a href="manage_employees.php">Employees</a>
					<a href="manage_export.php">Exports</a>
                </div>
            </li>
            <li>
                <a href="search.php">Search</a>
            </li>
        </ul>

        <h2><center><font color="gray">Edit a Program Entry</font></center></h2>

        <form name="edit_search_programs_form" action="edit_program_post.php?program_name=<?php echo $program_name; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr><td>Program Name:</td><td><input type="Text" name="program_name" value="<?php echo $program_name; ?>" /></td></tr>
                <tr><td>Program Version:</td><td><input type="Number" name="program_version" value="<?php echo $program_version; ?>" /></td></tr>
                <tr><td>Program Release:</td><td><input type="Number" name="program_release" value="<?php echo $program_release; ?>" /></td></tr>
                <tr><td>Program Release Date:</td><td><input type="Date" name="program_release_date" value="<?php echo $program_release_date; ?>" /></td></tr>
                  
            </table>
            <input type="submit" name="submit" value="Edit" />
            <input class="button" type="button" onclick="window.location.replace('manage_programs.php')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.program_name.value === ""){
                    alert ("Program name field must contain characters");
                    return false;
                }
                if(theform.program_version.value === ""){
                    alert ("Program version field must contain characters");
                    return false;
                }
                if(theform.program_release.value === ""){
                    alert ("Program release field must contain characters");
                    return false;
                }
                if(theform.program_release_date.value === ""){
                    alert ("Program release date field must contain characters");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
