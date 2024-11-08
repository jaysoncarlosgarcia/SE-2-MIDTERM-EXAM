<?php

function insertPet($pdo, $petName, $species, $breed, $dateOfBirth, $gender, $userID) {
    $sql = "INSERT INTO Pets (petName, species, breed, dateOfBirth, gender, added_by, updated_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$petName, $species, $breed, $dateOfBirth, $gender, $userID, $userID]);
}

function updatePet($pdo, $petName, $species, $breed, $dateOfBirth, $gender, $petID, $userID) {
    $sql = "UPDATE Pets 
            SET petName = ?, species = ?, breed = ?, dateOfBirth = ?, gender = ?, last_updated = CURRENT_TIMESTAMP, updated_by = ?
            WHERE PetID = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$petName, $species, $breed, $dateOfBirth, $gender, $userID, $petID]);
}

function deletePet($pdo, $PetID, $userID) {
    $deletePetAppointment = "DELETE FROM appointments WHERE PetID = ?";
    $deleteStmt = $pdo->prepare($deletePetAppointment);
    $executeDeleteQuery = $deleteStmt->execute([$PetID]);

    if ($executeDeleteQuery) {
        $sql = "DELETE FROM pets WHERE PetID = ?";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$PetID]);

        if ($executeQuery) {
            return true;
        }
    }
}

function getAllPets($pdo) {
    $sql = "SELECT * FROM pets";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

function getPetByID($pdo, $PetID) {
    $sql = "SELECT * FROM pets WHERE PetID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$PetID]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function getAppointmentsByPet($pdo, $PetID) {
    $sql = "SELECT 
                appointments.AppointmentID AS AppointmentID,
                appointments.appointmentDate AS appointmentDate,
                appointments.appointmentTime AS appointmentTime,
                appointments.description AS description,
                appointments.status AS status,
                appointments.date_added AS date_added,
                appointments.last_updated AS last_updated,
                appointments.added_by AS added_by,
                appointments.updated_by AS updated_by,
                pets.petName AS petName
            FROM appointments
            JOIN pets ON appointments.PetID = pets.PetID
            WHERE appointments.PetID = ? 
            GROUP BY appointments.AppointmentID";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$PetID]);

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}


function insertAppointment($pdo, $appointmentDate, $appointmentTime, $description, $status, $PetID, $userID) {
    $sql = "INSERT INTO appointments (appointmentDate, appointmentTime, description, status, PetID, added_by, updated_by) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$appointmentDate, $appointmentTime, $description, $status, $PetID, $userID, $userID]);
    if ($executeQuery) {
        return true;
    }
    return false;
}


function getAppointmentByID($pdo, $AppointmentID) {
    $sql = "SELECT 
                appointments.AppointmentID AS AppointmentID,
                appointments.appointmentDate AS appointmentDate,
                appointments.appointmentTime AS appointmentTime,
                appointments.description AS description,
                appointments.status AS status,
                appointments.date_added AS date_added,
                pets.petName AS petName
            FROM appointments
            JOIN pets ON appointments.PetID = pets.PetID
            WHERE appointments.AppointmentID = ?
            GROUP BY appointments.description";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$AppointmentID]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

function updateAppointment($pdo, $appointmentDate, $appointmentTime, $description, $status, $AppointmentID, $userID) {
    $sql = "UPDATE appointments
            SET appointmentDate = ?, appointmentTime = ?, description = ?, status = ?, last_updated = CURRENT_TIMESTAMP, updated_by = ?
            WHERE AppointmentID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$appointmentDate, $appointmentTime, $description, $status, $userID, $AppointmentID]);

    if ($executeQuery) {
        return true;
    }
}

function deleteAppointment($pdo, $AppointmentID) {
    $sql = "DELETE FROM appointments WHERE AppointmentID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$AppointmentID]);

    if ($executeQuery) {
        return true;
    }
}

function insertNewUser($pdo, $username, $password, $firstName, $lastName, $birthday, $age) {

	$checkUserSql = "SELECT * FROM users WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO users (username, password, firstName, lastName, birthday, age) VALUES(?,?,?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password, $firstName, $lastName, $birthday, $age]);

		if ($executeQuery) {
			return true;
		}

		else {
			return false;
		}

	}
	else {
		return false;
	}

	
}

function loginUser($pdo, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $password]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['username'] = $user['username'];
        $_SESSION['userID'] = $user['userID'];
        return true;
    } else {
        return false;
    }
}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM users";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $userID) {
    $sql = "SELECT * FROM users WHERE userID = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$userID])) {
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    } else {
        return false;
    }
}

function getUserByUsername($pdo, $username) {
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

?>
