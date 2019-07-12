<?php
require_once '../database/conn.php';
# -------------------------------------------------------
//add redirect function
require_once '../processes/redirect.php';
# -------------------------------------------------------
$fileName ='';
$sql = "SELECT * FROM siteFiles WHERE fileId = ".$_GET['file'];
$siteFiles = $DBcon->query($sql);
if($siteFiles->rowCount() == 1)
{
    $row = $siteFiles->fetch();
    $fileName = $row['fileName'];
    unlink('../storedFiles/' . $row['fileName']);
    $sql = "DELETE FROM siteFiles WHERE fileId = ".$row['fileId'];
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
    $text = "Activity type: Successful removal of " . $fileName . " file - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
    fwrite($activityLog, $text) or die("Couldn't write values to file!");
    #close file
    fclose($activityLog);
    #
}
redirect('listFiles.php');
?>
