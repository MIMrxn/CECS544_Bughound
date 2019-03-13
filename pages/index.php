<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css">
    </head>
    <body>
        <ul>
            <li><a class="active" href="index.php">Home</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Bug Report</a>
                <div class="dropdown-content">
                    <a href="create_report.php">Create</a>
                    <a href="search_reports.php?source=update">Update</a>
                    <a href="search_reports.php?source=search">Search</a>
                </div>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Manage Database</a>
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
            <li style="float:right"><a href="register.php">Register</a></li>
            <li style="float:right"><a href="login.php">Login</a></li>
        </ul>

        <h2><center><font color="gray">Bughound Bug Tracking Software</font></center></h2>

        <!--<h1><center><font color="red">[BUGHOUND IMAGE(S)]</font></center></h1>-->
		<center><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT4tu9rcX0Uvi_eOogWxdmGv19emgAwjOzeMVADIo7qwo86BA_K" width="250" height="210" title="Bughound Logo"/></center>

        <p align="center">
            <b>About:</b> Bughound is a web-based bug recording and tracking software product
        </p>
        <p>
            <b>Key Features:</b>
            <ol>
                <li>Using web browser, create, edit and update “bug” reports on multiple products</li>
                <li>Store error report content in relational tables</li>
                <li>Access error report content via SQL</li>
                <li>Search for bugs on multiple fields</li>
                <li>Facilities to add, delete or update information on program, releases, functional areas, employees</li>
            </ol>
        </p>
    </body>
</html>
