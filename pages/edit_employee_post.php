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
            $servername = "";
            $username = "";
            $password = "";
            $conn = new mysqli($servername, $username, $password);
            mysqli_select_db($conn, "bughound_db");

            $emp_id = $_GET['emp_id'];
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
            
            $query = "UPDATE employees SET first_name = '".$first_name."', last_name = '".$last_name."', user_name = '".$user_name."', password = '".$user_pass."', position = '".$position."', group_num = '".$group_num."', is_reporter = '".$is_reporter."', user_level = '".$user_level."' WHERE employee_id = '".$emp_id."'";
            echo $query;
            mysqli_query($conn, $query);
            $conn->close();
            header("Location: manage_employees.php");
            exit;
        ?>
    </body>
</html>
