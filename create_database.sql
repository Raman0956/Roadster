CREATE DATABASE roadster;
USE roadster;
CREATE TABLE User (
    userID INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('Client', 'Admin') NOT NULL
);

CREATE TABLE CarInventory (
    carID INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(50) NOT NULL,
    model VARCHAR(50) NOT NULL,
    year INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category ENUM('SUV', 'Sedan', 'Truck', 'Coupe', 'Convertible') NOT NULL,
    leaseOption BOOLEAN,
    financeOption BOOLEAN,
    available BOOLEAN DEFAULT TRUE
);

CREATE TABLE Service (
    serviceID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    promotion BOOLEAN DEFAULT FALSE
);

CREATE TABLE FavoriteCars (
    favoriteID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    carID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES User(userID) ON DELETE CASCADE,
    FOREIGN KEY (carID) REFERENCES CarInventory(carID) ON DELETE CASCADE
);

CREATE TABLE TestDriveBooking (
    bookingID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    carID INT NOT NULL,
    preferredDate DATE NOT NULL,
    preferredTime TIME NOT NULL,
    status ENUM('Pending', 'Approved', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (userID) REFERENCES User(userID) ON DELETE CASCADE,
    FOREIGN KEY (carID) REFERENCES CarInventory(carID) ON DELETE CASCADE
);

CREATE TABLE Inquiry (
    inquiryID INT AUTO_INCREMENT PRIMARY KEY,
    userID INT NOT NULL,
    carID INT,
    serviceID INT,
    message TEXT NOT NULL,
    response TEXT,
    status ENUM('Pending', 'Answered') DEFAULT 'Pending',
    FOREIGN KEY (userID) REFERENCES User(userID) ON DELETE CASCADE,
    FOREIGN KEY (carID) REFERENCES CarInventory(carID) ON DELETE SET NULL,
    FOREIGN KEY (serviceID) REFERENCES Service(serviceID) ON DELETE SET NULL
);
