<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Appointment</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<p></p>
    <p></p>
    <p></p>
	<a href="viewappointments.php?PetID=<?php echo $_GET['PetID']; ?>">Return to Appointments</a>
	<h1>Edit the Appointment details.</h1>
	<?php $getAppointmentByID = getAppointmentByID($pdo, $_GET['AppointmentID']); ?>
	<form action="core/handleForms.php?AppointmentID=<?php echo $_GET['AppointmentID']; ?>
	&PetID=<?php echo $_GET['PetID']; ?>" method="POST">
		<p>
			<label for="appointmentDate">Date: </label> 
			<input type="date" name="appointmentDate" 
			value="<?php echo $getAppointmentByID['appointmentDate']; ?>">
		</p>
		<p>
			<label for="appointmentTime">Time: </label> 
			<input type="time" name="appointmentTime" 
			value="<?php echo $getAppointmentByID['appointmentTime']; ?>">
		</p>
        <p>
			<label for="description">Description: </label> 
			<input type="text" name="description" 
			value="<?php echo $getAppointmentByID['description']; ?>">
		</p>
        <p>
			<label for="status">Status: </label> 
			<input type="text" name="status" 
			value="<?php echo $getAppointmentByID['status']; ?>">
		</p>
        <input type="submit" name="editAppointmentBtn">
	</form>
</body>
</html>
