<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('add-institute-program'); ?>

<div class="col-md-10">
    <div class="form-section">
        <h3 class="mb-4">Add Institute Program Mapping</h3>

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

        <form action="<?= base_url('institute-program/add') ?>" method="post">
            <div class="mb-3">
                <label for="institute" class="form-label">Select Institute</label>
                <select class="form-control" id="institute_id" name="institute_id" required>
                    <option value="">-- Select Institute --</option>
                    <?php foreach ($institutes as $institute) : ?>
                        <option value="<?= esc($institute['institute_id']) ?>"><?= esc($institute['institute_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Select Program</label>
                <select class="form-control" id="program_id" name="program_id" required>
                    <option value="">-- Select Program --</option>
                    <?php foreach ($programs as $program) : ?>
                        <option value="<?= esc($program['program_id']) ?>"><?= esc($program['program_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="seats" class="form-label">Seats</label>
                <input type="number" class="form-control" id="seats" name="seats" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Mapping</button>
            <a href="<?= base_url('manage-institute-programs') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
