CREATE DATABASE Hospital CHARACTER SET utf8 COLLATE utf8_general_ci;
USE Hospital;

CREATE TABLE Address (
  address_id INT NOT NULL AUTO_INCREMENT,
  address_name VARCHAR(200),
  city_name VARCHAR(200),
  state_name VARCHAR(200),
  PRIMARY KEY (address_id)
);

CREATE TABLE Staff (
  staff_id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  title VARCHAR(50) NOT NULL,
  email VARCHAR(100),
  phone_number VARCHAR(20),
  address_id INT NOT NULL,
  PRIMARY KEY (staff_id),
  FOREIGN KEY (address_id) REFERENCES Address(address_id)
);

CREATE TABLE Patient (
  patient_id INT NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  date_of_birth DATE NOT NULL,
  gender ENUM('Male', 'Female') NOT NULL,
  medical_history TEXT,
  current_medical_issues TEXT,
  allergies TEXT,
  email VARCHAR(100),
  phone_number VARCHAR(20),
  address_id INT NOT NULL,
  PRIMARY KEY (patient_id),
  FOREIGN KEY (address_id) REFERENCES Address(address_id) ON DELETE CASCADE
);

CREATE TABLE Event (
  event_id INT NOT NULL AUTO_INCREMENT,
  patient_id INT NOT NULL,
  event_type ENUM('Visit', 'Checkup', 'Surgery', 'Appointment', 'Hospitalization') NOT NULL,
  event_date DATETIME NOT NULL,
  event_end DATETIME,
  PRIMARY KEY (event_id),
  FOREIGN KEY (patient_id) REFERENCES Patient(patient_id) ON DELETE CASCADE
);

CREATE TABLE Event_Staff (
  event_id INT NOT NULL,
  staff_id INT NOT NULL,
  FOREIGN KEY (event_id) REFERENCES Event(event_id),
  FOREIGN KEY (staff_id) REFERENCES Staff(staff_id)
);

CREATE TABLE Medication (
  medication_id INT NOT NULL AUTO_INCREMENT,
  medication_name VARCHAR(100) NOT NULL,
  dosage VARCHAR(50) NOT NULL,
  frequency VARCHAR(50) NOT NULL,
  start_date DATE NOT NULL,
  end_date DATE NOT NULL,
  price DECIMAL(8,2) NOT NULL,
  PRIMARY KEY (medication_id)
);

CREATE TABLE Treatment (
  treatment_id INT NOT NULL AUTO_INCREMENT,
  treatment_name VARCHAR(100) NOT NULL,
  treatment_date DATETIME NOT NULL,
  description VARCHAR(250),
  price DECIMAL(8,2) NOT NULL,
  PRIMARY KEY (treatment_id)
);

CREATE TABLE Event_Med_Tre (
  event_id INT NOT NULL,
  medication_id INT,
  treatment_id INT,
  FOREIGN KEY (event_id) REFERENCES Event(event_id),
  FOREIGN KEY (medication_id) REFERENCES Medication(medication_id),
  FOREIGN KEY (treatment_id) REFERENCES Treatment(treatment_id)
);



INSERT INTO Address (address_name, city_name, state_name)
VALUES ('123 Main St', 'New York', 'New York'),
       ('456 Elm St', 'Los Angeles', 'California'),
       ('789 Oak St', 'Chicago', 'Illinois'),
       ('111 Maple St', 'Miami', 'Florida'),
       ('222 Pine St', 'Houston', 'Texas'),
       ('333 Palm St', 'Phoenix', 'Arizona'),
       ('444 Birch St', 'Seattle', 'Washington'),
       ('555 Cedar St', 'Denver', 'Colorado'),
       ('666 Spruce St', 'Boston', 'Massachusetts'),
       ('777 Magnolia St', 'Atlanta', 'Georgia'),
       ('888 Cherry St', 'San Francisco', 'California'),
       ('999 Walnut St', 'Philadelphia', 'Pennsylvania'),
       ('111 Willow St', 'Washington D.C.', 'District of Columbia'),
       ('1010 Park Ave', 'New York', 'New York');

INSERT INTO Staff (first_name, last_name, title, email, phone_number, address_id)
VALUES ('John', 'Doe', 'Doctor', 'john.doe@gmail.com', '123-456-7890', 11),
       ('Jane', 'Smith', 'Nurse', 'jane.smith@gmail.com', '456-789-0123', 12),
       ('Bob', 'Johnson', 'Doctor', 'bob.johnson@gmail.com', '789-012-3456', 13);

