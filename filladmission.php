<?= $this->extend('Views/dashboard'); ?>

<?= $this->section('filladmission'); ?>
    <style>
        /* Overall form styles */
        .form-control {
            border-radius: 12px;
            box-shadow: none;
            padding: 12px 15px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
        }

        .btn-primary, .btn-danger {
            border-radius: 30px;
            padding: 12px 30px;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007BFF;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        /* Header */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
            font-size: 36px;
            font-weight: 700;
        }

        /* Form Label Styles */
        label {
            color: #555;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        /* Education Section */
        h4 {
            margin-top: 40px;
            font-size: 28px;
            font-weight: 600;
            color: #007BFF;
            text-transform: uppercase;
            margin-bottom: 20px;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }

        /* Custom styling for the select dropdown */
        select.form-control {
            height: 46px;
            padding: 0 15px;
        }

        /* Responsive Grid for form layout */
        .form-row {
            margin-bottom: 30px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        /* Spacing & Layout Enhancements */
        .photo-upload-box {
            border: 2px dashed #007BFF;
            padding: 15px;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 20px;
        }

        .row>div {
            padding-right: 20px;
            padding-left: 20px;
        }

        .button-group {
            text-align: center;
            margin-top: 20px;
        }

        /* Error message styles */
        small {
            font-size: 14px;
            font-weight: 400;
        }

        small#motherNameError,
        small#aadharError {
            display: none;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group select,
        .form-group textarea {
            font-size: 15px;
            height: 50px;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="number"]:focus,
        .form-group input[type="date"]:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #0056b3;
        }
    </style>

    <script>
        function toggleFields() {
            const program = document.getElementById("program_interested").value;
            // Hide all program-specific fields initially
            document.querySelectorAll('.program-field').forEach(field => {
                field.style.display = 'none';
            });

            // Show fields based on the selected program
            if (program === 'MCA' || program === 'MBA') {
                document.querySelectorAll('.field-graduation').forEach(field => field.style.display = 'block');
            } else if (program === 'Pharmacy' || program === 'Engineering' || program === 'Architecture') {
                document.querySelectorAll('.field-pcm').forEach(field => field.style.display = 'block');
            }

            if (program === 'Engineering') {
                document.querySelectorAll('.field-engineering-preferences').forEach(field => field.style.display = 'block');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleFields();
            document.getElementById("program_interested").addEventListener("change", toggleFields);
        });
        
    </script>
    <?php if (isset($alertMessage) && $alertMessage != ''): ?>
    <script>
        // Show the alert message
        alert('<?= $alertMessage; ?>');
        
        // Redirect to the specified URL if it's set (only for future or completed steps)
        <?php if ($redirectUrl != ''): ?>
            window.location.href = '<?= $redirectUrl; ?>';
        <?php endif; ?>
    </script>
<?php endif; ?>


    <h2><strong>Student Details</strong></h2>
    <form action="<?= base_url('admission/submit') ?>" method="post">
        <!-- Horizontal Form Layout -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="candidate_name">Candidate’s Name:</label>
                <input type="text" class="form-control" id="candidate_name" name="candidate_name" value="<?=$studentData['student_name']?>"disabled>
            </div>

            <div class="form-group col-md-6">
                <label for="program_interested">Program Interested:</label>
                <input type="text" class="form-control" id="program_interestedh" name="program_interestedh" value="<?=$studentData['program_interested']?>" disabled>
                <input type="hidden" class="form-control" id="program_interested" name="program_interested" value="<?=$studentData['program_interested']?>">
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="student_contact">Student Contact Number:</label>
                <input type="text" class="form-control" id="student_contact" name="student_contact" value="<?=$studentData['student_contact']?>" disabled>
            </div>

            <div class="form-group col-md-6">
                <label for="parent_contact">Parent Contact Number:</label>
                <input type="text" class="form-control" id="parent_contact" name="parent_contact" value="<?=$studentData['guardian_contact']?>" disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Student's Email ID:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?=$studentData['email']?>"disabled>
            </div>

            <div class="form-group col-md-6">
                <label for="gender">Gender:</label>
                <input type="text" class="form-control" id="gender" name="gender" value="<?=$studentData['gender']?>" disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="entrance_name">Entrance Name:</label>
                <input type="text" class="form-control" id="entrance_name" name="entrance_name" value="<?=$studentData['entrance_name']?>" disabled>
            </div>

            <div class="form-group col-md-6">
                <label for="entrance_score">Entrance Score:</label>
                <input type="number" class="form-control" id="entrance_score" name="entrance_score"value="<?=$studentData['entrance_score']?>" disabled>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="university_name">University Name:</label>
                <input type="text" class="form-control" id="university_name" name="university_name" required>
            </div>

            <div class="form-group col-md-6">
                <label for="mother_name">Mother’s Name:</label>
                <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                <small id="motherNameError">Mother's name must not exceed 20 words.</small>
            </div>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
        </div>

        <div class="form-row">
            <div class="form-group col-md-8">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <option value="">Select Category</option>
                    <option value="Open">Open</option>
                    <option value="OBC">OBC</option>
                    <option value="SC">SC</option>
                    <option value="ST">ST</option>
                    <option value="VJ-NT">VJ-NT</option>
                    <option value="SBC">SBC</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="aadhar">Aadhar No:</label>
                <input type="text" class="form-control" id="aadhar" name="aadhar" required>
                <small id="aadharError">Aadhar number must be 12 digits and cannot start with 0.</small>
            </div>
        </div>

        <!-- Education Details -->
        <h4><strong>Education Details</strong></h4>
        <!-- <label for="program_interested">Program Interested:</label>
        <select id="program_interested" name="program_interested" class="form-control" required>
            <option value="">Select Program</option>
            <option value="mca">MCA</option>
            <option value="mba">MBA</option>
            <option value="pharmacy">Pharmacy</option>
            <option value="engineering">Engineering</option>
            <option value="architecture">Architecture</option>
        </select> -->

        <!-- Common Fields -->
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="ssc_marks">SSC Percentage:</label>
                <input type="number" class="form-control" id="ssc_marks" name="ssc_marks" required>
            </div>
            <div class="form-group col-md-6">
                <label for="ssc_board">SSC Board/University:</label>
                <input type="text" class="form-control" id="ssc_board" name="ssc_board" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="hsc_percentage">HSC Percentage:</label>
                <input type="number" class="form-control" id="hsc_percentage" name="hsc_percentage" required>
            </div>
            <div class="form-group col-md-6">
                <label for="hsc_board">HSC Board/University:</label>
                <input type="text" class="form-control" id="hsc_board" name="hsc_board" required>
            </div>
        </div>
        <div class="form-row">
            <label for="entrance_percentage">Entrance Percentage:</label>
            <input type="number" class="form-control" id="entrance_percentage" name="entrance_percentage">
        </div>
        <br>

        <!-- PCM Marks -->
         <div class="form-row">
        <div class="form-group program-field field-pcm col-md-4" style="display:none;">
            <label for="physics_marks">Physics Marks:</label>
            <input type="number" class="form-control" id="physics_marks" name="physics_marks">
        </div>
        <div class="form-group program-field field-pcm col-md-4" style="display:none;">
            <label for="chemistry_marks">Chemistry Marks:</label>
            <input type="number" class="form-control" id="chemistry_marks" name="chemistry_marks">
        </div>
        <div class="form-group program-field field-pcm col-md-4" style="display:none;">
            <label for="maths_marks">Maths Marks:</label>
            <input type="number" class="form-control" id="maths_marks" name="maths_marks">
        </div>
        </div>

        <!-- Graduation Fields -->
        <div class="form-row program-field field-graduation" style="display:none;">
            <div class="form-group col-md-6">
                <label for="grad_percentage">Graduation Percentage:</label>
                <input type="number" class="form-control" id="grad_percentage" name="grad_percentage">
            </div>
            <div class="form-group col-md-6">
                <label for="grad_board">Graduation University/Board:</label>
                <input type="text" class="form-control" id="grad_board" name="grad_board"value="">
            </div>
        </div>

        <!-- Engineering Specific Fields -->
        <div class="form-row program-field field-engineering field-engineering-preferences" style="display:none;">
            <div class="form-group col-md-6">
                <label for="engineering_preferences_1">Preference 1:</label>
                <input type="text" class="form-control" id="engineering_preferences_1" name="engineering_preferences[]">
            </div>
            <div class="form-group col-md-6">
                <label for="engineering_preferences_2">Preference 2:</label>
                <input type="text" class="form-control" id="engineering_preferences_2" name="engineering_preferences[]">
            </div>
        </div>

        <div class="form-row program-field field-engineering-preferences" style="display:none;">
            <div class="form-group col-md-6">
                <label for="engineering_preferences_3">Preference 3:</label>
                <input type="text" class="form-control" id="engineering_preferences_3" name="engineering_preferences[]">
            </div>
            <div class="form-group col-md-6">
                <label for="engineering_preferences_4">Preference 4:</label>
                <input type="text" class="form-control" id="engineering_preferences_4" name="engineering_preferences[]">
            </div>
        </div>

        <div class="form-row program-field field-engineering-preferences" style="display:none;">
            <div class="form-group col-md-6">
                <label for="engineering_preferences_5">Preference 5:</label>
                <input type="text" class="form-control" id="engineering_preferences_5" name="engineering_preferences[]">
            </div>
        </div>

        <!-- Button Group -->
        <div class="form-group button-group">
            <button type="reset" class="btn btn-danger">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

<?= $this->endSection(); ?>
