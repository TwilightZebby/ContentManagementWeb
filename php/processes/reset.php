<?php
# -------------------------------------------------------
//add redirect function
require_once 'redirect.php';
# -------------------------------------------------------
require_once '../database/createTables.php';
require_once '../database/populateTables.php';
# -------------------------------------------------------
##empty CSSFiles Folder of .txt files
$files = glob('../storedFiles/*.md'); //get all .txt file names
foreach($files as $file)
{
    if(is_file($file))
    {
       unlink($file); //delete file
    }
}
# -------------------------------------------------------
# copy files from back-up into the storedFiles folder
$files = glob('../backupFiles/*.md'); //get all .txt file names
foreach($files as $file)
{
    if(is_file($file))
    {
      #basename($file).PHP_EOL; script finds the filename
      $destination =  "../storedFiles/" . basename($file).PHP_EOL; #where the file is to go
      $source =  $file; #this is where the file is currently stored     
      shell_exec("cp -r $source $destination"); # carry out the copy/paste process
    }
}
# -------------------------------------------------------
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
$text = "Activity type: Successful reset of file database - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
fwrite($activityLog, $text) or die("Couldn't write values to file!");
#close file
fclose($activityLog);
#
redirect('../fileManagement/listFiles.php');
?>