<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details Form</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        .form-label {
            font-weight: bold;
            color: #343a40;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
        .btn-primary, .btn-danger {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 50px;
        }
        .btn-primary {
            background-color: #0d6efd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #495057;
        }
        h4 {
            color: #6c757d;
            font-weight: bold;
            margin-top: 30px;
        }
        .row {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Student Details Form</h2>
    <form>
        <!-- First Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="candidate_name" class="form-label">Candidate’s Name:</label>
                    <input type="text" class="form-control" id="candidate_name" name="candidate_name" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="program_interested" class="form-label">Program Interested:</label>
                    <input type="text" class="form-control" id="program_interested" name="program_interested" disabled>
                </div>
            </div>
        </div>

        <!-- Second Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="student_contact" class="form-label">Student Contact Number:</label>
                    <input type="text" class="form-control" id="student_contact" name="student_contact" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="parent_contact" class="form-label">Parent Contact Number:</label>
                    <input type="text" class="form-control" id="parent_contact" name="parent_contact" disabled>
                </div>
            </div>
        </div>

        <!-- Third Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="email" class="form-label">Student's Email ID:</label>
                    <input type="email" class="form-control" id="email" name="email" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="gender" class="form-label">Gender:</label>
                    <input type="text" class="form-control" id="gender" name="gender" disabled>
                </div>
            </div>
        </div>

        <!-- Fourth Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="entrance_name" class="form-label">Entrance Name:</label>
                    <input type="text" class="form-control" id="entrance_name" name="entrance_name" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="entrance_score" class="form-label">Entrance Score:</label>
                    <input type="number" class="form-control" id="entrance_score" name="entrance_score" disabled>
                </div>
            </div>
        </div>

        <!-- User Input Fields -->
        <h4>Additional Details</h4>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="mother_name" class="form-label">Mother’s Name:</label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="dob" class="form-label">Date of Birth:</label>
                    <input type="date" class="form-control" id="dob" name="dob" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="category" class="form-label">Category:</label>
                    <select class="form-select" id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Open">Open</option>
                        <option value="OBC">OBC</option>
                        <option value="SC">SC</option>
                        <option value="ST">ST</option>
                        <option value="VJ-NT">VJ-NT</option>
                        <option value="SBC">SBC</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="aadhar" class="form-label">Aadhar No:</label>
                    <input type="text" class="form-control" id="aadhar" name="aadhar" required>
                </div>
            </div>
        </div>

        <!-- Education Details -->
        <h4>Education Details</h4>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="ssc_marks" class="form-label">SSC Total Marks:</label>
                    <input type="number" class="form-control" id="ssc_marks" name="ssc_marks" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="hsc_physics" class="form-label">HSC Marks - Physics:</label>
                    <input type="number" class="form-control" id="hsc_physics" name="hsc_physics" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="hsc_maths" class="form-label">HSC Marks - Maths:</label>
                    <input type="number" class="form-control" id="hsc_maths" name="hsc_maths" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="hsc_chemistry_other" class="form-label">HSC Marks - Chemistry/Other:</label>
                    <input type="number" class="form-control" id="hsc_chemistry_other" name="hsc_chemistry_other" required>
                </div>
            </div>
        </div>

        <!-- Button Group -->
        <div class="form-group text-center mt-4">
            <button type="reset" class="btn btn-danger me-3">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
