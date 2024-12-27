<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('manage-program'); ?>

<div class="container mt-5">
    <h3 class="mb-4">Manage Programs</h3>

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

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Program ID</th>
                <th>Program Name</th>
                <th>Brochure Fees</th>
                <th>Program Fees</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($programs) && is_array($programs)) : ?>
                <?php foreach ($programs as $program) : ?>
                    <tr>
                        <td><?= $program['program_id'] ?></td>
                        <td><?= esc($program['program_name']) ?></td>
                        <td><?= esc($program['brochure_fees']) ?></td>
                        <td><?= esc($program['fees']) ?></td>
                        <td>
                            <a href="<?= base_url('edit-program/' . $program['program_id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="<?= base_url('delete-program/' . $program['program_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this program?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5" class="text-center">No programs found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>
