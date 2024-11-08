<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View User</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php 
    if (!isset($_GET['userID'])) {
        echo "User ID is missing.";
        exit();
    }

    $getUserByID = getUserByID($pdo, $_GET['userID']);
    if (!$getUserByID) {
        echo "User not found.";
        exit();
    }
    ?>
	<h1>User Information</h1>
	<div class="container">
		<p><strong>UserID:</strong> <?php echo $getUserByID['userID']; ?></p>
		<p><strong>Username:</strong> <?php echo $getUserByID['username']; ?></p>
		<p><strong>First Name:</strong> <?php echo $getUserByID['firstName']; ?></p>
		<p><strong>Last Name:</strong> <?php echo $getUserByID['lastName']; ?></p>
		<p><strong>Birthday:</strong> <?php echo $getUserByID['birthday']; ?></p>
		<p><strong>Age:</strong> <?php echo $getUserByID['age']; ?></p>
		<p><strong>Date Joined:</strong> <?php echo $getUserByID['date_added']; ?></p>
	</div>
	<div class="backBtn">
		<a href="index.php" class="btn-back">Back to Home</a>
	</div>
</body>
</html>
