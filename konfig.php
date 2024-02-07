<?php

	$server = "localhost";
	$user = "root";
	$pass = "";
	$dbname = "db_cafelarva";
        
	
	if (mysql_connect($server,$user,$pass)){
		//echo ":)";
		mysql_select_db($dbname) or die("database not found");
	}else{
		echo ":(";
	}
	 
?>