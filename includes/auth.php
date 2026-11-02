<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . BASE_URL . '/assets/php/login.php');
        exit;
    }
}
function e($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}