<html>
    <head>
        <title>Update a user</title>
    </head>
    <body>
        <h2>Update user</h2>
        <?php
            require_once '../database/conn.php';
            # get users from SQL
            $sql = "SELECT * FROM users WHERE userId = ".$_GET['user'];
            $users = $DBcon->query($sql);            
            if($users->rowCount() ==1 )
            {
                #FORM FOR CHANGING THE DETAILS OF A REGISTERED USER
                $row = $users->fetch(); 
                echo '<form method="post" action="updateUser.php?user='.$row['userId'].'">';
                echo '<p>First name: <br><input type="text" class="inputClass" name= "firstName" maxlength="255" required value="'.$row['firstName'] .'"/></p>';
                echo '<p>Last name: <br><input type="text" class="inputClass" name= "lastName" maxlength="255" required value="'.$row['lastName'] .'"/></p>';
                echo '<p>email address: <br><input type="text" class="inputClass" name= "email" maxlength="255" required value="'.$row['email'] .'"/></p>';
                echo '<p>Password: <br><input type="text" class="inputClass" name= "password" maxlength="255" required value="'.$row['password'] .'"/></p>';
                echo '<p>Access level: <input type="number" class="inputClass" name= "accessLevel" min="1" max="3" required value="'.$row['accessLevel'] .'"/></p>';
            }           
            ?>
            <input type="Submit" name= "action" value="Update user">&nbsp;
            <input type="Submit" name= "" value="Cancel" onclick="window.history.back();">
        </form>
    </body>
</html>