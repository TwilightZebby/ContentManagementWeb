<?php
require_once '../database/conn.php';
# -------------------------------------------------------
#Start with the header
require_once '../display/header.php';
# -------------------------------------------------------
echo '<hr>';

$sql = "SELECT * FROM siteFiles";
#echo "test".$sql."<br>";
$siteFiles = $DBcon->query($sql); 
#
if($siteFiles->rowCount() != 0)
{#create a table to show the users
  if($_SESSION['accessLevel'] == 1)
  {
  echo '
        <h2>
          Files Registered
          <input type="button" value="Reset" onclick="reset()" style="border-radius: 7px; font-size:7pt; color: red; left: 45%;"/>
        </h2>
        <table>
          <tr>
             <th>ID</th>
             <th>Title</th>
             <th>Date</th>
             <th>Options</th>
          </tr>
          ';
  } else {
    echo '
        <h2>
          Files Registered
        </h2>
        <table>
          <tr>
             <th>ID</th>
             <th>Title</th>
             <th>Date</th>
             <th>Options</th>
          </tr>
          ';
  }
  #display the results of the initialisation of the users table 
  while ($row = $siteFiles -> fetch()) 
  {
    #------------------- 
    $update = ' | <input class="updateButton" type="button" value="Update" onclick="updateFile(' . $row['fileId'] . ')"/>';
    if ($_SESSION['accessLevel'] < 3) # access levels 1 and 2 can see this
		{
			$delete = ' | <input class="removeButton" type="button" value="Remove" onclick="removeFile(' . $row['fileId'] . ')"/>';
		} else
    {
      $delete = ' ';
    }
    $view =      '<input class="viewButton" type="button" value="View" onclick="viewFile(' . $row['fileId'] . ')"/>';
    $upload =    '<input class="addButton" type="button" value="Upload file" onclick="uploadFile()"/>'; 
  
    echo "<tr>
            <td>" . $row['fileId'] . "</td>
            <td>" . $row['title'] . "</td>
            <td>" . date("l j F Y, \@ H:i",strtotime($row['dateModified'])) . "</td>
            <td>". $view . $update . $delete . "</td>
          </tr>";
  }
  echo "</table>";
  echo  $upload;
}
else 
{
  echo '<h3>No files are currently registered. <input type="button" value="Reset" onclick="reset()" style="border-radius: 7px; font-size:7pt; color: red; left: 45%;"/></h3>';
  echo '<input class="addButton" type="button" value="Upload file" onclick="uploadFile()"/>'; 
}
?>
<style>
table td {background-color: #fafaff; border: solid 1px blue; text-align: center; padding-left: 5px; padding-right: 5x;} 
</style>
<script>
  //The actions for the 4 button types.
     function viewFile(file)
     {
          filelocation = "viewFileContents.php?file=" + file;
          myWindow = window.open(filelocation, '_self');
     } 
     function updateFile(file)
     {
          filelocation = "updateFile.php?file=" + file;
          myWindow = window.open(filelocation, '_self');
     } 
     function uploadFile()
     {
          filelocation = "fileUploadForm.php";
          myWindow = window.open(filelocation, '_self');
     } 
     function removeFile(file)
     {
         if(confirm("Are you sure you want to completely remove the file?"))
         {
             filelocation = "removeFile.php?file=" + file;
             myWindow = window.open(filelocation, '_self');
         }
     } 
    //---------------------------------------------------------------------
     function reset(file)
     {
         if(confirm("Are you sure you want to reset the Files Database?"))
         {
             filelocation = "../processes/reset.php";
             myWindow = window.open(filelocation, '_self');
         }
     } 
</script>
<hr>

<?php
# -------------------------------------------------------
#Add the footer to the HTML
require_once '../display/footer.php'; 
# -------------------------------------------------------
?>
