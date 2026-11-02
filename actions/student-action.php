<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_login();

$index_url = BASE_URL . '/assets/php/index.php';

// Only accept form posts
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . $index_url);
    exit;
}

$action = $_POST['action'] ?? '';
$id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);

if (!$id) {
    $_SESSION['flash_error'] = 'Invalid student record.';
    header('Location: ' . $index_url);
    exit;
}

try {
    // ---------- DELETE ----------
    if ($action === 'delete') {
        if ($id === (int) $_SESSION['user_id']) {
            $_SESSION['flash_error'] = 'You cannot delete the account you are logged in with.';
            header('Location: ' . $index_url);
            exit;
        }

        $stmt = $conn->prepare('DELETE FROM students WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();

        if ($stmt->affected_rows === 1) {
            $_SESSION['flash_success'] = 'Student deleted.';
        } else {
            $_SESSION['flash_error'] = 'Student not found.';
        }
        $stmt->close();

        header('Location: ' . $index_url);
        exit;
    }

    // ---------- UPDATE ----------
    if ($action === 'update') {
        $programmes = [
            'BSc Cyber Security',
            'BSc Software Engineering',
            'BSc Data Science',
            'BSc Information Technology',
            'BSc Computer Science',
        ];

        $student_id = trim($_POST['student_id'] ?? '');
        $first_name = trim($_POST['first_name'] ?? '');
        $last_name  = trim($_POST['last_name'] ?? '');
        $email      = trim($_POST['email'] ?? '');
        $phone      = trim($_POST['phone'] ?? '');
        $programme  = trim($_POST['programme'] ?? '');
        $year       = trim($_POST['year'] ?? '');

        $old = [
            'student_id' => $student_id, 'first_name' => $first_name,
            'last_name' => $last_name, 'email' => $email, 'phone' => $phone,
            'programme' => $programme, 'year' => $year,
        ];

        $errors = [];
        if (!preg_match('/^\d{8,10}$/', $student_id)) {
            $errors['student_id'] = 'Student ID must be 8 to 10 digits.';
        }
        if (!preg_match("/^[A-Za-z' -]{2,50}$/", $first_name)) {
            $errors['first_name'] = 'First name must be 2 to 50 letters.';
        }
        if (!preg_match("/^[A-Za-z' -]{2,50}$/", $last_name)) {
            $errors['last_name'] = 'Last name must be 2 to 50 letters.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
            $errors['email'] = 'Enter a valid email address.';
        }
        if (!preg_match('/^\d{9,10}$/', $phone)) {
            $errors['phone'] = 'Phone number must be 9 to 10 digits.';
        }
        if (!in_array($programme, $programmes, true)) {
            $errors['programme'] = 'Please select a programme.';
        }
        if (!in_array($year, ['1', '2', '3', '4'], true)) {
            $errors['year'] = 'Please select a year of study.';
        }

        // Duplicate check, ignoring this student's own record
        if (empty($errors)) {
            $stmt = $conn->prepare(
                'SELECT student_id, email FROM students
                 WHERE (student_id = ? OR email = ?) AND id <> ?'
            );
            $stmt->bind_param('ssi', $student_id, $email, $id);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                if ($row['student_id'] === $student_id) {
                    $errors['student_id'] = 'That Student ID belongs to another student.';
                }
                if (strcasecmp($row['email'], $email) === 0) {
                    $errors['email'] = 'That email belongs to another student.';
                }
            }
            $stmt->close();
        }

        // Send them back to the form with the problems
        if (!empty($errors)) {
            $_SESSION['form_errors'] = $errors;
            $_SESSION['form_old'] = $old;
            header('Location: ' . BASE_URL . '/assets/php/edit_student.php?id=' . $id);
            exit;
        }

        $year_int = (int) $year;
        $stmt = $conn->prepare(
            'UPDATE students
             SET student_id = ?, first_name = ?, last_name = ?, programme = ?,
                 `year` = ?, email = ?, phone = ?
             WHERE id = ?'
        );
        $stmt->bind_param('ssssissi', $student_id, $first_name, $last_name, $programme, $year_int, $email, $phone, $id);
        $stmt->execute();
        $stmt->close();

        // Keep the navbar greeting correct if they edited themselves
        if ($id === (int) $_SESSION['user_id']) {
            $_SESSION['user_name'] = $first_name;
        }

        $_SESSION['flash_success'] = 'Student updated.';
        header('Location: ' . $index_url);
        exit;
    }

    // Unknown action
    header('Location: ' . $index_url);
    exit;

} catch (mysqli_sql_exception $ex) {
    $_SESSION['flash_error'] = 'Something went wrong while saving. Please try again.';
    header('Location: ' . $index_url);
    exit;
}