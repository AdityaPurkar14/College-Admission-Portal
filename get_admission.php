<?= $this->extend('Views/dashboard'); ?>
<?= $this->section('admission-details'); ?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Student Details</h4>
        </div>
        <div class="card-body">
            <!-- Student Details Form -->
            <form method="post" action="<?= site_url('acceptAllocation') ?>">
                <!-- Student Name -->
                <div class="form-group row">
                    <label for="student_name" class="col-sm-3 col-form-label font-weight-bold">Student Name:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?= esc($student['student_name']) ?></p>
                    </div>
                </div>

                <!-- UID -->
                <div class="form-group row">
                    <label for="uid" class="col-sm-3 col-form-label font-weight-bold">UID:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?= esc($student['uid']) ?></p>
                    </div>
                </div>

                <!-- Program Interested -->
                <div class="form-group row">
                    <label for="program_interested" class="col-sm-3 col-form-label font-weight-bold">Program Interested:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?= esc($student['program_interested']) ?></p>
                    </div>
                </div>

                <!-- Allocated Institute -->
                <div class="form-group row">
                    <label for="allocated_institute" class="col-sm-3 col-form-label font-weight-bold">Allocated Institute:</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?= esc($allocated_institute) ?></p>
                    </div>
                </div>

                <!-- Accept Button -->
                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" id="acceptButton" class="btn btn-success btn-lg btn-block">Accept</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Check if the student has been allocated an institute
    var isAllocated = <?= json_encode($isAllocated); ?>;

    // If not allocated, hide the Accept button
    if (!isAllocated) {
        document.getElementById('acceptButton').style.display = 'none'; // Hide the Accept button
    }
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


<?= $this->endSection(); ?>
