<?php
require_once '../database/conn.php';
# -------------------------------------------------------
require_once '../display/header.php';
# -------------------------------------------------------

$viewAttempts = 0;
$successAttempts = 0;
$failedAttempts = 0;
$logPercent = 100;

/********************
 * GRABBING THE STATS
 ********************/
$myfile = fopen("../logActivities/systemActivities.txt", "r") or die("Unable to open System Log");
$textFromFile = '';
while (! feof($myfile))
{
  $line = fgets($myfile);
  if (substr($line, 15, 4) == 'View')
  {
    $viewAttempts++;
  }
  elseif (substr($line, 15, 10) == 'Successful')
  {
    $successAttempts++;
  }
  elseif (substr($line, 15, 6) == 'Failed')
  {
    $failedAttempts++;
  }
}
fclose($myfile);

/********************
 * CALCULATING PERCENTAGE
 ********************/
if ( $successAttempts != 0)
{
  $logPercent = floor($successAttempts / ($successAttempts + $failedAttempts) * 100 );
}

/********************
 * DISPLAYING DATA
 ********************/
echo '
        <h2>
          Stats
        </h2>
        <br>
        <table>
          <tr>
             <th>Number of Successful User Actions</th>
             <th> | Number of Failed User Actions</th>
             <th> | Success Rate</th>
             <th> | Number of Times a File was Viewed</th>
          </tr>
          <tr>
            <td>' . $successAttempts . '</td>
            <td>' . $failedAttempts . '</td>
            <td>' . $logPercent . '%</td>
            <td>' . $viewAttempts . '</td>
          </tr>
        </table>
          ';

# -------------------------------------------------------
#Add the footer to the HTML
require_once '../display/footer.php'; 
# -------------------------------------------------------
?>
<style>
  table td {background-color: #fafaff; border: solid 1px blue; text-align: center; padding-left: 5px; padding-right: 5px;} 
</style>