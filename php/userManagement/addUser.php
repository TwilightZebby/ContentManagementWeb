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
if($_REQUEST['action'] == 'Add user')
{
    require_once '../database/conn.php';
    $firstName= $_POST['firstName']; 
    $lastName= $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $accessLevel = $_POST['accessLevel'];
    #add new article to the database
    $sql = "INSERT IGNORE INTO users VALUES (NULL,'$email','$password','$firstName','$lastName','$accessLevel')";
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
$text = "Activity type: Successful addition of " . $firstName . " " . $lastName . " user - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
fwrite($activityLog, $text) or die("Couldn't write values to file!");
#close file
fclose($activityLog);
#
redirect("listUsers.php"); 

?>