CREATE TABLE users (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255),
    password VARCHAR(255),
    firstName VARCHAR(255),
    lastName VARCHAR(255),
    birthday DATE,
    age INT,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Pets (
  PetID INT auto_increment PRIMARY KEY,
  petName VARCHAR(50),
  species VARCHAR(50),
  breed VARCHAR(50),
  dateOfBirth DATE,
  gender VARCHAR(10),
  date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  added_by INT,
  last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  updated_by INT,
  FOREIGN KEY (added_by) REFERENCES users(userID),
  FOREIGN KEY (updated_by) REFERENCES users(userID)
);

CREATE TABLE Appointments (
    AppointmentID INT auto_increment PRIMARY KEY,
    PetID INT,
    appointmentDate DATE,
    appointmentTime TIME,
    description VARCHAR(255),
    status VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    added_by INT,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    updated_by INT,
    FOREIGN KEY (added_by) REFERENCES users(userID),
    FOREIGN KEY (updated_by) REFERENCES users(userID)
);
