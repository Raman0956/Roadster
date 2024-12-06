-- Use the roadster database
USE roadster;

-- Insert sample data into User table
INSERT INTO User (username, password, email, role) VALUES
('alice_client', 'hashedpassword1', 'alice@example.com', 'Client'),
('bob_admin', 'hashedpassword2', 'bob@example.com', 'Admin'),
('charlie_client', 'hashedpassword3', 'charlie@example.com', 'Client');

-- Insert sample data into CarInventory table
INSERT INTO CarInventory (make, model, year, price, category, leaseOption, financeOption, available) VALUES
('Nissan', 'Altima', 2021, 24000.00, 'Sedan', TRUE, TRUE, TRUE),
('Jeep', 'Wrangler', 2020, 32000.00, 'SUV', TRUE, TRUE, TRUE),
('Tesla', 'Model 3', 2023, 55000.00, 'Sedan', FALSE, TRUE, TRUE),
('Mercedes-Benz', 'C-Class', 2021, 42000.00, 'Sedan', TRUE, TRUE, TRUE),
('Audi', 'Q7', 2019, 50000.00, 'SUV', TRUE, FALSE, TRUE),
('Hyundai', 'Elantra', 2022, 21000.00, 'Sedan', TRUE, TRUE, TRUE),
('Ford', 'Mustang', 2021, 47000.00, 'Coupe', TRUE, FALSE, TRUE),
('Chevrolet', 'Silverado', 2020, 40000.00, 'Truck', TRUE, TRUE, TRUE),
('Honda', 'CR-V', 2021, 31000.00, 'SUV', TRUE, TRUE, TRUE),
('Mazda', 'MX-5 Miata', 2022, 28000.00, 'Convertible', FALSE, TRUE, TRUE);


-- Insert sample data into Service table
INSERT INTO Service (name, description, price, promotion) VALUES
('Oil Change', 'Complete oil change with high-quality synthetic oil', 49.99, FALSE),
('Tire Rotation', 'Rotation and balance for all four tires', 29.99, FALSE),
('Detailing Package', 'Complete interior and exterior detailing', 199.99, TRUE),
('Winterization', 'Prepare your car for winter with antifreeze and tire check', 99.99, TRUE);

-- Insert sample data into FavoriteCars table
INSERT INTO FavoriteCars (userID, carID) VALUES
(1, 1), -- Alice favorite Toyota Corolla
(1, 2), -- Alice favorite Ford F-150
(3, 4), -- Charlie favorite BMW X5
(3, 5); -- Charlie favorite Chevrolet Camaro

-- Insert sample data into TestDriveBooking table
INSERT INTO TestDriveBooking (userID, carID, preferredDate, preferredTime, status) VALUES
(1, 1, '2024-11-15', '10:00:00', 'Pending'),
(3, 4, '2024-11-20', '14:30:00', 'Approved'),
(1, 2, '2024-11-22', '16:00:00', 'Completed');

-- Insert sample data into Inquiry table
    INSERT INTO Inquiry (userID, carID, serviceID, message, response, status) VALUES
    (1, 1, NULL, 'I am interested in leasing options for the Toyota Corolla.', 'We offer a 36-month lease option.', 'Answered'),
    (3, 2, 1, 'Can I book an oil change for my Ford F-150?', 'Yes, please book it via our service page.', 'Answered'),
    (1, 3, NULL, 'Is the Honda Civic still available?', NULL, 'Pending');
