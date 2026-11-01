<?php
$current_page = basename($_SERVER['PHP_SELF']);
$user_name = $_SESSION['user_name'] ?? 'Student';
$pages = BASE_URL . '/assets/php';
?>
<nav class="navbar navbar-expand-lg border-bottom border-secondary sticky-top">
    <div class="container-fluid px-3 px-lg-4">
        <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="<?php echo $pages; ?>/portal.php">
            <img src="<?php echo BASE_URL; ?>/logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top rounded-circle">
            <span>ZCASU Portal</span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav text-center text-lg-start mt-2 mt-lg-0 align-items-lg-center">
                <li class="nav-item mx-lg-2">
                    <a class="nav-link fw-semibold <?php echo $current_page === 'portal.php' ? 'active' : ''; ?>" href="<?php echo $pages; ?>/portal.php">Home</a>
                </li>
                <li class="nav-item mx-lg-2">
                    <a class="nav-link fw-semibold <?php echo $current_page === 'index.php' ? 'active' : ''; ?>" href="<?php echo $pages; ?>/index.php">Students</a>
                </li>
                <li class="nav-item mx-lg-2">
                    <a class="nav-link fw-semibold <?php echo $current_page === 'grades.php' ? 'active' : ''; ?>" href="<?php echo $pages; ?>/grades.php">Grades</a>
                </li>
                <li class="nav-item mx-lg-2">
                    <span class="navbar-text fw-semibold">Hi, <?php echo htmlspecialchars($user_name); ?></span>
                </li>
                <li class="nav-item mx-lg-2">
                    <a class="nav-link fw-semibold text-danger" href="<?php echo $pages; ?>/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>