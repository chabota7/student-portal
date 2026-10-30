<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - Group 10</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Custom CSS Overrides for Black Background, Light Grey Navigation Bar, and White Headings -->
    <style>
        body.bg-indigo {
            background-color: #000000 !important; /* Black background */
        }
        .navbar {
            background-color: #e5e7eb !important; /* Light Grey navigation bar */
        }
        .navbar-brand,
        .nav-link,
        .navbar-nav .nav-link {
            color: #1f2937 !important; /* Dark Grey/Black text for readability on Light Grey */
        }
        .nav-link.active,
        .nav-link:hover {
            color: #000000 !important; /* Full black on active/hover */
            font-weight: bold;
        }
        h1, h2, h3, h4, h5, h6, .card-title, .portal-header h1 {
            color: #ffffff !important; /* White headings */
        }
    </style>
</head>
<body class="bg-indigo text-white flex-column min-vh-100">

    <!-- Responsive Navigation Bar -->
    <nav class="navbar navbar-expand-lg border-bottom border-secondary sticky-top">
        <div class="container-fluid px-3 px-lg-4">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#" onclick="showSection('home', event)">
                <img src="../../logo.png" alt="Logo" width="35" height="35" class="d-inline-block align-text-top rounded-circle">
                <span>ZCASU Portal</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav text-center text-lg-start mt-2 mt-lg-0">
                    <li class="nav-item mx-lg-2"><a class="nav-link nav-btn active fw-semibold py-2 py-lg-0" href="#" onclick="showSection('home', event)">Home</a></li>
                    <li class="nav-item mx-lg-2"><a class="nav-link nav-btn fw-semibold py-2 py-lg-0" href="#" onclick="showSection('courses', event)">Courses</a></li>
                    <li class="nav-item mx-lg-2"><a class="nav-link nav-btn fw-semibold py-2 py-lg-0" href="#" onclick="showSection('resources', event)">Resources</a></li>
                    <li class="nav-item mx-lg-2"><a class="nav-link fw-semibold py-2 py-lg-0 text-danger" href="registration.html">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="flex-grow-1">

        <!-- HOME SECTION -->
        <div id="home-section" class="portal-section">
            <header class="py-4 py-md-5 text-center portal-header">
                <div class="container px-3 my-2 my-md-4">
                    <h1 class="display-5 display-md-4 fw-bold mb-3">Welcome to the Student Portal</h1>
                    <p class="lead text-light opacity-75 mx-auto" style="max-width: 600px;">
                        Access course learning materials, review lecture notes, check timetables, and manage your registration details in one place.
                    </p>
                </div>
            </header>

            <div class="container px-3 my-4 my-md-5">
                <h2 class="h3 mb-4 border-bottom border-secondary pb-2">Quick Overview</h2>
                <div class="row g-3 g-md-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 text-white bg-dark shadow-sm portal-card border-secondary">
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="card-title h5">Enrolled Courses</h3>
                                <p class="card-text text-light opacity-75">View your active modules, assignments, and lecture notes for the current semester.</p>
                                <button class="btn btn-warning mt-auto fw-bold w-100 py-2 text-dark" onclick="showSection('courses', event)">Go to Courses</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 text-white bg-dark shadow-sm portal-card border-secondary">
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="card-title h5">Learning Resources</h3>
                                <p class="card-text text-light opacity-75">Download timetables, handbooks, software installers, and reading materials.</p>
                                <button class="btn btn-warning mt-auto fw-bold w-100 py-2 text-dark" onclick="showSection('resources', event)">Go to Resources</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 text-white bg-dark shadow-sm portal-card border-secondary">
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="card-title h5">Student Support</h3>
                                <p class="card-text text-light opacity-75">Need assistance? Reach out to technical support or your course coordinators.</p>
                                <a href="registration.html" class="btn btn-warning mt-auto fw-bold w-100 py-2 text-center text-decoration-none text-dark">Support Center</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- COURSES SECTION -->
        <div id="courses-section" class="portal-section d-none">
            <header class="py-4 py-md-5 text-center portal-header">
                <div class="container px-3">
                    <h1 class="display-5 fw-bold mb-2">My Enrolled Courses</h1>
                    <p class="text-light opacity-75">Select a course module to review learning materials and assignments.</p>
                </div>
            </header>

            <div class="container px-3 my-4 my-md-5">
                <div class="row g-3 g-md-4">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 text-white bg-dark shadow-sm portal-card border-secondary">
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="card-title h5">Web Application Development</h3>
                                <p class="card-text text-light opacity-75">Access lecture slides, lab guidelines, and code samples for HTML, CSS, Bootstrap, JavaScript, and PHP.</p>
                                <a href="#" class="btn btn-warning mt-auto fw-bold py-2 text-decoration-none text-dark">View Course Materials</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 text-white bg-dark shadow-sm portal-card border-secondary">
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="card-title h5">Database Systems & MySQL</h3>
                                <p class="card-text text-light opacity-75">Download database schemas, SQL queries, connection tutorials, and practical assignments.</p>
                                <a href="#" class="btn btn-warning mt-auto fw-bold py-2 text-decoration-none text-dark">View Database Guides</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 text-white bg-dark shadow-sm portal-card border-secondary">
                            <div class="card-body d-flex flex-column p-4">
                                <h3 class="card-title h5">Computer Architecture & Assembly</h3>
                                <p class="card-text text-light opacity-75">Explore CPU registers, instruction sets, 8086 programs, and practical lab manuals.</p>
                                <a href="#" class="btn btn-warning mt-auto fw-bold py-2 text-decoration-none text-dark">View Assembly Guides</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- RESOURCES SECTION -->
        <div id="resources-section" class="portal-section d-none">
            <header class="py-4 py-md-5 text-center portal-header">
                <div class="container px-3">
                    <h1 class="display-5 fw-bold mb-2">Learning Resources & Downloads</h1>
                    <p class="text-light opacity-75">Access institutional guidelines, lab sheets, and software documentation.</p>
                </div>
            </header>

            <div class="container px-3 my-4 my-md-5">
                <div class="row g-3 g-md-4">
                    <div class="col-12 col-md-6">
                        <div class="card h-100 text-white bg-dark shadow-sm p-3 portal-card border-secondary">
                            <div class="card-body p-3">
                                <h3 class="card-title h5">Lecture Timetable 2026</h3>
                                <p class="card-text text-light opacity-75">View weekly schedules for lectures, labs, and tutorial rooms.</p>
                                <a href="#" class="btn btn-outline-warning btn-sm fw-bold px-4 py-2 mt-2">Download PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card h-100 text-white bg-dark shadow-sm p-3 portal-card border-secondary">
                            <div class="card-body p-3">
                                <h3 class="card-title h5">Student Handbook</h3>
                                <p class="card-text text-light opacity-75">University academic regulations, code of conduct, and policies.</p>
                                <a href="#" class="btn btn-outline-warning btn-sm fw-bold px-4 py-2 mt-2">Download PDF</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer Pushed to Bottom -->
    <footer class="bg-black text-center text-secondary py-3 border-top border-secondary mt-auto">
        <div class="container px-3">
            <small>&copy; 2026 ZCAS University - Group 10 Web Application Development</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Responsive Section Switching & Mobile Nav Auto-Collapse Script -->
    <script>
        function showSection(sectionId, event) {
            if (event) event.preventDefault();
            
            // Hide all sections
            document.querySelectorAll('.portal-section').forEach(section => {
                section.classList.add('d-none');
            });
            
            // Show target section
            document.getElementById(sectionId + '-section').classList.remove('d-none');

            // Update active navbar links
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('active', 'fw-bold');
            });
            if (event && event.currentTarget) {
                event.currentTarget.classList.add('active', 'fw-bold');
            }

            // Collapse Bootstrap mobile menu automatically after clicking a link
            const navbarCollapse = document.getElementById('navbarNav');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) bsCollapse.hide();
            }

            // Scroll back to top smoothly
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    </script>
</body>
</html>