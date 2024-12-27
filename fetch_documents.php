<?= $this->extend('Views/dashboard'); ?>
<?= $this->section('content'); ?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Seat Acceptance and Document Verification</h4>
        </div>
        <div class="card-body">
            <p>You have accepted the seat allocated to you. Please visit the following address for document verification:</p>
            <p><strong>Address:</strong> <?= esc($address) ?></p>
            
            <hr>
            <h5>Student Details</h5>
            <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Student Name:</div>
                <div class="col-sm-8"><?= esc($student['student_name']) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">UID:</div>
                <div class="col-sm-8"><?= esc($student['uid']) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Program Interested:</div>
                <div class="col-sm-8"><?= esc($student['program_interested']) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Category:</div>
                <div class="col-sm-8"><?= esc($category) ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 font-weight-bold">Allocated Institute:</div>
                <div class="col-sm-8"><?= esc($allocated_institute) ?></div>
            </div>

            <hr>
            <h5>Required Documents</h5>
            <ul class="list-group">
                <?php foreach ($documents as $document): ?>
                    <li class="list-group-item"><?= esc($document['Document_Name']) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
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
