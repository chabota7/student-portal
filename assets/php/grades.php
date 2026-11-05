<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_login();

$page_title = 'Grades';

// Students for the filter dropdown
$students = $conn->query(
    'SELECT id, first_name, last_name FROM students ORDER BY first_name, last_name'
)->fetch_all(MYSQLI_ASSOC);

// Selected student (internal id). null = not given, false = invalid
$filter_id = filter_input(INPUT_GET, 'student', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

$sql = 'SELECT g.id, s.first_name, s.last_name, g.course_code, g.assessment_name, g.score, g.academic_year
        FROM grades g
        JOIN students s ON g.student_id = s.id';

if ($filter_id) {
    $stmt = $conn->prepare($sql . ' WHERE g.student_id = ? ORDER BY g.course_code, g.assessment_name');
    $stmt->bind_param('i', $filter_id);
    $stmt->execute();
    $grades = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    $grades = $conn->query($sql . ' ORDER BY s.first_name, s.last_name, g.course_code, g.assessment_name')
                   ->fetch_all(MYSQLI_ASSOC);
}

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<main class="flex-grow-1">
    <div class="container px-3 my-4 my-md-5">
        <h1 class="h3 mb-3">Student Grades</h1>

        <form method="get" class="row g-2 align-items-end mb-4">
            <div class="col-12 col-md-5 col-lg-4">
                <label for="student" class="form-label small">Filter by student</label>
                <select class="form-select bg-secondary text-white border-0" id="student" name="student">
                    <option value="">All students</option>
                    <?php foreach ($students as $s): ?>
                        <option value="<?php echo (int) $s['id']; ?>" <?php echo ((int) $filter_id === (int) $s['id']) ? 'selected' : ''; ?>>
                            <?php echo e($s['first_name'] . ' ' . $s['last_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-warning fw-bold">Filter</button>
                <a href="<?php echo BASE_URL; ?>/assets/php/grades.php" class="btn btn-outline-light ms-1">Clear</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Course Code</th>
                        <th>Assessment</th>
                        <th>Score</th>
                        <th>Academic Year</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($grades)): ?>
                        <tr><td colspan="5" class="text-center text-secondary">No grades found.</td></tr>
                    <?php endif; ?>

                    <?php foreach ($grades as $g): ?>
                        <tr>
                            <td><?php echo e($g['first_name'] . ' ' . $g['last_name']); ?></td>
                            <td><?php echo e($g['course_code']); ?></td>
                            <td><?php echo e($g['assessment_name']); ?></td>
                            <td><?php echo e(number_format((float) $g['score'], 2)); ?></td>
                            <td><?php echo e($g['academic_year']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include '../../includes/footer.php'; ?>