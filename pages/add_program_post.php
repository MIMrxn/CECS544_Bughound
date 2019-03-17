<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
    </head>
    <body>
        <h2>
            <!-- ADD YOUR DB INFO HERE -->
            <?php
                $servername = "localhost";
                $username = "root";
                $password = "";

                $program_name = $_POST['program_name'];
                $program_version = $_POST['program_version'];
                $program_release = $_POST['program_release'];
                $program_release_date = $_POST['program_release_date'];
                
                $conn = new mysqli($servername, $username, $password);
                mysqli_select_db($conn, "bughound_db");
				
                $query = "INSERT INTO programs (program_name, program_version, program_release, program_release_date) VALUES ('".$program_name."','".$program_version."','".$program_release."','".$program_release_date."')";
				
                //echo $query;
                mysqli_query($conn, $query);
                header("Location: index.php");
                exit;
            ?>
        </h2>
    </body>
</html>
