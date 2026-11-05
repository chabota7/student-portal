<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';


$programmes = [
    'BSc Cyber Security',
    'BSc Software Engineering',
    'BSc Data Science',
    'BSc Information Technology',
    'BSc Computer Science',
];

$errors = [];
$old = [
    'student_id' => '', 'first_name' => '', 'last_name' => '',
    'email' => '', 'phone' => '', 'programme' => '', 'year' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['student_id'] ?? '');
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name  = trim($_POST['last_name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $programme  = trim($_POST['programme'] ?? '');
    $year       = trim($_POST['year'] ?? '');
    $password   = $_POST['password'] ?? '';
    $confirm    = $_POST['confirm_password'] ?? '';

    // Keep what they typed (never the passwords)
    $old = [
        'student_id' => $student_id, 'first_name' => $first_name,
        'last_name' => $last_name, 'email' => $email, 'phone' => $phone,
        'programme' => $programme, 'year' => $year,
    ];

    // --- Validation (same rules as registration.js) ---
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
        $errors['year'] = 'Please select your year of study.';
    }
    if (strlen($password) < 6 || !preg_match('/\d/', $password)) {
        $errors['password'] = 'Password must have at least 6 characters and one number.';
    }
    if ($password !== $confirm) {
        $errors['confirm_password'] = 'Passwords do not match.';
    }

    // --- Duplicate check (prepared statement) ---
    if (empty($errors)) {
        $stmt = $conn->prepare('SELECT student_id, email FROM students WHERE student_id = ? OR email = ?');
        $stmt->bind_param('ss', $student_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            if ($row['student_id'] === $student_id) {
                $errors['student_id'] = 'That Student ID is already registered.';
            }
            if (strcasecmp($row['email'], $email) === 0) {
                $errors['email'] = 'That email is already registered.';
            }
        }
        $stmt->close();
    }

    // --- Save (prepared statement, hashed password) ---
    if (empty($errors)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $year_int = (int) $year;

        try {
            $stmt = $conn->prepare(
                'INSERT INTO students (student_id, first_name, last_name, programme, `year`, email, phone, password_hash)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->bind_param('ssssisss', $student_id, $first_name, $last_name, $programme, $year_int, $email, $phone, $hash);
            $stmt->execute();
            $stmt->close();

            $_SESSION['flash_success'] = 'Registration successful! Please log in.';
            header('Location: ' . BASE_URL . '/assets/php/login.php');
            exit;
        } catch (mysqli_sql_exception $ex) {
            $errors['general'] = 'Sorry, we could not save your registration. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration - Group 10</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-dark text-light">

    <div class="container-fluid min-vh-100 p-0">
        <div class="row g-0 min-vh-100">
            
            <!-- Left Panel -->
            <aside class="col-12 col-lg-5 left-panel p-4 p-md-5 d-flex flex-column justify-content-center">
                <div class="logo mb-4">
                    <img src="../../logo.png" alt="University Logo" class="img-fluid rounded-circle" style="max-width: 120px;">
                </div>
                <h2 class="fw-bold mb-3 text-white">Welcome to the Student Portal</h2>
                <ul class="list-unstyled mb-4">
                    <li class="h4 text-warning border-bottom border-secondary pb-2"><u>GROUP 10</u></li>
                    <li class="py-1">• Access Online materials</li>
                    <li class="py-1">• Manage your registration</li>
                    <li class="py-1">• Contact staff</li>
                </ul>

                <div class="group-members p-3 rounded">
                    <h3 class="h5 text-warning mb-2">Group Members</h3>
                    <p class="mb-1">Chabota Mweetwa - 202500172</p>
                    <p class="mb-1">Michael Judge - 202500911</p>
                    <p class="mb-1">Buya Mukolo - 202500723</p>
                    <p class="mb-1">Panuel Sibanda - 20202582</p>
                    <p class="mb-1">Thokozile Banda - 202505196</p>
                    <p class="mb-1">Soonfa Wakasaka - 202503846</p>
                    <!-- <p class="mb-1">Steve Petulu - 202402856</p> -->
                </div>
            </aside>

            <!-- Right Panel / Form Section -->
            <main class="col-12 col-lg-7 right-panel p-4 p-md-5 d-flex flex-column justify-content-center">
                <h1 class="h2 text-warning fw-bold mb-2">Create Student Account</h1>
                <p class="text-secondary mb-4">Already Enrolled? <a href="assets/php/portal.html" class="text-warning text-decoration-underline fw-bold">Log In to Portal</a></p>
                
                <button class="btn btn-outline-light w-100 mb-3 py-2" type="button">Continue with Google/SSO</button>
                
                <div class="d-flex align-items-center my-3">
                    <hr class="flex-grow-1 border-secondary">
                    <span class="px-3 text-secondary small">OR</span>
                    <hr class="flex-grow-1 border-secondary">
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>   

                <form id="registrationForm" method="post" action="" novalidate>
                    
                    <!-- Row 1: ID & Name -->
                <div class="row g-3 mb-3">
                    <div class="col-12">

                        <label for="studentId" class="form-label text-light small">Student ID</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" id="studentId" name="student_id" value="<?php echo e($old['student_id']); ?>">
                        <span class="text-danger small" id="studentIdError"></span>
                    </div>
                </div>
                      
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label for="firstName" class="form-label text-light small">First Name</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" id="firstName" name="first_name" value="<?php echo e($old['first_name']); ?>">
                        <span class="text-danger small" id="firstNameError"></span>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="lastName" class="form-label text-light small">Last Name</label>
                        <input type="text" class="form-control bg-secondary text-white border-0" id="lastName" name="last_name" value="<?php echo e($old['last_name']); ?>">
                        <span class="text-danger small" id="lastNameError"></span>
                    </div>    
                </div>    


                    <!-- Row 2: Email & Phone -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label text-light small">Email</label>
                            <input type="email" class="form-control bg-secondary text-white border-0" id="email" name="email" value="<?php echo e($old['email']); ?>">
                            <span class="text-danger small" id="emailError"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="phone" class="form-label text-light small">Phone</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" id="phone" name="phone" value="<?php echo e($old['phone']); ?>">
                            <span class="text-danger small" id="phoneError"></span>
                        </div>
                    </div>

                    <!-- Row 3: Programme & Year -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="programme" class="form-label text-light small">Degree Programme</label>
                            <select class="form-select bg-secondary text-white border-0" id="programme" name="programme">
                            <option value="">Select Programme</option>
                            <?php foreach ($programmes as $p): ?>
                                <option value="<?php echo e($p); ?>" <?php echo $old['programme'] === $p ? 'selected' : ''; ?>>
                                    <?php echo e(str_replace('BSc ', '', $p)); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                            <span class="text-danger small" id="programmeError"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="year" class="form-label text-light small">Year of Study</label>
                            <select class="form-select bg-secondary text-white border-0" id="year" name="year">
                            <option value="">Select Year</option>
                            <?php for ($y = 1; $y <= 4; $y++): ?>
                                <option value="<?php echo $y; ?>" <?php echo $old['year'] === (string) $y ? 'selected' : ''; ?>><?php echo $y; ?></option>
                            <?php endfor; ?>
                        </select>
                            <span class="text-danger small" id="yearError"></span>
                        </div>
                    </div>

                    <!-- Row 4: Passwords -->
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label text-light small">Password</label>
                            <input type="password" class="form-control bg-secondary text-white border-0" id="password" name="password">
                            <span class="text-danger small" id="passwordError"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="confirmPassword" class="form-label text-light small">Confirm Password</label>
                            <input type="password" class="form-control bg-secondary text-white border-0" id="confirmPassword" name="confirm_password">
                            <span class="text-danger small" id="confirmPasswordError"></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-2 fw-bold">Complete Registration</button>
                </form>

                <div id="message" class="mt-3 text-center fw-bold"></div>
            </main>

        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS Validation File -->
    <script src="../js/registration.js"></script>
</body>
</html>