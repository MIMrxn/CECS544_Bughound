<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Bughound</title>
    </head>
    <body>
        <h2>
            <?php
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $user_name = $_POST['user_name'];
                $user_pass = $_POST['user_pass'];
                $position = $_POST['position'];
                $group_num = $_POST['group_num'];
                $is_reporter = -1;
                if(isset($_POST['is_reporter']) && $_POST['is_reporter'] == 'True') {
                    $is_reporter = 1;
                } else {
                    $is_reporter = 0;
                }
                $user_level = $_POST['user_level'];
                
                $servername = "";
                $username = "";
                $password = "";
                $conn = new mysqli($servername, $username, $password);
                mysqli_select_db($conn, "bughound_db");
                $query = "INSERT INTO employees (first_name, last_name, user_name, password, position, group_num, is_reporter, user_level) VALUES ('".$first_name."','".$last_name."','".$user_name."','".$user_pass."','".$position."','".$group_num."','".$is_reporter."','".$user_level."')";
                echo $query;
                mysqli_query($conn, $query);
                header("Location: add_employee.php");
                exit;
            ?>
        </h2>
    </body>
</html>
