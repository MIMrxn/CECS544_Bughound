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

            $program_name = $_POST['program_name'];
            $program_version = $_POST['program_version'];
            $program_release = $_POST['program_release'];
            $program_release_date = $_POST['program_release_date'];
            
            $query = "UPDATE programs SET program_name = '".$program_name."', program_version = '".$program_version."', 
			program_release = '".$program_release."', program_release_date = '".$program_release_date."' WHERE program_name = '".$program_name."'";
            echo $query;
            mysqli_query($conn, $query);
            $conn->close();
            header("Location: manage_programs.php");
            exit;
        ?>
    </body>
</html>
