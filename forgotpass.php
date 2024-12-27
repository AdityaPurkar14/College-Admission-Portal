<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-weight: bold;
        }
        #countdown {
            font-size: 0.9em;
            color: #6c757d;
        }
        .hidden {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#otpSection').hide();
            $('#changePasswordSection').hide();
            
            let timeLeft = 10;
            let timer;

            // Handle Send OTP / Resend OTP
            $('#sendOtpBtn').click(function() {
                $(this).prop('disabled', true).text('Sending...');

                // Simulate sending the OTP (replace this with actual AJAX call)
                setTimeout(function() {
                    $('#otpSection').show();
                    $('#sendOtpBtn').text('Resend OTP').prop('disabled', false);
                    timeLeft = 10;
                    startTimer();
                }, 1000);
            });

            // Handle OTP Verification
            $('#verifyOtpBtn').click(function(e) {
                e.preventDefault();

                const otp = $('#otp').val();
                if (!otp) {
                    alert('Please enter the OTP');
                    return;
                }

                // Simulate OTP verification (replace this with actual AJAX call)
                $.post('<?= base_url('verify-otp') ?>', { otp: otp }, function(response) {
                    if (response) {
                        // If OTP is correct, show the change password fields
                        $('#changePasswordSection').show();
                        $('#otpSection').hide();
                    } else {
                        alert('Invalid OTP, please try again.');
                    }
                });
            });

            function startTimer() {
                clearInterval(timer);
                timer = setInterval(function() {
                    timeLeft--;

                    $('#countdown').text(`Resend OTP in ${timeLeft} seconds`);

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        $('#sendOtpBtn').prop('disabled', false);
                        $('#countdown').text('You can now resend the OTP.');
                    }
                }, 1000);
            }
        });
    </script>
</head>
<body>
<div class="container mt-5 d-flex justify-content-center">
    <div class="card" style="width: 400px;">
        <div class="card-body">
            <h5 class="card-title text-center">Forgot Password</h5>
            <form id="forgotPasswordForm">
                <div class="form-group">
                    <label for="email">Enter your Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="button" id="sendOtpBtn" class="btn btn-primary btn-block">Send OTP</button>
                <div id="countdown" class="mt-2 text-center"></div>
            </form>
            
            <!-- OTP Section -->
            <div id="otpSection" class="mt-3">
                <div class="form-group">
                    <label for="otp">Enter OTP:</label>
                    <input type="text" class="form-control" id="otp" name="otp" required>
                </div>
                <button type="submit" id="verifyOtpBtn" class="btn btn-success btn-block">Verify OTP</button>
            </div>
            
            <!-- Change Password Section -->
            <div id="changePasswordSection" class="mt-3 hidden">
                <form action="<?= base_url('change-password') ?>" method="POST">
                    <div class="form-group">
                        <label for="newPassword">New Password:</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password:</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
