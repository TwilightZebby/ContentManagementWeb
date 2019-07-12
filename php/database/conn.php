<?php
     //this file connects any calling page to the database
     $DBhost = "localhost";
     $DBuser = "User1";
     $DBpassword = "Password1";
     $DBname = "TwilightDatabase";
     try{
      $DBcon = new PDO("mysql:host=$DBhost;dbname=$DBname",$DBuser,$DBpassword);
      $DBcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }catch(PDOException $ex){
      die($ex->getMessage());
     }
?>