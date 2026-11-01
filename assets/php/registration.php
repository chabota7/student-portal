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
                    <p class="mb-1">Steve Petulu - 202402856</p>
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

                <form id="registrationForm" novalidate>
                    
                    <!-- Row 1: ID & Name -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="studentId" class="form-label text-light small">Student ID</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" id="studentId">
                            <span class="text-danger small" id="studentIdError"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="fullName" class="form-label text-light small">Full Name</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" id="fullName">
                            <span class="text-danger small" id="fullNameError"></span>
                        </div>
                    </div>

                    <!-- Row 2: Email & Phone -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="email" class="form-label text-light small">Email</label>
                            <input type="email" class="form-control bg-secondary text-white border-0" id="email">
                            <span class="text-danger small" id="emailError"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="phone" class="form-label text-light small">Phone</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" id="phone">
                            <span class="text-danger small" id="phoneError"></span>
                        </div>
                    </div>

                    <!-- Row 3: Programme & Year -->
                    <div class="row g-3 mb-3">
                        <div class="col-12 col-md-6">
                            <label for="programme" class="form-label text-light small">Degree Programme</label>
                            <select class="form-select bg-secondary text-white border-0" id="programme">
                                <option value="">Select Programme</option>
                                <option value="CS">Cyber Security</option>
                                <option value="SE">Software Engineering</option>
                                <option value="DS">Data Science</option>
                                <option value="IT">Information Technology</option>
                                <option value="CS">Computer Science</option>
                            </select>
                            <span class="text-danger small" id="programmeError"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="year" class="form-label text-light small">Year of Study</label>
                            <select class="form-select bg-secondary text-white border-0" id="year">
                                <option value="">Select Year</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <span class="text-danger small" id="yearError"></span>
                        </div>
                    </div>

                    <!-- Row 4: Passwords -->
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-md-6">
                            <label for="password" class="form-label text-light small">Password</label>
                            <input type="password" class="form-control bg-secondary text-white border-0" id="password">
                            <span class="text-danger small" id="passwordError"></span>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="confirmPassword" class="form-label text-light small">Confirm Password</label>
                            <input type="password" class="form-control bg-secondary text-white border-0" id="confirmPassword">
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