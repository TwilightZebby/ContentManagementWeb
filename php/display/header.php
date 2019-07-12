<?php 
	session_start();
?>
<html>
	<head>
		<title>File Management System</title>
		<style>
			#headerArea { color:#800000; position: relative; left: 50px;}
			#loginTitle { color: #800000; font-size: 16pt; font-weight: 600;}
			#mainArea { color: #800000; font-size: 12pt; position: relative; left: 30px;}
		</style>
    <script>
      //CREATION/EDIT OF COOKIE
      function sizeCookieCreation() {
        var expireDate = new Date();
        var oneYear = 365*24*60*60*1000;
        expireDate.setTime(expireDate.getTime() + oneYear);
        var expires = "expires="+ expireDate.toUTCString();
        // document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        document.cookie = "innerHeight=" + window.innerHeight + ";" +expires + ";path=/";
        document.cookie = "outerHeight=" + window.outerHeight + ";" +expires + ";path=/"; 
      }
      
      //FOR DETECTING BROWSER RESIZE
      window.addEventListener("resize", function(){
        sizeCookieCreation();
        var allCookies = document.cookie;
        //console.log(allCookies); //Used for looking at the Array!
        var searchForCookie = /innerHeight=[0-9][0-9][0-9]/i;
        var searchForNumber = /[0-9][0-9][0-9]/i;
        var sizeCookie = searchForCookie.exec(allCookies);
        //console.log(sizeCookie);
        var windowSize = searchForNumber.exec(sizeCookie);
        //console.log(windowSize);
        
        if(windowSize < 400) {
          document.querySelector("body").style.backgroundColor = "red";
          document.querySelector("#browserMsg").innerText = "Please enlarge your browser!";
        } else {
          document.querySelector("body").style.backgroundColor = "white";
          document.querySelector("#browserMsg").innerText = " ";
        }
        
      });
      
      /**************************
       * BROWSER STUFF
       *************************/
      
      <?php
      
      $browserCheck = 0;
      $user_agent = $_SERVER['HTTP_USER_AGENT'];
      #echo 'var currentBrowser = "' . $user_agent . '";'; #So I can see when debugging
      
      function get_browser_name($userAgent)
      {
          if (strpos($userAgent, 'Opera') || strpos($userAgent, 'OPR/')) return 'Opera';
          elseif (strpos($userAgent, 'Edge')) return 'Edge';
          elseif (strpos($userAgent, 'Chrome')) return 'Chrome';
          elseif (strpos($userAgent, 'Safari')) return 'Safari';
          elseif (strpos($userAgent, 'Firefox')) return 'Firefox';
          elseif (strpos($userAgent, 'MSIE') || strpos($userAgent, 'Trident/7')) return 'Internet Explorer';
          else return 'Other';
      }

      if (get_browser_name($user_agent) == 'Opera' || get_browser_name($user_agent) == 'Chrome')
      {
        $browserCheck = 1;
      }
      if (get_browser_name($user_agent) == 'Safari' || get_browser_name($user_agent) == 'Firefox')
      {
        $browserCheck = 2;
      }
      
      ?>
      
    </script>    
    <?php
      if ($browserCheck == 0)
      {
        return;
      }
      elseif ($browserCheck == 1)
      {
        echo '<link rel="stylesheet" href="../../css/browserOne.css">';
      }
      elseif ($browserCheck == 2)
      {
        echo '<link rel="stylesheet" href="../../css/browserTwo.css">';
      }
    ?>
	</head>
	<body>
		<div id="headerArea">
			<div id="loginTitle">
        <h1 id="browserMsg" style="color: white;"></h1>
        <a name="top"></a>
				<p>Access Controlled File Management System</p>
			</div>
			<?php
				if (isset($_SESSION['lastName']))
				{
					echo '<div id="loggedIn">';
					echo '<p style="margin-left: 30px;">Welcome '
                .$_SESSION['firstName']." ".$_SESSION['lastName']."</p>";
					echo '</div>';
				}
			?>
		</div>
		<div id="mainArea">
      <?php
        if ($browserCheck == 0)
        {
          echo '<div id="navigation">';
        }
        elseif ($browserCheck == 1)
        {
          echo '<div id="navigation" style="background-color: pink; width: 530px; border: 2px solid pink; border-radius: 5px;">';
        }
      ?>
				<?php
						if (isset($_SESSION['lastName']))  
						{
							echo '<a class="navButton" href="../fileManagement/listFiles.php">View Files</a>';
              if ($_SESSION['accessLevel'] == 1) # only access level 1 users can see this (ie: Admins)
							{
								echo ' | <a class="navButton" href="../userManagement/listUsers.php">Manage Users</a>';
                echo ' | <a class="navButton" href="../logActivities/viewLog.php">View Log</a>';
                echo ' | <a class="navButton" href="../other/stats.php">Check Stats</a>';
							}
              echo ' | <a class="navButton" href="../processes/transactionUser.php?action=Logout">Logout</a>';
						}
					?>
			</div>