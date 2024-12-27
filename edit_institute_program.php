<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('edit-institute-program'); ?>

<div class="col-md-10">
    <div class="form-section">
        <h3 class="mb-4">Edit Institute Program Mapping</h3>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('institute-program/edit/' . $mapping['id']) ?>" method="post">
            <div class="mb-3">
                <label for="institute" class="form-label">Select Institute</label>
                <select class="form-control" id="institute_id" name="institute_id" required>
                    <option value="">-- Select Institute --</option>
                    <?php foreach ($institutes as $institute) : ?>
                        <option value="<?= esc($institute['institute_id']) ?>" <?= $mapping['institute_id'] == $institute['institute_id'] ? 'selected' : '' ?>>
                            <?= esc($institute['institute_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Select Program</label>
                <select class="form-control" id="program_id" name="program_id" required>
                    <option value="">-- Select Program --</option>
                    <?php foreach ($programs as $program) : ?>
                        <option value="<?= esc($program['program_id']) ?>" <?= $mapping['program_id'] == $program['program_id'] ? 'selected' : '' ?>>
                            <?= esc($program['program_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="seats" class="form-label">Seats</label>
                <input type="number" class="form-control" id="seats" name="seats" value="<?= esc($mapping['seats']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Mapping</button>
            <a href="<?= base_url('institute-program/manage') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
