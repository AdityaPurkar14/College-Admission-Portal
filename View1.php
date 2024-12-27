<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleFields() {
            const program = document.getElementById("program_interested").value;
            
            // Hide all program-specific fields initially
            document.querySelectorAll('.program-field').forEach(field => {
                field.style.display = 'none';
            });

            // Show fields based on the selected program
            if (program === 'mca') {
                document.querySelectorAll('.field-graduation').forEach(field => field.style.display = 'block');
            } else if (program === 'mba') {
                document.querySelectorAll('.field-graduation').forEach(field => field.style.display = 'block');
                document.querySelector('.')
            } else if (program === 'pharmacy') {
                document.querySelectorAll('.field-pcm').forEach(field => field.style.display = 'block');
            } else if (program === 'engineering') {
                document.querySelectorAll('.field-pcm').forEach(field => field.style.display = 'block');
                document.querySelectorAll('.field-engineering-preferences').forEach(field => field.style.display = 'block');
            } else if (program === 'architecture') {
                document.querySelectorAll('.field-pcm').forEach(field => field.style.display = 'block');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            toggleFields();
            document.getElementById("program_interested").addEventListener("change", toggleFields);
        });
    </script>
</head>
<body>
    <div class="container">
        <form action="/StudentController/saveStudentDetails" method="post">
            <div class="form-group">
                <label for="program_interested">Program Interested:</label>
                <select id="program_interested" name="program_interested" class="form-control" required>
                    <option value="">Select Program</option>
                    <option value="mca">MCA</option>
                    <option value="mba">MBA</option>
                    <option value="pharmacy">Pharmacy</option>
                    <option value="engineering">Engineering</option>
                    <option value="architecture">Architecture</option>
                </select>
            </div>

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
            <div class="form-group program-field field-pcm">
                <label for="physics_marks">Physics Marks:</label>
                <input type="number" class="form-control" id="physics_marks" name="physics_marks">
            </div>
            <div class="form-group program-field field-pcm">
                <label for="chemistry_marks">Chemistry Marks:</label>
                <input type="number" class="form-control" id="chemistry_marks" name="chemistry_marks">
            </div>
            <div class="form-group program-field field-pcm">
                <label for="maths_marks">Maths Marks:</label>
                <input type="number" class="form-control" id="maths_marks" name="maths_marks">
            </div>
            <!-- Graduation Fields -->
            <div class="form-row program-field field-graduation">
                <div class="form-group col-md-6">
                    <label for="grad_percentage">Graduation Percentage:</label>
                    <input type="number" class="form-control" id="grad_percentage" name="grad_percentage">
                </div>
                <div class="form-group col-md-6">
                    <label for="grad_board">Graduation University/Board:</label>
                    <input type="text" class="form-control" id="grad_board" name="grad_board">
                </div>
            </div>
            <!-- Engineering Specific Fields -->
            <div class="form-row program-field field-engineering field-engineering-preferences">
                <div class="form-group col-md-6">
                    <label for="engineering_preferences_1">Preference 1:</label>
                    <input type="text" class="form-control" id="engineering_preferences_1" name="engineering_preferences[]">
                </div>
                <div class="form-group col-md-6">
                    <label for="engineering_preferences_2">Preference 2:</label>
                    <input type="text" class="form-control" id="engineering_preferences_2" name="engineering_preferences[]">
                </div>
            </div>
            <div class="form-row program-field field-engineering field-engineering-preferences">
                <div class="form-group col-md-6">
                    <label for="engineering_preferences_3">Preference 3:</label>
                    <input type="text" class="form-control" id="engineering_preferences_3" name="engineering_preferences[]">
                </div>
                <div class="form-group col-md-6">
                    <label for="engineering_preferences_4">Preference 4:</label>
                    <input type="text" class="form-control" id="engineering_preferences_4" name="engineering_preferences[]">
                </div>
            </div>
            <div class="form-row program-field field-engineering field-engineering-preferences">
                <div class="form-group col-md-6">
                    <label for="engineering_preferences_5">Preference 5:</label>
                    <input type="text" class="form-control" id="engineering_preferences_5" name="engineering_preferences[]">
                </div>
            </div>


           

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
