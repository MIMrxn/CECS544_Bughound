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
            $area_name = $_POST['area_name'];
            
            /*
            $query = "UPDATE areas SET area_name = '".$area_name."' WHERE area_id = '".$area_id."'";
            echo $query;
            mysqli_query($conn, $query);
            */

            $stmt = $conn->prepare("UPDATE areas SET area_name = ? WHERE area_id = ?");
            $stmt->bind_param("si", $area_name, $area_id);
            $stmt->execute();

            $stmt->close();
            $conn->close();
            
            header("Location: manage_functional_areas.php");
            exit;
        ?>
    </body>
</html>
