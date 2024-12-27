<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin-top: 100px;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Change Password</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('/change-pass/update') ?>" method="POST" id="changePasswordForm">
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
                <div class="form-text">Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.</div>
            </div>
            <div class="mb-3">
                <label for="repeat_password" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" id="repeat_password" name="repeat_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Client-side validation for strong passwords
        document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
            const newPassword = document.getElementById('new_password').value;
            const repeatPassword = document.getElementById('repeat_password').value;
            const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            // Check if the new password is strong
            if (!passwordPattern.test(newPassword)) {
                alert('New password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.');
                event.preventDefault(); // Prevent form submission
            }

            // if (newPassword !== repeatPassword) {
            //     alert('New password and repeat password do not match.');
            //     event.preventDefault();
            // }
        });
    </script>
      <?php if (session()->getFlashdata('alert')): ?>
    <script>
        alert("<?= session()->getFlashdata('alert') ?>");
    </script>
<?php endif; ?>
</body>
</html>
