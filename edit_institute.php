<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('edit-institute'); ?>

<div class="col-md-10">
    <div class="form-section">
        <h3 class="mb-4">Edit Institute</h3>
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

        <form action="<?= base_url('edit-institute/' . $institute['institute_id']) ?>" method="post">
            <div class="mb-3">
                <label for="institute_name" class="form-label">Institute Name</label>
                <input type="text" class="form-control" id="institute_name" name="institute_name" value="<?= esc($institute['institute_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?= esc($institute['location']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Institute</button>
            <a href="<?= base_url('manage-institutes') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
