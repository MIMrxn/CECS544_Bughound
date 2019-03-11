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

                $area_name = $_POST['area_name'];
                
                $conn = new mysqli($servername, $username, $password);
                mysqli_select_db($conn, "bughound_db");
                $query = "INSERT INTO areas (area_name) VALUES ('".$area_name."')";
                echo $query;
                mysqli_query($conn, $query);
                header("Location: add_functional_area.php");
                exit;
            ?>
        </h2>
    </body>
</html>
