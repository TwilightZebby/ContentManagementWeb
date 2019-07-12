<?php
#loads the data and calls the html for the log-in page
session_start();
#Grabs the two php scripts to create and fill database tables
require_once '../database/createTables.php';
#
require_once '../database/populateTables.php';
#echo "<br>initialise complete<br>";

require_once '../display/header.php';	
		if (!isset($_SESSION['userId'])) 
		{
			echo '<span style="margin-left: 30px;">
        <a href="../other/logIn.php">Login</a>';
		}	
?>

<script>
  var expireDate = new Date();
  var oneYear = 365*24*60*60*1000;
  expireDate.setTime(expireDate.getTime() + oneYear);
  var expires = "expires="+ expireDate.toUTCString();
  // document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  document.cookie = "innerHeight=" + window.innerHeight + ";" +expires + ";path=/";
  document.cookie = "outerHeight=" + window.outerHeight + ";" +expires + ";path=/";
</script>
