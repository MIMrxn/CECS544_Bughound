<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "bughound_db";

	ini_set('date.timezone', 'America/Los_Angeles');
	$t=time();
	$date = date("Y-m-d H:i:s",$t);
	echo "Generation Time: ";
	echo date('m/d/Y h:i:s a', strtotime($date));
	echo "\n\n";

	// Get all results from table
	$SQL_query = "SELECT * FROM programs";
	
	// Check connection to DB
	$DB_link = mysqli_connect($servername, $username, $password) or die("Could not connect to host.");
	mysqli_select_db($DB_link, $database) or die ("Could not find or access the database.");
	$result = mysqli_query ($DB_link, $SQL_query) or die ("Data not found. Your SQL query didn't work... ");
	
	// Prompt XML file download
	header('Content-Disposition: attachment;filename=programs.xml');
	
	// Produce XML	
	header('Content-Type: text/xml');

	// iterate over each table and return the create table script
	$output = "\t<database name=\"bughound_db\">\n"; 
	$result_fld = mysqli_query($DB_link, "SHOW CREATE TABLE programs"); 
	$output .= "\t\t<table name=\"bugs\"\n";

    while( $row1 = mysqli_fetch_row($result_fld) ) {
	   $output .= "\t\t \"$row1[1]\"\n";
    } 

    $output .= "\t\t</table>\n"; 
	$output .= "\t</database>\n\n"; 
	
	// print out XML that describes the schema
	echo $output;

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
