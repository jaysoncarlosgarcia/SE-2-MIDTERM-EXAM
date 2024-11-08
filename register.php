<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Register</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="username">Username: </label>
			<input type="text" name="username">
		</p>
		<p>
			<label for="username">Password: </label>
			<input type="password" name="password">
		</p>
        <p>
			<label for="firstName">First Name: </label>
			<input type="text" name="firstName">
		</p>
        <p>
			<label for="lastName">Last Name: </label>
			<input type="text" name="lastName">
		</p>
        <p>
			<label for="birthday">Birthday: </label>
			<input type="date" name="birthday">
		</p>
        <p>
			<label for="age">Age: </label>
			<input type="text" name="age">
		</p>
        <input type="submit" name="registerUserBtn">
	</form>
</body>
</html>