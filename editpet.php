<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Pet</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getPetByID = getPetByID($pdo, $_GET['PetID']); ?>
	<h1>Edit pet details.</h1>
	<form action="core/handleForms.php?PetID=<?php echo $_GET['PetID']; ?>" method="POST">
		<p>
			<label for="petName">Pet Name: </label> 
			<input type="text" name="petName" value="<?php echo $getPetByID['petName']; ?>">
		</p>
		<p>
			<label for="species">Species: </label> 
			<input type="text" name="species" value="<?php echo $getPetByID['species']; ?>">
		</p>
		<p>
			<label for="breed">Breed:</label> 
			<input type="text" name="breed" value="<?php echo $getPetByID['breed']; ?>">
		</p>
        <p>
			<label for="dateOfBirth">Date of Birth: </label> 
			<input type="date" name="dateOfBirth" value="<?php echo $getPetByID['dateOfBirth']; ?>">
		</p>
		<p>
			<label for="gender">Gender: </label> 
			<input type="text" name="gender" value="<?php echo $getPetByID['gender']; ?>">
		</p>
		<input type="submit" name="editPetBtn">
	</form>
</body>
</html>
