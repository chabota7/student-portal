# Student Portal - CCS2112 Tutorial 4

PHP, MySQL, CRUD and Authentication
Class Group 2, Assignment Group 10

## Group Members
- Chabota Mweetwa - 202500172
- Michael Judge - 202500911
- Buya Mukolo - 202500723
- Panuel Sibanda - 20202582
- Thokozile Banda - 202505196
- Soonfa Wakasaka - 202503846

## Requirements
- XAMPP (Apache 2.4 and MySQL running, PHP 8.2)
- A web browser

## Setup
1. Copy the `student-portal` folder to `C:\xampp\htdocs\`.
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Open http://localhost/phpmyadmin and click Import.
4. Choose `database_setup.sql` from the project folder and click Import. This creates the database `g_2_10_portal_db`, the `students` and `grades` tables, and the sample data.
5. Database settings are in `includes/config.php` (user `root`, no password).
6. Open http://localhost/student-portal/assets/php/login.php

## Sample Login (fictional data)
All three sample students use the password `Test1234`.
- Student number 202104321 (Steve Rodgers)
- Student number 202205432 (Tony Stark)
- Student number 202306543 (Natasha Romanoff)

Passwords are stored in the database as hashes created with `password_hash()` and checked with `password_verify()`. They are never stored as plain text.

## Features
- Registration with client-side (JavaScript) and server-side (PHP) validation
- Login and logout using PHP sessions
- Protected pages redirect to the login page when logged out
- Students page with Bootstrap table, Add, Edit and Delete (with confirmation)
- Grades page using an SQL JOIN, with a filter by student
- Shared header, navbar and footer, responsive Bootstrap layout

## Folder Structure
- `actions/` - student-action.php (update and delete handler)
- `assets/css/` - style.css and login.css
- `assets/js/` - registration.js
- `assets/php/` - registration, login, logout, portal, index (students), edit_student, grades
- `includes/` - config.php, auth.php, header.php, navbar.php, footer.php
- `database_setup.sql` - creates the tables and inserts the sample data