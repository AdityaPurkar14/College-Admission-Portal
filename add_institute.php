<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('add-institute'); ?>
<style>
.form-section {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }
       
        .form-label {
            font-weight: bold;
        }
    </style>
<div class="col-md-10">
    <div class="form-section">
        <h3 class="mb-4">Add Institute</h3>
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

        <form action="<?= base_url('add-institute/process') ?>" method="post">
            <div class="mb-3">
                <label for="institute_name" class="form-label">Institute Name</label>
                <input type="text" class="form-control" id="institute_name" name="institute_name" placeholder="Enter Institute Name" required>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter Institute Location" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Institute</button>
            <button type="reset" class="btn btn-danger">Reset</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
