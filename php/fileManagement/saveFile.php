<?php
require_once '../database/conn.php';
# -------------------------------------------------------
//add redirect function
require_once '../processes/redirect.php';
# -------------------------------------------------------
try
{
  if ($_REQUEST['action'] == "Update file")
  { 
    $title = $_POST['title'];
    $bodyText = $_POST['bodyText'];
    $fileName= $_GET['name'];
    $fileId = $_GET['file'];
    if ($title)
    {
      #
      $file= fopen('../storedFiles/' . $fileName , "w") or die('Unable to open file ../storedFiles/' . $fileName . "for writing!");
      fwrite($file, $bodyText) or die("Couldn't write values to file!"); 
      fclose($file);
      ini_set('date.timezone', 'Europe/London');
      $date = date("Y-m-d H:i:s",time());
      $sql = "UPDATE siteFiles SET dateModified='" . $date . "', title ='" .$title."' WHERE fileId = ".$fileId;
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
      $text = "Activity type: Successful edit of " . $title . " file - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
      fwrite($activityLog, $text) or die("Couldn't write values to file!");
      #close file
      fclose($activityLog);
      #
      redirect('listFiles.php');
    }
  }
  else
  {
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
    $text = "Activity type: Failed to edit " . $title . " file - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
    fwrite($activityLog, $text) or die("Couldn't write values to file!");
    #close file
    fclose($activityLog);
    #
    redirect('listFiles.php'); #cancel selected - no save attempted    
  }
}
catch (Exception $e) 
{
  echo $e->getMessage();
}
?>