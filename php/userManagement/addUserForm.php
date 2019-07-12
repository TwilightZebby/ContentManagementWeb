<html>
    <head>
        <title>Add a user</title>
    </head>
    <body>
        <form method="post" action="addUser.php">
            <h2>Add new user</h2>
            <p>First name: <br>
            <input type="text" class="inputClass" name= "firstName" maxlength="255" value=""/></p>
            <p>Last name: <br>
            <input type="text" class="inputClass" name= "lastName" maxlength="255" value=""/></p>
            <p>email address: <br>
            <input type="text" class="inputClass" name= "email" maxlength="255" value=""/></p>
            <p>Password: <br>
            <input type="password" class="inputClass" name= "password" maxlength="255" value=""/></p> 
            <p>Access level: 
            <input type="number" class="inputClass" name= "accessLevel" min="1" max="3" value="3"/></p>
            <input type="Submit" name= "action" value="Add user">&nbsp;
            <input type="Submit" name= "" value="Cancel">
        </form>
    </body>
</html>