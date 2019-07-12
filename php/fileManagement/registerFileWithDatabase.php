<?php
require_once '../database/conn.php';
# -------------------------------------------------------
//add redirect function
require_once '../processes/redirect.php';
# -------------------------------------------------------
#get the data from form
$title= $_POST['title'];
$fileName = $_POST['fileName'];
ini_set('date.timezone', 'Europe/London');
$date = date("Y-m-d H:i:s",time());

$sql = "INSERT IGNORE INTO siteFiles VALUES (NULL, '$date', '$title', '$fileName')";
$DBcon->exec($sql);

#
/**************************************************
* FOR LOGGING ACTIVITY
**************************************************/
ini_set('date.timezone', 'Europe/London');
$dated = date("l j F Y, H:i:s",time());
#open error file
$activityLog = fopen("../logActivities/systemActivities.txt" , "a") or die("Couldn't open systemActivities.txt for writing!");
#
#append error details
$text = "Activity type: Successful upload of " . $fileName . " file - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
fwrite($activityLog, $text) or die("Couldn't write values to file!");
#close file
fclose($activityLog);
#

redirect('listFiles.php');
?>