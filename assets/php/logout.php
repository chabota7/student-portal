<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';

$_SESSION = [];
session_destroy();

header('Location: ' . BASE_URL . '/assets/php/login.php');
exit;