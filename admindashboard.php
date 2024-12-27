<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons for dropdown arrows -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f5f7;
        }

        .navbar {
            background-color: #36454F;
            z-index: 1000;
        }

        .navbar-brand,
        .navbar-text {
            color: #ffffff;
            font-weight: bold;
            font-size: 1.6rem;
            display: flex;
            align-items: center;
        }

        .navbar-logo {
            width:90px;
            height: 50px;
            margin-right: 15px;
        }

        .sidebar {
            margin-top:30px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #2F4F4F;
            width: 250px;
            padding-top: 80px;
            overflow-y: auto;
        }

        .content {
            margin-left: 250px;
            /* padding-top: 80px; */
            height: calc(100vh - 80px);
            overflow-y: auto;
        }   

        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
            font-weight: bold;
            border-radius: 5px;
            margin: 5px 0;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: grey;
        }

        .sidenav-menu {
            margin: 0;
            padding: 0;
        }

        .sidenav-menu li {
            list-style: none;
        }

        footer {
            background-color: #2F4F4F;
            color: #ffffff;
            padding: 5px 0; /* Reduced padding for smaller height */
        font-size: 0.8rem; /* Slightly smaller font size */
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #ffffff;
            transition: color 0.3s;
        }

        footer a:hover {
            color: #d3d3d3;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
                position: absolute;
                z-index: 1050;
                height: 100vh;
            }

            .sidebar.active {
                display: block;
            }

            .content {
                margin-left: 0;
            }

            .hamburger {
                display: block;
                cursor: pointer;
            }
        }

        .hamburger {
            display: none;
            font-size: 1.5rem;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <span class="hamburger me-3" onclick="toggleSidebar()"><i class="bi bi-list"></i></span>
                <a class="navbar-brand" href="#">
                    <img class="navbar-logo" src="<?= base_url('/resources/logo.png'); ?>" alt="Logo">
                    Sinhgad Technical Education Society, Pune
                </a>
            </div>
            <div class="dropdown ms-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="userprofile.php"><i class="bi bi-person-fill"></i> Edit Profile</a></li>
                    <li><a class="dropdown-item" href="change-password.php"><i class="bi bi-key-fill"></i> Change Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <a href="#" class=""><i class="bi bi-house-door-fill"></i> Dashboard</a>
        <div class="sidenav-item">
            <a class="sidenav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#coursesCollapse" role="button" aria-expanded="false" aria-controls="coursesCollapse">
                <i class="bi bi-journal-bookmark-fill"></i> Courses
                <i class="bi bi-caret-down-fill"></i>
            </a>
            <div class="collapse" id="coursesCollapse">
                <ul class="sidenav-menu list-unstyled ms-3">
                    <li><a href="<?= base_url('/add-program') ?>" class="sidenav-link"><i class="bi bi-plus-circle-fill"></i> Add Course</a></li>
                    <li><a href="<?= base_url('/manage-program') ?>" class="sidenav-link"><i class="bi bi-gear-fill"></i> Manage Course</a></li>
                </ul>
            </div>
        </div>
        <div class="sidenav-item">
            <a class="sidenav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse" href="#institutesCollapse" role="button" aria-expanded="false" aria-controls="institutesCollapse">
                <i class="bi bi-building-fill"></i> Institutes
                <i class="bi bi-caret-down-fill"></i>
            </a>
            <div class="collapse" id="institutesCollapse">
                <ul class="sidenav-menu list-unstyled ms-3">
                    <li><a href="<?= base_url('/add-institute') ?>" class="sidenav-link"><i class="bi bi-plus-circle-fill"></i> Add Institute</a></li>
                    <li><a href="<?= base_url('/manage-institutes') ?>" class="sidenav-link"><i class="bi bi-gear-fill"></i> Manage Institute</a></li>
                </ul>
            </div>
        </div>
        <a href="<?= base_url('/showStudentApplications') ?>" class="sidenav-link"><i class="bi bi-file-earmark-text-fill"></i> All Applications</a>
        <a href="<?= base_url('/document-verification') ?>" class="sidenav-link"><i class="bi bi-file-earmark-check-fill"></i> Document Verification</a>
    </div>

    <div class="content">
        <div class="container" id="dynamic-content">
            <?= $this->renderSection('content'); ?>
            <?= $this->renderSection('add-program'); ?>
                    <?= $this->renderSection('manage-program'); ?>
                    <?= $this->renderSection('edit-program'); ?>
                    <?= $this->renderSection('add-institute'); ?>
                    <?= $this->renderSection('manage-institute'); ?>
                    <?= $this->renderSection('edit-institute'); ?>
                    <?= $this->renderSection('add-institute-program'); ?>
                    <?= $this->renderSection('manage-institute-programs'); ?>
                    <?= $this->renderSection('edit-institute-program'); ?>
                    <?= $this->renderSection('institute-allocation'); ?>
                    <?= $this->renderSection('document-verification'); ?>
        </div>
    </div>

    <footer>
        <div class="container text-center">
            <p>&copy; 2024 Sinhgad Technical Education Society, Pune. All Rights Reserved.</p>
            <p>
                <a href="privacy-policy.php">Privacy Policy</a> | <a href="terms-of-service.php">Terms of Service</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</body>

</html>
