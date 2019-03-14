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
				$con = mysqli_connect("localhost","root","","bughound_db");
				
				// Check connection
				if (mysqli_connect_errno())
				{
					echo "Failed to connect to MySQL: " . mysqli_connect_error();
				}

				$sql = "SELECT * FROM employees WHERE user_name = '".$_POST['username']."' AND password = '".$_POST['password']."'";
				
				if ($result = mysqli_query($con, $sql))
				{
					// Return the number of rows in result set
					$rowcount=mysqli_num_rows($result);

					if($rowcount > 0) {
						$result_array = mysqli_fetch_array($result);
						$user_level = $result_array['user_level'];
						session_start();
						$_SESSION['user_level'] = $user_level; // pass value to main page to verify if the user is a manager level
						$_SESSION['user_name'] = $result_array['user_name'];
						echo $_SESSION['user_level'];
						echo $_SESSION['user_name'];
						header("Location: index.php");
					}
					else {
						header("Location: login.php");
					}
					  
					// Free result set
					//mysqli_free_result($result);
				}

				mysqli_close($con);
			?>
        </h2>
    </body>
</html>
