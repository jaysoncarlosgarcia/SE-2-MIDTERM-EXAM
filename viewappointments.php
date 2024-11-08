<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Appointments</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <p></p>
    <p></p>
    <p></p>
    <a href="index.php" class:="top-right-btn">Return to home</a>
    <?php $getPetByID = getPetByID($pdo, $_GET['PetID']); ?>
    <h1>Enter Appointment Details for <?php echo ($getPetByID['petName']); ?></h1>
    <form action="core/handleForms.php?PetID=<?php echo $_GET['PetID']; ?>" method="POST">
        <p>
            <label for="appointmentDate">Date: </label> 
            <input type="date" name="appointmentDate">
        </p>
        <p>
            <label for="appointmentTime">Time: </label> 
            <input type="time" name="appointmentTime">
        </p>
        <p>
            <label for="description">Description: </label> 
            <input type="text" name="description">
        </p>
        <p>
            <label for="status">Status: </label> 
            <input type="text" name="status">
        </p>
        <input type="submit" name="insertNewAppointmentBtn">
    </form>
    
    <h1>Appointments for <?php echo ($getPetByID['petName']); ?></h1>
    <table style="width:100%; margin-top: 50px;">
        <tr>
            <th>Appointment ID</th>
            <th>Pet Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Description</th>
            <th>Status</th>
            <th>Date Added</th>
            <th>Date Updated</th>
            <th>Added By</th>
            <th>Updated By</th>
            <th>Action</th>
        </tr>
        <?php 
        $getAppointmentsByPet = getAppointmentsByPet($pdo, $_GET['PetID']); 
        foreach ($getAppointmentsByPet as $row) { 
            $addedUser = getUserByID($pdo, $row['added_by']);
            $updatedUser = getUserByID($pdo, $row['updated_by']);
        ?>
        <tr>
            <td><?php echo $row['AppointmentID']; ?></td>
            <td><?php echo $row['petName']; ?></td>
            <td><?php echo $row['appointmentDate']; ?></td>  
            <td><?php echo $row['appointmentTime']; ?></td>  
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['status']; ?></td>  
            <td><?php echo $row['date_added']; ?></td>
            <td><?php echo $row['last_updated']; ?></td>
            <td>
                <?php echo ($addedUser) ? $addedUser['username'] : 'Unknown User'; ?>
            </td>
            <td>
                <?php echo ($updatedUser) ? $updatedUser['username'] : 'Unknown User'; ?>
            </td>
            <td>
                <a href="editappointment.php?AppointmentID=<?php echo $row['AppointmentID']; ?>&PetID=<?php echo $_GET['PetID']; ?>">Edit</a>
                <p></p>
                <a href="deleteappointment.php?AppointmentID=<?php echo $row['AppointmentID']; ?>&PetID=<?php echo $_GET['PetID']; ?>">Delete</a>
            </td>   
        </tr>
        <?php } ?>
    </table>
</body>
</html>
