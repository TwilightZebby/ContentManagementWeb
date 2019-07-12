<?php
require_once '../database/conn.php';
# -------------------------------------------------------
require_once '../display/header.php';
# -------------------------------------------------------
$sql = "SELECT * FROM siteFiles WHERE fileId = ".$_GET['file'];

$myfile = fopen('systemActivities.txt', "r") or die("Unable to open Log File");
#
echo '<div id="heading">
        <h3>Log File <button onclick="window.location.href = \'editLog.php\';">Edit</button></h3>
        <a href="#bottom">Go to bottom of page</a>
      </div>
      <br>
      <div class="fileInfo" style="border: 1px solid black;">';
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
      <a href="#top">Go to top of page</a>';

# -------------------------------------------------------
require_once '../display/footer.php';
# -------------------------------------------------------
?>