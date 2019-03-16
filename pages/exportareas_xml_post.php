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
			header('Content-Disposition: attachment;filename=areas.xml');
			
			// Produce XML	
			header('Content-Type: text/xml');

			// root node
			$XML = "<result>\n";
			
			// rows
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {    
			  $XML .= "\t<row>\n"; 
			  $i = 0;
			  // cells
			  foreach ($row as $cell) {
				// Escaping illegal characters - not tested actually ;)
				$cell = str_replace("&", "&amp;", $cell);
				$cell = str_replace("<", "&lt;", $cell);
				$cell = str_replace(">", "&gt;", $cell);
				$cell = str_replace("\"", "&quot;", $cell);
				$fieldName = mysqli_fetch_field_direct($result, $i)->name;
				
				// creates the "<tag>contents</tag>" representing the column
				$XML .= "\t\t<" . $fieldName . ">" . $cell . "</" . $fieldName . ">\n";
				$i++;
			  }
			  $XML .= "\t</row>\n"; 
			}
			$XML .= "</result>\n";
			
			// output the whole XML string
			echo $XML;					
        ?>
    </body>
</html>
