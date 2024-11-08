<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php if (isset($_SESSION['username'])) { ?>
    <a href="core/handleForms.php?logoutAUser=1" class="logout-btn">Logout</a>
    <?php 
    }
    else { 
        echo "<h1>No user logged in</h1>";
    } 
    ?>
    <div class="header">
        <h1><center>Welcome To Pawnect</center></h1>
        <?php
        $username = $_SESSION['username'];
        $getUser = getUserByUsername($pdo, $username);

        if ($getUser) {
        echo "<form action='viewuser.php' method='GET'>";
        echo "<input type='hidden' name='userID' value='" . $getUser['userID'] . "'>";
        echo "<input type='submit' class='view-user-btn' value='View User Information'>";
        echo "</form>";
        }
        ?>
        <h1>Hello <?php echo $_SESSION['username']; ?>!</h1>
        <h2>Please enter your Pet information below to Register</h2>
    </div>
    <div class="centered-form-container">
        <form action="core/handleForms.php" method="POST">
            <p>
                <label for="petName">Pet Name: </label> 
                <input type="text" name="petName">
            </p>
            <p>
                <label for="species">Species: </label> 
                <input type="text" name="species">
            </p>
            <p>
                <label for="breed">Breed: </label> 
                <input type="text" name="breed">
            </p>
            <p>
                <label for="dateOfBirth">Date of Birth: </label> 
                <input type="date" name="dateOfBirth">
            </p>
            <p>
                <label for="gender">Gender: </label> 
                <input type="text" name="gender">
            </p>
            <p></p>
            <input type="submit" name="insertPetBtn" value="Register Pet">
        </form>
    </div>

    <h1>List of Registered Pets</h1>
    <?php $getAllPets = getAllPets($pdo); ?>
    <?php foreach ($getAllPets as $row) { ?>
        <div class="container">
            <h3>Pet Details:</h3>
            <p><strong>Pet ID</strong>: <?php echo $row['PetID']; ?></p>
            <p><strong>Pet Name</strong>: <?php echo $row['petName']; ?></p>
            <p><strong>Species</strong>: <?php echo $row['species']; ?></p>
            <p><strong>Breed</strong>: <?php echo $row['breed']; ?></p>
            <p><strong>Date Of Birth</strong>: <?php echo $row['dateOfBirth']; ?></p>
            <p><strong>Gender</strong>: <?php echo $row['gender']; ?></p>
            <p><strong>Date Added</strong>: <?php echo $row['date_added']; ?></p>
            <p><strong>Date Updated</strong>: <?php echo $row['last_updated']; ?></p>
            <p><strong>Added By</strong>:
            <?php 
                $userID = $row['added_by']; 
                $user = getUserByID($pdo, $userID);
        
            if ($user) {
            echo $user['username']; 
            } else {
            echo 'Unknown User';
            }
            ?>
            </p>
            <p><strong>Updated By</strong>:
            <?php 
            $updatedUserID = $row['updated_by']; 
            $updatedUser = getUserByID($pdo, $updatedUserID);
            if ($updatedUser) {
                echo $updatedUser['username']; 
            } else {
                echo 'Unknown User';
            }
            ?>
            </p>
            <p></p>
            <div class="editAndDelete">
                <a href="viewappointments.php?PetID=<?php echo $row['PetID']; ?>">View Appointments</a>
                <a href="editpet.php?PetID=<?php echo $row['PetID']; ?>">Edit</a>
                <a href="deletepet.php?PetID=<?php echo $row['PetID']; ?>">Delete</a>
            </div>
        </div>
    
    <?php } ?>
</body>
</html>