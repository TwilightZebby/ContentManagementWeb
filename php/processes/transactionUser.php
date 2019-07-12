<?php
require_once '../database/conn.php';
#
function redirect($url) 
  {
  if (!headers_sent()) 
    {
    header('Location: http://' . $_SERVER['HTTP_HOST'] .
    dirname($_SERVER['PHP_SELF']) . '/' . $url);
    } 
  else 
    {
    die('Could not redirect; Headers already sent (output).');
    } 
  }
  #----------------------------------------------------------------
  if (isset($_REQUEST['action'])) 
    {
    switch ($_REQUEST['action']) 
      {
      case 'Log in':
      if (isset($_POST['email']) and isset($_POST['password']))
        {
        $sql = "SELECT userId, accessLevel, firstName , lastName
        FROM users
        WHERE email='".$_POST['email'] ."' 
        AND password ='".$_POST['password'] ."'";
        echo $sql."<br>";
        $result = $DBcon->query($sql); 
        if($row = $result->fetch()){
          session_start();
          $_SESSION['userId'] = $row['userId'] ;
          $_SESSION['accessLevel'] = $row['accessLevel'];
          $_SESSION['firstName'] = $row['firstName'];
          $_SESSION['lastName'] = $row['lastName'];
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
          $text = "Activity type: Successful login - at " . $dated. " - by user id: " . $_SESSION['userId']." - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
          fwrite($activityLog, $text) or die("Couldn't write values to file!");
          #close file
          fclose($activityLog);
          #
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
          $text = "Activity type: Failed Login Attempt - at " . $dated. " - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
          fwrite($activityLog, $text) or die("Couldn't write values to file!");
          #close file
          fclose($activityLog);
          #
          echo "<br>Log-in failed<br>";
        }
      }
      redirect('../other/home.php');
      break;
      #------------------------------------------------------------------
      case 'Logout':
      session_start();
      session_unset();
      session_destroy();
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
      $text = "Activity type: Successfully logged out user - at " . $dated. " - IP: " . $_SERVER["HTTP_X_FORWARDED_FOR"] ."\n"; 
      fwrite($activityLog, $text) or die("Couldn't write values to file!");
      #close file
      fclose($activityLog);
      #
      redirect('../other/home.php');
      break;
      #------------------------------------------------------------------
      case 'Cancel':
      session_start();
      session_unset();
      session_destroy();
      redirect('../other/home.php');
      break;
      #-----------------------------------------------------------------
    }
  }
?>