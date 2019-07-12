<?php
require_once '../database/conn.php';
# -------------------------------------------------------
require_once '../display/header.php';
# -------------------------------------------------------
$myfile = fopen('systemActivities.txt', "r") or die("Unable to open System Log File");
// Output one line until end-of-file
$textFromFile = '';
while(!feof($myfile)) 
{
  $textFromFile = $textFromFile . fgets($myfile);
}
fclose($myfile);
//output file contents to the page as a text area that can be changed
echo '
<form method="post" action="saveLog.php">
  <h2>Update System Log File</h2>
  <textarea class="fileInfo" name="bodyText" rows="30" cols="84">'.$textFromFile.'</textarea></p>
  <input type="Submit" name="action" value="Update">
  <input type="Submit" name="action" value="Cancel">
</form>';
# -------------------------------------------------------
require_once '../display/footer.php';
# -------------------------------------------------------
?>