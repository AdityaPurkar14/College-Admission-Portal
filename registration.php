<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 700px;
            margin-top: 50px;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            border-radius: 20px;
        }
        .form-control:focus {
            border-color: #007BFF;
            box-shadow: none;
        }
        .btn-primary {
            background-color: #007BFF;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        label {
            color: #555;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .d-flex {
            display: flex;
        }
        .justify-content-between {
            justify-content: space-between;
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

<div class="container">
    <h2><strong>Student Registration Form</strong></h2>
    <form action="<?= base_url('/insert')?>" method="POST">
        <div class="form-group">
            <label for="enquiry_id">Enquiry ID:</label>
            <input type="text" class="form-control" id="enquiry_id" name="enquiry_id" required
                   placeholder="Enter your enquiry ID" title="Provide the unique enquiry ID you received during inquiry.">
        </div>

        <div class="form-group">
            <label for="uid">UID:</label>
            <input type="text" class="form-control" id="uid" name="uid" required
                   placeholder="ex.MCA2425101" title="Your unique student identification number.">
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required
                   placeholder="Enter password" title="Create a strong password for your account.">
        </div>

        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" class="form-control" id="student_name" name="student_name" required
                   placeholder="Enter your full name" title="Provide your full legal name.">
        </div>

        <div class="form-group">
            <label for="degree">Degree:</label>
            <input type="text" class="form-control" id="degree" name="degree" required
                   placeholder="Enter the degree you had pursuing" title="State the degree program you are enrolled in (e.g., B.Sc., B.Tech.).">
        </div>

        <div class="form-group">
            <label for="program_interested">Program Interested:</label>
            <input type="text" class="form-control" id="program_interested" name="program_interested" required
                   placeholder="Enter the program you are interested in" title="Mention the academic program you wish to apply for (e.g., Data Science).">
        </div>

        <div class="form-group">
            <label for="student_contact">Student Contact:</label>
            <input type="text" class="form-control" id="student_contact" name="student_contact" required
                   placeholder="Enter your contact number" title="Provide your personal mobile number.">
        </div>

        <div class="form-group">
            <label for="guardian_contact">Guardian Contact:</label>
            <input type="text" class="form-control" id="guardian_contact" name="guardian_contact" required
                   placeholder="Enter guardian's contact number" title="Provide a contact number for your guardian.">
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" class="form-control" id="city" name="city" required
                   placeholder="Enter your city" title="State the city where you live.">
        </div>

        <div class="form-group">
            <label for="state">State:</label>
            <input type="text" class="form-control" id="state" name="state" required
                   placeholder="Enter your state" title="Mention the state where you reside.">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required
                   placeholder="Enter your email address" title="Provide a valid email address.">
        </div>

        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required title="Select your gender.">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Transgender">Transgender</option>
            </select>
        </div>
        <div class="form-group">
    <label for="entrance_name">Entrance Name:</label>
    <select class="form-control" id="entrance_name" name="entrance_name" required title="Select the entrance exam you appeared for.">
        <option value="">Select Entrance</option>
        <option value="MHT-CET">MHT-CET</option>
        <option value="JEE">JEE</option>
        <option value="GATE">GATE</option>
    </select>
</div>

<div class="form-group">
    <label for="entrance_score">Entrance Score:</label>
    <input type="number" class="form-control" id="entrance_score" name="entrance_score" required
           placeholder="Enter your entrance score" title="Provide your score in the entrance exam.">
</div>

        <div class="form-group">
            <label for="query">Query:</label>
            <textarea class="form-control" id="query" name="query" rows="3" required
                      placeholder="Enter your query" title="You can ask any questions or mention specific requests related to the registration process."></textarea>
        </div>

        <input type="hidden" id="registration_date" name="registration_date">

        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-secondary" onclick="cancelRegistration()">Cancel</button>
            <button type="submit" class="btn btn-primary">Register</button>
        </div>
        <div class="mt-3 text-center">
            <p class="text-muted"style="font-size: 18px;">Already have an account? <a href="<?= base_url('/login') ?>" class="text-primary" >Login</a></p>
        </div>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function setRegistrationDate() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); 
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        
        const formattedDate = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.getElementById('registration_date').value = formattedDate;
    }

    window.onload = setRegistrationDate;

    function cancelRegistration() {
        window.location.href = "index.html";  
    }
    <?php if (isset($alert)): ?>
        alert("<?php echo $alert; ?>");
    <?php endif; ?>
</script>

</body>
</html>
