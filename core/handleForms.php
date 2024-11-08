<?php 
require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertPetBtn'])) {
    $userID = $_SESSION['userID'];
    $query = insertPet($pdo, $_POST['petName'], $_POST['species'], 
        $_POST['breed'], $_POST['dateOfBirth'], $_POST['gender'], $userID);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editPetBtn'])) {
    $userID = $_SESSION['userID'];
    $query = updatePet($pdo, $_POST['petName'], $_POST['species'], 
        $_POST['breed'], $_POST['dateOfBirth'], $_POST['gender'], $_GET['PetID'], $userID);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Edit failed";
    }
}

if (isset($_POST['deletePetBtn'])) {
    $userID = $_SESSION['userID'];
    $query = deletePet($pdo, $_GET['PetID'], $userID);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Deletion failed";
    }
}

if (isset($_POST['insertNewAppointmentBtn'])) {
    $userID = $_SESSION['userID'];
    $query = insertAppointment($pdo, $_POST['appointmentDate'], $_POST['appointmentTime'], 
        $_POST['description'], $_POST['status'], $_GET['PetID'], $userID);

    if ($query) {
        header("Location: ../viewappointments.php?PetID=" . $_GET['PetID']);
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editAppointmentBtn'])) {
    $userID = $_SESSION['userID'];
    $query = updateAppointment($pdo, $_POST['appointmentDate'], $_POST['appointmentTime'], 
        $_POST['description'], $_POST['status'], $_GET['AppointmentID'], $userID);

    if ($query) {
        header("Location: ../viewappointments.php?PetID=" . $_GET['PetID']);
    } else {
        echo "Update failed";
    }
}

if (isset($_POST['deleteAppointmentBtn'])) {
	$query = deleteAppointment($pdo, $_GET['AppointmentID']);

	if ($query) {
		header("Location: ../viewappointments.php?PetID=" .$_GET['PetID']);
	} else {
		echo "Deletion failed";
	}
}

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$birthday = $_POST['birthday'];
	$age = $_POST['age'];

	if (!empty($username) && !empty($password) && !empty($firstName) && !empty($lastName) && !empty($birthday) && !empty($age)) {

		$insertQuery = insertNewUser($pdo, $username, $password, $firstName, $lastName, $birthday, $age);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}

if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

?>
