<?php
require_once '../display/header.php';
?>
        <style> 
             table td {background-color: #fafaff; border: solid 1px blue; text-align: center; padding-left: 5px; padding-right: 5x;} 
             #logobar {color: blue; font-size: 16pt;} 
             table p {color: #800000; font-family: verdana;}
        </style> 
        <script>
            //JavaScript for the buttons above (shows how php and JS can be used together)
            function addUser()
            {
                //go to Form to add a new User
                filelocation = "../userManagement/addUserForm.php";
                window.open(filelocation, '_self');
            } 
            function updateUser(user)
            {
                //go to Form to edit a registered User
                filelocation = "../userManagement/updateUserForm.php?user=" + user;
                window.open(filelocation, '_self');
            } 
            function deleteUser(user)
            {
                //go to PHP file to process deletion of selected User
                filelocation = "../userManagement/deleteUser.php?user=" + user;
                window.open(filelocation, '_self');
            } 
            function resetUsers()
            {
              if(confirm("Are you sure you want to reset the Users Database?"))
              {
                  //reset the users table
                  filelocation = "../userManagement/resetUser.php";
                  window.open(filelocation, '_self');
              }
                
            } 
        </script>
            <hr>
            <h2>Registered Users
              <input type="button" value="Reset" onclick="resetUsers()" style="border-radius: 7px; font-size:7pt; color: red; left: 45%;"/>
            </h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Access level</th>
                    <th colspan="2">Options</th>
               </tr>
                <!-- create User Listings -->
                <?php
                # ********************************************************************************
                //get user data
                require_once '../database/conn.php';
                $sql = "SELECT * FROM users where accessLevel > 0";
                $users = $DBcon->query($sql); 
                
                if($users->rowCount() > 0 )
                {
                    while ($row = $users->fetch())
                    { 
                        echo "<tr><td>".$row['userId']."</td>";
                        echo "<td>".$row['firstName']."</td>";
                        echo "<td>".$row['lastName']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['accessLevel']."</td>";
                        echo '<td><input class="updateButton" type="button" value="Update" onclick="updateUser(' . $row['userId'] . ')"/></td>';
                        echo '<td><input class="removeUserButton type="button" value="Delete" onclick="deleteUser(' . $row['userId'] . ')"/></td></tr>';
                    }
                } 
                else 
                {
                    #IF NO USERS ARE REGISTERED
                    #User wouldn't be able to access this page without an account anyways, but it's a "Just in case"
                    echo "<tr><td colspan='7'>No one is currently registered.</td></tr>";
                } 
                # ********************************************************************************
                ?>
            </table>
            <input class="addButton" type="button" value="Add user" onclick="addUser()"/>
            <hr>

<?php
# -------------------------------------------------------
#Add the footer to the HTML
require_once '../display/footer.php'; 
# -------------------------------------------------------
?>
