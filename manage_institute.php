<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('manage-institute'); ?>
<style>
.form-section {
            max-width: 1200px;
            justify-content:center;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }
       
        .form-label {
            font-weight: bold;
        }
    </style>

<div class="col-md-10 mx-auto">
<div class="form-section mx-auto">
    <h3 class="mb-4">Manage Institutes</h3>

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
                <th>Id</th>
                <th>Institute Name</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($institutes as $institute) : ?>
                <tr>
                    <td><?= $institute['institute_id'] ?></td>
                    <td><?= esc($institute['institute_name']) ?></td>
                    <td><?= esc($institute['location']) ?></td>
                    <td>
                        <a href="<?= base_url('edit-institute/' . $institute['institute_id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="<?= base_url('delete-institute/' . $institute['institute_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this institute?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
            </div>
<?= $this->endSection(); ?>
