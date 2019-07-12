<?php
#echo "createTable.php - include connection script";
require_once 'conn.php';//creates a connection to the database
try	{
	$sql = "DROP TABLE users";
  $stmt = $DBcon->prepare($sql);
  $stmt->execute();
  #echo "<br>successfully deleted Users table";
  $sql = "DROP TABLE siteFiles";
  $stmt = $DBcon->prepare($sql);
  $stmt->execute();
  #echo "<br>successfully deleted Files table";
}
catch(PDOException $e){
  echo "<br>" . $sql . "<br>" . $e->getMessage();
}
#echo "<br>createTable.php - deletion completed";
try {
  $sql = "CREATE TABLE IF NOT EXISTS users (
        userId INT (11) NOT NULL auto_increment,
        email varchar(255) NOT Null default '', 
        password varchar(50) NOT NULL default '',
        firstName varchar(60) NOT NULL default '',
        lastName varchar(60) NOT NULL default '',
        accessLevel tinyint(4) NOT NULL default '1', 
        PRIMARY KEY(userId),
        UNIQUE KEY uniq_email(email)
        )";
  $DBcon -> exec($sql);
  #echo "<br>createTable.php - create users table completed";
  
  $sql = "CREATE TABLE IF NOT EXISTS siteFiles(
    fileId INT NOT NULL auto_increment,
    dateModified datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    title varchar(255) NOT NULL default '',
    fileName varchar(255) NOT NULL, 
    PRIMARY KEY(fileId) 
    )";     
  $DBcon -> exec($sql);

  #echo "<p>Table siteFiles created successfully</p>";
}
catch(PDOException $e){
  echo $sql . "<br>" . $e->getMessage();
}
?>