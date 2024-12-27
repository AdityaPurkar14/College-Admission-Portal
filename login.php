<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            margin: auto;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .login-header {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 25px;
            color: #6a11cb;
        }

        .btn-custom {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #5b0fc4, #1e63f7);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #6a11cb;
        }

        .form-label {
            font-weight: 600;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
    <?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <script>
        setTimeout(function () {
            window.location.href = '/login'; // Redirect to login page after 3 seconds
        }, 3000);
    </script>
<?php endif; ?>
        <h2 class="login-header">Login</h2>
        <form action="<?= base_url('/auth/loginProcess')?>" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password"name="password" placeholder="Enter your password" required>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-custom">Login</button>
            </div>
        </form>
        <div class="mt-3 text-center">
            <a href="#" class="text-muted" onclick="redirectToRegister()">Forgot your password?</a>
        </div>
        <div class="mt-3 text-center">
            <p class="text-muted">Don't have an account? <a href="<?= base_url('/register') ?>" class="text-primary">Sign Up</a></p>
        </div>
    </div>
        
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php if (session()->getFlashdata('alert')): ?>
    <script>
        alert("<?= session()->getFlashdata('alert') ?>");
    </script>
<?php endif; ?>

</body>

</html>
