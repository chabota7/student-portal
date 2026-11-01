<?php
// Database settings (change only here, never in other files)
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'g_2_10_portal_db';

// Make mysqli throw errors we can catch
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    $conn->set_charset('utf8mb4');
} catch (mysqli_sql_exception $e) {
    die('Sorry, we could not connect to the database. Please try again later.');
}