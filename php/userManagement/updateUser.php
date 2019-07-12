<?php
session_start();
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
if($_REQUEST['action'] =='Update user')
{
  #--------------------------------------------------------------------
  # GRAB THE ENTERED DETAILS FROM updateUserForm.php
  #--------------------------------------------------------------------
  require_once '../database/conn.php';
  $firstName= $_POST['firstName']; 
  $lastName= $_POST['lastName'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $accessLevel = $_POST['accessLevel'];

  $userId = $_GET['user'];

  #--------------------------------------------------------------------
  # PUSH THE CHANGED DETAILS TO BE SAVED IN THE USER DATABASE
  #--------------------------------------------------------------------
  $sql = "UPDATE users ".
      "SET firstName ='" . $firstName."', 
      lastName ='" .$lastName."', 
      email ='". $email."', 
      password ='". $password."', 
      accessLevel ='". $accessLevel."' 
      WHERE userId = ".$userId; 

  $DBcon->exec($sql);
}
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
$text = "Activity type: Successful update of user " . $userId . " - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
fwrite($activityLog, $text) or die("Couldn't write values to file!");
#close file
fclose($activityLog);
#
//automatically return to the main page
redirect("listUsers.php");
?>