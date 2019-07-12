<?php
require_once '../database/conn.php';
# -------------------------------------------------------
//add redirect function
require_once '../processes/redirect.php';
# -------------------------------------------------------
try
{
  if ($_REQUEST['action'] == "Update")
  { 
    $bodyText = $_POST['bodyText'];
    #
    $file= fopen('systemActivities.txt', "w") or die('Unable to open System Log File for writing!');
    fwrite($file, $bodyText) or die("Couldn't write values to file!"); 
    fclose($file);
    redirect('viewLog.php');
  }
  else
  {
    redirect('viewLog.php'); #cancel selected - no save attempted    
  }
}
catch (Exception $e) 
{
  echo $e->getMessage();
}
# -------------------------------------------------------
require_once '../display/footer.php';
# -------------------------------------------------------
?>