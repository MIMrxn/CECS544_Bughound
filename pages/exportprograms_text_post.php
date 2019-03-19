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
	header('Content-Disposition: attachment;filename=programs.txt');
	
	// Produce XML	
	header('Content-Type: text/plain');

	// iterate over each table and return the create table script
	$output = "database name=bughound_db \n\n"; 
	$result_fld = mysqli_query($DB_link, "SHOW CREATE TABLE programs"); 
	$output .= "table name=programs \n\n";

	while( $row1 = mysqli_fetch_row($result_fld) ) {
	   $output .= "\"$row1[1]\"\n\n";
	} 
	
	// print out XML that describes the schema
	echo $output;

	$count = mysqli_num_rows($result);
	$fields= mysqli_num_fields($result);
	$data = "";
	
	for ($i=0; $i < $fields; $i++) {
		$field = mysqli_fetch_field($result);
		$data .= $field->name;
		$data .= "\t";
	}
	$data .= "\n\n";
	
	while ($row=mysqli_fetch_row($result)) {
		for($x=0; $x < $fields; $x++) {
			$field->name=$row[$x];
			$data .= $field->name = $row[$x];
			$data .= "\t";
		}
		$data .= "\n";
	}
	echo $data;
?>
