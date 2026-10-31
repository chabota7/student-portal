CREATE DATABASE IF NOT EXISTS g_2_10_portal_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE g_2_10_portal_db;

DROP TABLE IF EXISTS grades;
DROP TABLE IF EXISTS students;

CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id VARCHAR(20) NOT NULL UNIQUE,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  programme VARCHAR(100) NOT NULL,
  `year` INT NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  phone VARCHAR(20) NOT NULL,
  password_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE grades (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  course_code VARCHAR(20) NOT NULL,
  assessment_name VARCHAR(50) NOT NULL,
  score DECIMAL(5,2) NOT NULL,
  academic_year VARCHAR(9) NOT NULL,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
) ENGINE=InnoDB;

INSERT INTO students
  (student_id, first_name, last_name, programme, `year`, email, phone, password_hash)
VALUES
  ('202104321', 'Steve', 'Rodger', 'BSc Computer Science', 2, 'steve@example.com', '0971000001', '$2y$10$bpINeYZCA2vMEv0VGoVtFeng5LjXEqGrY2CgvzEJRCnak2ygUO.j6'),
  ('202205432', 'Tony', 'Stark', 'BSc Information Technology', 2, 'tony@example.com', '0971000002', '$2y$10$lQbuXojp.MsiEo9v0DuToerKvicdMVvk1Eg5RQzO2/36pNAtU.OLK'),
  ('202306543', 'Natasha', 'Romanoff', 'BSc Data Science', 1, 'natasha@example.com', '0971000003', '$2y$10$h5vjSrnZDxW2wdDx1NhGzOpUqJmcHkDTLx0/QEIXhuT01Em6VOCB.');

INSERT INTO grades
  (student_id, course_code, assessment_name, score, academic_year)
VALUES
  (1, 'CAS382', 'Assignment 1', 78.00, '2026/2027'),
  (1, 'CIT111', 'Test 1', 65.00, '2026/2027'),
  (1, 'CCS121', 'Assignment 1', 82.00, '2026/2027'),
  (1, 'CAS382', 'Test 1', 71.00, '2026/2027'),
  (2, 'CAS382', 'Assignment 1', 69.00, '2026/2027'),
  (2, 'CIT111', 'Test 1', 74.00, '2026/2027'),
  (2, 'CCS121', 'Assignment 1', 80.00, '2026/2027'),
  (3, 'CAS382', 'Assignment 1', 88.00, '2026/2027'),
  (3, 'CIT111', 'Test 1', 76.00, '2026/2027'),
  (3, 'CCS121', 'Assignment 1', 91.00, '2026/2027');