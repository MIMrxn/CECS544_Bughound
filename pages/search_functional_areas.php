<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
        <link rel="stylesheet" href="../assets/styles/form_style.css">
    </head>
    <body>
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
            <center>
                <?php
                    $source = $_GET['source'];
                    if($source == 'edit') {
                        echo '<font color="gray">Search for a Functional Area to Edit Entry</font>';
                    }
                    if($source == 'delete') {
                        echo '<font color="gray">Search for a Functional Area to Delete Entry</font>';
                    }
                    if($source == 'search') {
                        echo '<font color="gray">Search for a Functional Area Entry</font>';
                    }
                ?>
            </center>
        </h2>

        <form name="search_functional_areas_form" action="search_functional_areas_post.php?source=<?php echo $source; ?>" method="post" onsubmit="return validate(this)">
            <table>
                <tr>
                    <td>Area Name:</td><td><input type="Text" name="area_name" /></td>
                </tr>  
            </table>

            <input type="submit" name="search_reports_submit" value="Search"/>
            <input class="button" type="button" onclick="window.location.replace('search_functional_areas.php?source=<?php echo $source; ?>')" value="Reset" />
            <input class="button" type="button" onclick="window.location.replace('index.php')" value="Cancel" />
        </form>

        <script language=Javascript>
            function validate(theform) {
                if(theform.area_name.value === "") {
                    alert ("Area Name field must contain characters");
                    return false;
                }
                return true;
            }
        </script>
    </body>
</html>
