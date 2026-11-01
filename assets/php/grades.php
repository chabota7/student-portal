<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_login();

$page_title = 'Grades';
include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<main class="flex-grow-1">
    <div class="container px-3 my-4">
        <h1 class="h3">Grades</h1>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>