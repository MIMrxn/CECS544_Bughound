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
            	session_start();
				if(isset($_SESSION['user_name']) && isset($_SESSION['user_level'])) {
					echo '<p>Inside php block</p>';
					unset($_SESSION['user_name']);
					unset($_SESSION['user_level']);
					session_destroy();
					session_unset();
					header('Location: login.php');
					exit;
				} else {
					header('Location: login.php');
					exit;
				}
			?>
        </h2>
    </body>
</html>
