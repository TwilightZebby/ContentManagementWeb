<?php
//add redirect function
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
    //get the files extension - used it identify the folder it should be in
    if( pathinfo($row['fileName'], PATHINFO_EXTENSION) == 'md')
    {
      $myfile = fopen('../storedFiles/' . $row['fileName'], "r") or die("Unable to open file ../storedFiles" . $row['body']);
      // Output one line until end-of-file
      $textFromFile = '';
      while(!feof($myfile)) 
      {
        $textFromFile = $textFromFile . fgets($myfile);
      }
      fclose($myfile);
      //output file contents to the page as a text area that can be changed
      echo '
      <form method="post" action="saveFile.php?name='.$row['fileName'].'&file='.$row['fileId'].'">
      <h2>Update File</h2>
      <p>Title: <br>
      <input type="text" class="fileInfo" name= "title" size="44" maxlength="255" value="'.$row['title'] .'"/></p>
      <p>Last modified: '.date("l j F Y, \@ H:i",strtotime($row['dateModified'])).'</p>
      <p>Body: <br>
      <textarea class="fileInfo" name="bodyText" rows="20" cols="84">'.$textFromFile.'</textarea></p>
      <input type="Submit" name= "action" value="Update file">
      <input type="Submit" name= "action" value="Cancel">
    </form>';
    }
}
# -------------------------------------------------------
#Add the footer to the HTML
require_once '../display/footer.php';
# -------------------------------------------------------
?>