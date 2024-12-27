<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('institute-allocation'); ?>

<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary">Filter Student Applications by Program</h2>

    <!-- Program Filter Form -->
    <form method="post" action="<?= site_url('admin/showStudentApplications') ?>" class="p-3 bg-light rounded shadow-sm">
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

    <?php if (!empty($students)): ?>
        <h3 class="mt-5 mb-3 text-center">Student Applications</h3>
        <table class="table table-bordered table-hover">
            <thead class="bg-light">
                <tr>
                    <th>Student Name</th>
                    <th>Entrance Score</th>
                    <th>Available Institutes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= esc($student['student_name']) ?></td>
                        <td><?= esc($student['entrance_score']) ?></td>
                        <td>
                            <form action="<?= site_url('admin/allocateInstitute') ?>" method="post">
                                <input type="hidden" name="student_id" value="<?= esc($student['student_details_id']) ?>">
                                <div class="form-group">
                                    <select name="institute_id" class="form-control" required>
                                        <option value="">-- Select Institute --</option>
                                        <?php foreach ($institutes as $institute): ?>
                                            <option value="<?= $institute['institute_id'] ?>">
                                                <?= esc($institute['institute_name']) ?> 
                                                (<?= esc($institute['seats_remaining']) ?> seats remaining)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success btn-block mt-2">Allocate</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info text-center" role="alert">
        No applications found for the selected program.        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
