<?php
require_once '../database/conn.php';
# -------------------------------------------------------
#Start with the header
require_once '../display/header.php';
# -------------------------------------------------------
$sql = "SELECT * FROM siteFiles WHERE fileId = ".$_GET['file'];
$siteFiles = $DBcon->query($sql);
if($siteFiles->rowCount() == 1) 
{
  $row = $siteFiles->fetch();  
  #
  if( pathinfo($row['fileName'], PATHINFO_EXTENSION) == 'md')
   {  
    #
    $myfile = fopen('../storedFiles/' . $row['fileName'], "r") or die("Unable to open file " . $row['fileName']);
    #
    echo '<div id="heading">
            <h3>'.$row['title'].'</h3>
            <input type="button" value="Return to file listings" onclick="home(\'listFiles.php\');"/>
          </div>
          <div style="color: #333399; margin-left: 3%;">
            <p>Last modified on '.date("l j F Y, \@  H:i",strtotime($row['dateModified'])).'</p>
          </div> 
          <div class="fileInfo">';
    $textFromFile = '';
    while(!feof($myfile)) 
    {
      #
      $textFromFile = $textFromFile . fgets($myfile). "            <br>";
    }
    fclose($myfile);
    #
    echo $textFromFile;
    echo '
          </div>
          <br>
          <input type="button" value="Return to file listings" onclick="home(\'listFiles.php\');"/>';
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
    $text = "Activity type: View " . $row['title'] . " file - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
    fwrite($activityLog, $text) or die("Couldn't write values to file!");
    #close file
    fclose($activityLog);
  }  
}
# -------------------------------------------------------
#Add the footer to the HTML
require_once '../display/footer.php';
# -------------------------------------------------------
?>
<script>
  function home(file)
  {
      myWindow = window.open('../fileManagement/' +  file,'_self');
  } 
</script>