<?php
#--------------------------------------------------------------------
# function that redirects the page to that given as the argument $url
#--------------------------------------------------------------------
function redirect($url) 
{
    if (!headers_sent()) 
    {
        header('Location: http://' . $_SERVER['HTTP_HOST'] .
        dirname($_SERVER['PHP_SELF']) . '/' . $url);
    } 
    else 
    {
        die('Could not redirect; Headers already sent (output).');
    } 
}
#----------------------------------------------------------------
#remove user from the database
require_once '../database/conn.php';#
$userId = $_GET['user'];
$sql = "DELETE FROM users WHERE userId = ".$userId;
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
$text = "Activity type: Successful removal of user " . $userId . " - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
fwrite($activityLog, $text) or die("Couldn't write values to file!");
#close file
fclose($activityLog);
#
redirect("listUsers.php"); 

?>