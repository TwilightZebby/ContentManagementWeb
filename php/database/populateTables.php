<?php 
try
{
    $email = "admin@yoursite.com";
    $password = "admin";
    $firstName = "An";
    $lastName = "Admin";
    $accessLevel = "1";  
    $sql = "INSERT IGNORE INTO users VALUES (NULL,'$email', '$password', '$firstName','$lastName', $accessLevel )";    
    $DBcon->exec($sql);
    #echo "<br>populateTables - 1st user created successfully";
#************************************************************
  
    $email = "manager@yoursite.com";
    $password = "manager";
    $firstName = "A";
    $lastName = "Manager";
    $accessLevel = "2";
    $sql = "INSERT IGNORE INTO users VALUES (NULL,'$email', '$password', '$firstName','$lastName', $accessLevel )";
    $DBcon->exec($sql);
    #echo "<br>populateTables - 2nd user created successfully";     
#************************************************************

    $email = "user@yoursite.com";
    $password = "user";
    $firstName = "A";
    $lastName = "User";
    $accessLevel = "3";
    $sql = "INSERT IGNORE INTO users VALUES (NULL,'$email', '$password', '$firstName','$lastName', $accessLevel )";
  
	  $DBcon->exec($sql);
    #echo "<br>populateTables - 3rd user created successfully";
  
    #************************************************************
    ini_set('date.timezone', 'Europe/London');
    $date = date("Y-m-d H:i:s",time());
    $title = "notes.md";
    $fileName = 'notes.md';
    $sql = "INSERT IGNORE INTO siteFiles VALUES (NULL, '$date', '$title', '$fileName')";
    $DBcon->exec($sql);
    #************************************************************
    ini_set('date.timezone', 'Europe/London');
    $date = date("Y-m-d H:i:s",time());
    $title = "testDoc.md";
    $fileName = 'testDoc.md';
    $sql = "INSERT IGNORE INTO siteFiles VALUES (NULL, '$date', '$title', '$fileName')";
    $DBcon->exec($sql);
    #echo "files populated";
 }
#************************************************************
catch(PDOException $e)
  {
    echo $sql . "<br>" . $e->getMessage();
 }
?>