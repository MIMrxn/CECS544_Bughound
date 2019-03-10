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
                
                $conn = new mysqli($servername, $username, $password);
                mysqli_select_db($conn, "bughound_db");
				
                $query = "DELETE FROM programs WHERE program_name = '$program_name' AND program_version = '$program_version'
					AND program_release = '$program_release'";
				
                echo $query;
                mysqli_query($conn, $query);
                header("Location: delete_program.php");
                exit;
            ?>
        </h2>
    </body>
</html>