INSERT INTO Patient (first_name, last_name, date_of_birth, gender, medical_history, current_medical_issues, allergies, email, phone_number, address_id)
VALUES ('Alice', 'Johnson', '1990-01-01', 'Female', 'None', 'Flu', 'Penicillin', 'alice.johnson@gmail.com', '111-222-3333', 1),
       ('Charlie', 'Brown', '2000-02-02', 'Male', 'Asthma', 'None', 'Peanuts', 'charlie.brown@gmail.com', '222-333-4444', 2),
       ('David', 'Smith', '1985-03-03', 'Male', 'Diabetes', 'High Blood Pressure', 'None', 'david.smith@gmail.com', '333-444-5555', 3),
       ('Emily', 'Davis', '1995-04-04', 'Female', 'None', 'None', 'None', 'emily.davis@gmail.com', '444-555-6666', 4),
       ('Frank', 'Miller', '1970-05-05', 'Male', 'Heart Disease', 'None', 'None', 'frank.miller@gmail.com', '555-666-7777', 5),
       ('Grace', 'Williams', '1980-06-06', 'Female', 'None', 'None', 'None', 'grace.williams@gmail.com', '666-777-8888', 6),
       ('Henry', 'Taylor', '1997-07-07', 'Male', 'None', 'None', 'None', 'henry.taylor@gmail.com', '777-888-9999', 7),
       ('Ivy', 'Moore', '2005-08-08', 'Female', 'None', 'None', 'None', 'ivy.moore@gmail.com', '888-999-0000', 8),
       ('James', 'Clark', '1960-09-09', 'Male', 'None', 'None', 'None', 'james.clark@gmail.com', '999-000-1111', 9),
       ('Karen', 'Hill', '1975-10-10', 'Female', 'None', 'None', 'None', 'karen.hill@gmail.com', '000-111-2222', 10),
       ('Olivia', 'Taylor', '1992-03-15', 'Female', 'None', 'None', 'None', 'olivia.taylor@gmail.com', '111-222-3333', 14);


INSERT INTO Event (patient_id, event_type, event_date, event_end)
VALUES (1, 'Visit', '2024-01-01 10:00:00', '2024-01-01 11:00:00'),
       (2, 'Checkup', '2024-01-02 14:00:00', '2024-01-02 15:00:00'),
       (3, 'Surgery', '2024-01-03 08:00:00', '2024-01-03 12:00:00'),
       (4, 'Appointment', '2024-01-04 10:00:00', '2024-01-04 11:00:00'),
       (5, 'Checkup', '2024-01-05 14:00:00', '2024-01-05 15:00:00'),
       (6, 'Surgery', '2024-01-06 08:00:00', '2024-01-06 12:00:00'),
       (7, 'Visit', '2024-01-07 10:00:00', '2024-01-07 11:00:00'),
       (8, 'Checkup', '2024-01-08 14:00:00', '2024-01-08 15:00:00'),
       (9, 'Surgery', '2024-01-09 08:00:00', '2024-01-09 12:00:00'),
       (10, 'Appointment', '2024-01-10 10:00:00', '2024-01-10 11:00:00'),
       (11, 'Hospitalization', '2024-01-15 08:00:00', NULL);

INSERT INTO Event_Staff (event_id, staff_id)
VALUES (1, 1),
       (2, 2),
       (3, 1),
       (3, 2),
       (4, 1),
       (5, 2),
       (6, 2),
       (6, 3),
       (7, 1),
       (8, 2),
       (9, 1),
       (9, 2),
       (9, 3),
       (10, 1);

INSERT INTO Medication (medication_name, dosage, frequency, start_date, end_date, price)
VALUES ('Ibuprofen', '200mg', '3 times a day', '2024-01-01', '2024-01-07', 10.00),
       ('Amoxicillin', '500mg', '2 times a day', '2024-01-02', '2024-01-09', 20.00),
       ('Insulin', '10 units', 'once a day', '2024-01-03', '2024-12-31', 50.00);

INSERT INTO Treatment (treatment_name, treatment_date, description, price)
VALUES ('Flu Shot', '2024-01-01', 'Preventative care', 30.00),
       ('Asthma Treatment', '2024-01-02', 'Inhaler and nebulizer treatment', 40.00),
       ('Blood Pressure Check', '2024-01-03', 'Monitoring and medication adjustment', 20.00);

INSERT INTO Event_Med_Tre (event_id, medication_id, treatment_id)
VALUES (1, 1, NULL),
       (2, NULL, 2),
       (3, NULL, 3),
       (4, 1, NULL),
       (5, NULL, NULL),
       (6, 2, NULL),
       (7, 1, NULL),
       (8, NULL, 2),
       (9, NULL, 3),
       (10, 1, NULL),
       (11, 1, NULL);