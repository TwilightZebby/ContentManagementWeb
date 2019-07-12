<?php require_once '../display/header.php'; ?>	
	<form method="post" action="../processes/transactionUser.php">
		<h2>User Login</h2>
		<p>
			Email Address:<br>
			<input type="email" name="email" maxlength="255" value="" required>
		</p>
		<p>
			Password: <br>
			<input type="password" name="password" maxlength= "50" required>
		</p>
		<p>
			<input type="Submit" name= "action" value="Log in" >
			<input type="Submit" name= "action" value="Cancel" >
		</p>
	</form>
<?php require_once '../display/footer.php'; ?>