<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_login();

$index_url = BASE_URL . '/assets/php/index.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: ' . $index_url);
    exit;
}

$stmt = $conn->prepare(
    'SELECT id, student_id, first_name, last_name, programme, `year`, email, phone
     FROM students WHERE id = ?'
);
$stmt->bind_param('i', $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$student) {
    $_SESSION['flash_error'] = 'Student not found.';
    header('Location: ' . $index_url);
    exit;
}

// If a previous save failed validation, show what they typed plus the errors
$errors = $_SESSION['form_errors'] ?? [];
$old = $_SESSION['form_old'] ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_old']);
$values = array_merge($student, $old);

$programmes = [
    'BSc Cyber Security',
    'BSc Software Engineering',
    'BSc Data Science',
    'BSc Information Technology',
    'BSc Computer Science',
];

$page_title = 'Edit Student';
include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<main class="flex-grow-1">
    <div class="container px-3 my-4 my-md-5" style="max-width: 760px;">
        <h1 class="h3 mb-3">Edit Student</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" action="<?php echo BASE_URL; ?>/actions/student-action.php" novalidate>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo (int) $student['id']; ?>">

            <div class="row g-3 mb-3">
                <div class="col-12">
                    <label for="student_id" class="form-label small">Student ID</label>
                    <input type="text" class="form-control bg-secondary text-white border-0" id="student_id" name="student_id" value="<?php echo e($values['student_id']); ?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <label for="first_name" class="form-label small">First Name</label>
                    <input type="text" class="form-control bg-secondary text-white border-0" id="first_name" name="first_name" value="<?php echo e($values['first_name']); ?>">
                </div>
                <div class="col-12 col-md-6">
                    <label for="last_name" class="form-label small">Last Name</label>
                    <input type="text" class="form-control bg-secondary text-white border-0" id="last_name" name="last_name" value="<?php echo e($values['last_name']); ?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <label for="email" class="form-label small">Email</label>
                    <input type="email" class="form-control bg-secondary text-white border-0" id="email" name="email" value="<?php echo e($values['email']); ?>">
                </div>
                <div class="col-12 col-md-6">
                    <label for="phone" class="form-label small">Phone</label>
                    <input type="text" class="form-control bg-secondary text-white border-0" id="phone" name="phone" value="<?php echo e($values['phone']); ?>">
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-md-6">
                    <label for="programme" class="form-label small">Degree Programme</label>
                    <select class="form-select bg-secondary text-white border-0" id="programme" name="programme">
                        <option value="">Select Programme</option>
                        <?php foreach ($programmes as $p): ?>
                            <option value="<?php echo e($p); ?>" <?php echo $values['programme'] === $p ? 'selected' : ''; ?>>
                                <?php echo e(str_replace('BSc ', '', $p)); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="year" class="form-label small">Year of Study</label>
                    <select class="form-select bg-secondary text-white border-0" id="year" name="year">
                        <option value="">Select Year</option>
                        <?php for ($y = 1; $y <= 4; $y++): ?>
                            <option value="<?php echo $y; ?>" <?php echo (string) $values['year'] === (string) $y ? 'selected' : ''; ?>><?php echo $y; ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-warning fw-bold px-4">Save Changes</button>
            <a href="<?php echo $index_url; ?>" class="btn btn-outline-light ms-2">Cancel</a>
        </form>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>