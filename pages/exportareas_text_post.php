<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Bughound</title>
        <link rel="stylesheet" href="../assets/styles/nav_menu_style.css/"/>
        <link rel="stylesheet" href="../assets/styles/vertical_menu_style.css"/>
        <link rel="stylesheet" href="../assets/styles/form_style.css"/>
    </head>
    <body>
        <?php
			$servername = "localhost";
            $username = "root";
            $password = "";
			$database = "bughound_db";
		
			// Get all results from table
			$SQL_query = "SELECT * FROM areas";
			
			// Check connection to DB
			$DB_link = mysqli_connect($servername, $username, $password) or die("Could not connect to host.");
			mysqli_select_db($DB_link, $database) or die ("Could not find or access the database.");
			$result = mysqli_query ($DB_link, $SQL_query) or die ("Data not found. Your SQL query didn't work... ");
			
			// Prompt XML file download
			header('Content-Disposition: attachment;filename=areas.txt');
			
			// Produce XML	
			header('Content-Type: text/plain');

			$count = mysqli_num_rows($result);
			$fields= mysqli_num_fields($result);
			$data = "";
			
			for ($i=0; $i < $fields; $i++) {
				$field = mysqli_fetch_field($result);
				$data .= $field->name;
				$data .= "\t";
			}
			$data .= "\n";
			
			while ($row=mysqli_fetch_row($result)) {
				$data .= "\t\t";
				for($x=0; $x < $fields; $x++) {
					$field->name=$row[$x];
					$data .= $field->name = $row[$x];
					$data .= "\t";
				}
				$data .= "\n";
			}
			echo $data;
        ?>
    </body>
</html>
