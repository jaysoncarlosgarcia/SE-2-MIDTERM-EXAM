<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="login-page">
		<div class="login-container">
		<h1>Welcome Back!</h1>
		<p class="login-message">Please login to continue to Pawnect</p>
		<form action="core/handleForms.php" class="login-form" method="POST">
    		<div class="input-container">
        		<label for="username">Username:</label>
        		<input type="text" name="username" placeholder="Enter your username" required>
    		</div>
    		<div class="input-container">
        		<label for="password">Password:</label>
        		<input type="password" name="password" placeholder="Enter your password" required>
    		</div>
    <button type="submit" name="loginUserBtn" class="login-btn">Login</button>
</form>
		<p class="register-link">Don't have an account? <a href="register.php" class="register-btn">Register here</a></p>
		</div>
	</div>
</body>
</html>
