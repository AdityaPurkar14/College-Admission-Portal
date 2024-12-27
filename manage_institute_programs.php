<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('manage-institute-programs'); ?>

<div class="col-md-10">
    <h3 class="mb-4">Manage Institute Program Mappings</h3>

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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Institute</th>
                <th>Program</th>
                <th>Seats</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mappings as $mapping) : ?>
                <tr>
                    <td><?= esc($mapping['institute_name']) ?></td>
                    <td><?= esc($mapping['program_name']) ?></td>
                    <td><?= esc($mapping['seats']) ?></td>
                    <td>
                        <a href="<?= base_url('institute-program/edit/' . $mapping['id']) ?>" class="btn btn-warning">Edit</a>
                        <a href="<?= base_url('institute-program/delete/' . $mapping['id']) ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection(); ?>
