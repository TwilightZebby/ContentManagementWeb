<?php
    try 
	  {
      header("Location:php/startup/initialise.php");
    }
    catch(PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }
?>
