<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Appointment</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<?php $getAppointmentByID = getAppointmentByID($pdo, $_GET['AppointmentID']); ?>
	<h1>Are you sure you want to delete this appointment?</h1>
	<div class="container">
		<h2>Pet Name: <?php echo $getAppointmentByID['petName'] ?></h2>
		<h2>Date: <?php echo $getAppointmentByID['appointmentDate'] ?></h2>
		<h2>Time: <?php echo $getAppointmentByID['appointmentTime'] ?></h2>
		<h2>Description: <?php echo $getAppointmentByID['description'] ?></h2>
		<h2>Status: <?php echo $getAppointmentByID['status'] ?></h2>
        <h2>Date Added: <?php echo $getAppointmentByID['date_added'] ?></h2>
	</div>
	<div class="deleteBtn">
            <form action="core/handleForms.php?AppointmentID=<?php echo $_GET['AppointmentID']; ?>&PetID=<?php echo $_GET['PetID']; ?>" method="POST">
                <input type="submit" name="deleteAppointmentBtn" value="Delete">
            </form>
    </div>	
</body>
</html>
