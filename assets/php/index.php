<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';
require_login();

$page_title = 'Students';

$result = $conn->query(
    'SELECT id, student_id, first_name, last_name, programme, `year`, email, phone
     FROM students ORDER BY id'
);
$students = $result->fetch_all(MYSQLI_ASSOC);

// One-time messages set by the action files
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

include '../../includes/header.php';
include '../../includes/navbar.php';
?>

<main class="flex-grow-1">
    <div class="container px-3 my-4 my-md-5">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <h1 class="h3 mb-0">Student Records</h1>
            <a href="<?php echo BASE_URL; ?>/assets/php/registration.php" class="btn btn-warning fw-bold">+ Add Student</a>
        </div>

        <?php if ($flash_success): ?>
            <div class="alert alert-success"><?php echo e($flash_success); ?></div>
        <?php endif; ?>
        <?php if ($flash_error): ?>
            <div class="alert alert-danger"><?php echo e($flash_error); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Programme</th>
                        <th>Year</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                        <tr><td colspan="8" class="text-center text-secondary">No students found.</td></tr>
                    <?php endif; ?>

                    <?php foreach ($students as $s): ?>
                        <tr>
                            <td><?php echo e($s['id']); ?></td>
                            <td><?php echo e($s['student_id']); ?></td>
                            <td><?php echo e($s['first_name'] . ' ' . $s['last_name']); ?></td>
                            <td><?php echo e($s['programme']); ?></td>
                            <td><?php echo e($s['year']); ?></td>
                            <td><?php echo e($s['email']); ?></td>
                            <td><?php echo e($s['phone']); ?></td>
                            <td class="text-end text-nowrap">
                                <a href="<?php echo BASE_URL; ?>/assets/php/edit_student.php?id=<?php echo (int) $s['id']; ?>"
                                   class="btn btn-sm btn-outline-warning">Edit</a>
                                <button type="button"
                                        class="btn btn-sm btn-outline-danger delete-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-id="<?php echo (int) $s['id']; ?>"
                                        data-name="<?php echo e($s['first_name'] . ' ' . $s['last_name']); ?>">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Delete confirmation modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content bg-dark text-light" method="post"
              action="<?php echo BASE_URL; ?>/actions/student-action.php">
            <div class="modal-header border-secondary">
                <h5 class="modal-title">Confirm delete</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <strong id="deleteName"></strong>?
                Their grades will be deleted too. This cannot be undone.
            </div>
            <div class="modal-footer border-secondary">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" id="deleteId" value="">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelectorAll('.delete-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.getElementById('deleteId').value = btn.dataset.id;
            document.getElementById('deleteName').textContent = btn.dataset.name;
        });
    });
</script>

<?php include '../../includes/footer.php'; ?>