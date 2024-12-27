<?= $this->extend('Views/admindashboard'); ?>

<?= $this->section('document-verification'); ?>

<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary">Document Verification</h2>

    <!-- Program Filter Form -->
    <form method="post" action="<?= site_url('document-verification') ?>" class="p-3 bg-light rounded shadow-sm">
        <div class="form-group">
            <label for="program">Select Program:</label>
            <select name="program_id" id="program" class="form-control" onchange="this.form.submit()">
                <option value="">-- Select Program --</option>
                <?php foreach ($programs as $program): ?>
                    <option value="<?= $program['program_id'] ?>" <?= set_select('program_id', $program['program_id']) ?>>
                        <?= esc($program['program_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>

    <!-- Student List with Document Verification Dropdown -->
    <?php if (!empty($students)): ?>
        <h3 class="mt-5 mb-3 text-center">Student Allocations</h3>
        <table class="table table-bordered table-hover">
            <thead class="bg-light">
                <tr>
                    <th>Student Name</th>
                    <th>Program</th>
                    <th>Current Status</th>
                    <th>Update Status</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= esc($student['student_name']) ?></td>
                        <td><?= esc($student['program_interested']) ?></td>
                        <td><?= esc($student['allocation_status']) ?></td>
                        <td>
                            <form action="<?= site_url('admin/updateStatus') ?>" method="post">
                                <input type="hidden" name="allocation_id" value="<?= esc($student['id']) ?>">
                                <select name="status" class="form-control" required>
                                    <option value="document_verified" <?= $student['allocation_status'] == 'document_verified' ? 'selected' : '' ?>>Document Verified</option>
                                    <option value="document_rejected" <?= $student['allocation_status'] == 'document_rejected' ? 'selected' : '' ?>>Document Rejected</option>
                                </select>
                        </td>
                        <td>
                            <textarea name="note" class="form-control"><?= esc($student['note']) ?></textarea>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-primary btn-block mt-2">Update Status</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
            No allocations found for the selected program.
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
