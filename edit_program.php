<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('edit-program'); ?>

<div class="col-md-10">
    <div class="form-section">
    <?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
<?php if (session()->has('error')): ?>
    <div class="alert alert-danger"><?= esc(session('error')) ?></div>
<?php endif; ?>
<?php if (session()->has('success')): ?>
    <div class="alert alert-success"><?= esc(session('success')) ?></div>
<?php endif; ?>

        <h3 class="mb-4">Edit Program</h3>
        <form action="<?= base_url('edit-program/' . $program['program_id']) ?>" method="POST">
            <div class="mb-3">
                <label for="programName" class="form-label">Program Name</label>
                <input type="text" class="form-control" id="program_name" name="program_name" value="<?= esc($program['program_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="brochureFees" class="form-label">Brochure Fees</label>
                <input type="number" class="form-control" id="brochure_fees" name="brochure_fees" value="<?= esc($program['brochure_fees']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="programFees" class="form-label">Program Fees</label>
                <input type="number" class="form-control" id="fees" name="fees" value="<?= esc($program['fees']) ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Program</button>
            <a href="<?= base_url('manage-program') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
