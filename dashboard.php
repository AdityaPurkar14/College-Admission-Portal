<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f4f5f7;
        }

        /* Updated navbar with dark color */
        .navbar {
            /* position:fixed; */
            background: #2C3E50;
            color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* width: 100%; */
            /* z-index: 1000; Ensure it stays above other content */

        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            color: #ffffff !important;
        }

        .navbar-brand img {
            height: 50px;
            width: 90px;
            margin-right: 10px;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #34495E;
            height: 100vh;
            padding: 20px;
            padding-top:30px;
            color: #ffffff;
            position: fixed;
            width: 220px;
        }

        .sidebar h3 {
            color: #ffffff;
            font-weight: bold;
            font-size: 1.3rem;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: #ffffff;
            text-decoration: none;
            font-size: 0.95rem;
            margin-bottom: 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #1ABC9C;
            color: #ffffff;
        }

        .sidebar .sidebar-title {
            margin-top: 20px;
            font-size: 0.9rem;
            font-weight: bold;
            color: #bdc3c7;
            text-transform: uppercase;
        }

        /* Content container */
        .content-container {
            margin-left: 220px;
            padding: 20px;
        }

        /* Progress bar and card styles */
       .progress-container {
            display: flex;
            margin-top: 20px;
            background-color: #e53935;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-step {
            flex: 1;
            text-align: center;
            padding: 10px;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }
        .progress-step.completed {
    background-color: #4caf50 !important; /* Green color for completed steps */
    color: white;
}
        .progress-step:hover {
            opacity: 0.85;
        }

        /* Progress step colors */
        .step-1 { background-color: #ff5722; }
        .step-2 { background-color: #ff9800; }
        .step-3 { background-color: #ffc107; }
        .step-4 { background-color: #8bc34a; }
        .step-5 { background-color: #4caf50; }
        .step-6 { background-color: #2196f3; }
        .step-7 { background-color: #3f51b5; }
        .step-8 { background-color: #9c27b0; }

        /* Footer styles */
        footer {
            background-color: #34495E;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        footer a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="#">
                <img class="navbar-logo" src="<?= base_url('/resources/logo.png'); ?>">
                Sinhgad Technical Education Society, Pune
            </a>
            <!-- Dropdown for user options -->
            <div class="dropdown ms-auto">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <?= session()->get('name') ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                    <li><a class="dropdown-item" href="<?= base_url('/change-pass') ?>">Change Password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?= base_url('/logout') ?>">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
            
                <a href="#" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="#"><i class="fas fa-file-signature"></i> Enquiry Form</a>
                <a href="<?= base_url('paybrochure'); ?>"><i class="fas fa-money-bill-wave"></i> Brochure Fees</a>
                <a href="<?= base_url('getdetails'); ?>"><i class="fas fa-file-alt"></i> Admission Form</a>
                <a href="<?= base_url('fetch-documents'); ?>"><i class="fas fa-file-alt"></i>Doc Verification</a>
                <a href="<?= base_url('feepayment'); ?>"><i class="fas fa-credit-card"></i> Admission Fees</a>
                <a href="#"><i class="fas fa-bed"></i> Hostel Form</a>
            </div>

            <!-- Main content -->
            <div class="col-md-10 content-container">
                <div class="container text-center">
                    <!-- Progress Steps -->
                   <div class="progress-container">
                        <div class="progress-step step-1" id="step-1">1. Enquiry Form</div>
                        <div class="progress-step step-2" id="step-2">2. Pay Admission</div>
                        <div class="progress-step step-3" id="step-3">3. Fill Admission</div>
                        <div class="progress-step step-4" id="step-4">4. Get Admission</div>
                        <div class="progress-step step-5" id="step-5">5. Offline Document</div>
                        <div class="progress-step step-6" id="step-6">6. Fee Payment</div>
                        <div class="progress-step step-7" id="step-7">7. Admission</div>
                        <div class="progress-step step-8" id="step-8">8. Hostel Admission</div>
                    </div>

                    <div class="col-md-10 mx-auto">
                        <div class="container" id="dynamic-content">
                            <!-- This is where dynamic content will be loaded -->
                            <?= $this->renderSection('content'); ?>
                            <?=$this->renderSection('filladmission');?>
                            <?=$this->renderSection('admission-details');?>
                            <?=$this->renderSection('fetch-documents');?>
                            <?=$this->renderSection('fee-payment');?>
                            <?=$this->renderSection('admission-form');?>
                            <?=$this->renderSection('download-form');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Sinhgad Technical Education Society, Pune. All Rights Reserved. <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    
    <script>
    // Default stage 2 if not set in session
    const currentStage = <?= session()->get('stage') ?? 2; ?> // Default to stage 2
    console.log(currentStage);
    document.addEventListener("DOMContentLoaded", function() {
    // Fetch the current stage passed from PHP
    if (currentStage > 0) {
        // Loop through each step and mark as completed if the step is less than or equal to the current stage
        for (let i = 1; i < currentStage; i++) {
            const step = document.getElementById(`step-${i}`);
            step.classList.add('completed');
        }

        // Optionally, highlight current stage as active
        const currentStep = document.getElementById(`step-${currentStage}`);
        currentStep.classList.add('active');
    }
    });
    </script>
</body>
</html>
