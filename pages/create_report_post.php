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

            $program_name = $_POST['program_name'];
            $report_type = $_POST['report_type'];
            
            $conn = new mysqli($servername, $username, $password);
            mysqli_select_db($conn, "bughound_db");
            $query = "INSERT INTO bugs (program_name, report_type) VALUES ('".$program_name."','".$report_type."')";
            echo $query;
            mysqli_query($conn, $query);
            header("Location: create_report.php");
            exit;
        ?>
    </body>
</html>
