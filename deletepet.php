<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Pet</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this pet?</h1>
	<?php $getPetByID = getPetByID($pdo, $_GET['PetID']); ?>
	<div class="container">
		<h2>Pet Name: <?php echo $getPetByID['petName']; ?></h2>
		<h2>Species: <?php echo $getPetByID['species']; ?></h2>
		<h2>Breed: <?php echo $getPetByID['breed']; ?></h2>
		<h2>Date Of Birth: <?php echo $getPetByID['dateOfBirth']; ?></h2>
		<h2>Gender: <?php echo $getPetByID['gender']; ?></h2>
		<h2>Date Added: <?php echo $getPetByID['date_added']; ?></h2>
	</div>
	<div class="backBtn">
			<form action="core/handleForms.php?PetID=<?php echo $_GET['PetID']; ?>" method="POST">
				<input type="submit" name="deletePetBtn" value="Delete">
			</form>			
	</div>	
</body>
</html>
