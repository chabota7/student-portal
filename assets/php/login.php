<?php
require_once '../../includes/config.php';
require_once '../../includes/auth.php';

if (is_logged_in()) {
    header('Location: ' . BASE_URL . '/assets/php/portal.php');
    exit;
}

$error = '';
$student_number = '';
$flash_success = $_SESSION['flash_success'] ?? null;
unset($_SESSION['flash_success']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_number = trim($_POST['student_number'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($student_number === '' || $password === '') {
        $error = 'Please enter your student number and password.';
    } else {
        $stmt = $conn->prepare('SELECT id, first_name, password_hash FROM students WHERE student_id = ?');
        $stmt->bind_param('s', $student_number);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int) $user['id'];
            $_SESSION['user_name'] = $user['first_name'];
            header('Location: ' . BASE_URL . '/assets/php/portal.php');
            exit;
        }
        $error = 'Invalid student number or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Group 10</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/login.css">
</head>
<body>
  <div class="login-card">
    <div class="login-header">
      <h2>Login</h2>
      <div class="title-underline"></div>
    </div>

    <?php if ($flash_success): ?>
      <div style="background:#198754;color:#fff;padding:10px;border-radius:6px;margin-bottom:15px;"><?php echo e($flash_success); ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div style="background:#dc3545;color:#fff;padding:10px;border-radius:6px;margin-bottom:15px;"><?php echo e($error); ?></div>
    <?php endif; ?>

    <form method="post" action="" novalidate>
      <div class="form-group">
        <label for="student_number">Student Number</label>
        <div class="input-wrapper">
          <i class="fa-solid fa-user icon"></i>
          <input type="text" id="student_number" name="student_number"
                 placeholder="Enter student number" value="<?php echo e($student_number); ?>" autocomplete="off">
        </div>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <div class="input-wrapper">
          <i class="fa-solid fa-lock icon"></i>
          <input type="password" id="password" name="password" placeholder="Enter password">
          <i class="fa-solid fa-eye toggle-password" id="togglePassword"></i>
        </div>
      </div>

      <button type="submit" class="submit-btn"><span>Sign In</span></button>
    </form>

    <p style="text-align:center;margin-top:15px;color:aqua">
      No account? <a href="<?php echo BASE_URL; ?>/assets/php/registration.php" style="color:gold;font-weight:bold;">Register here</a>
    </p>
  </div>

  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      var p = document.getElementById('password');
      p.type = p.type === 'password' ? 'text' : 'password';
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  </script>
</body>
</html>