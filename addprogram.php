<?= $this->extend('Views/admindashboard'); ?>
<?= $this->section('add-program'); ?>
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
                    <h3 class="mb-4">Add Program</h3>
                    <form action="<?= base_url('add-program/process') ?>" method="post">
                        <div class="mb-3">
                            <label for="programName" class="form-label">Program Name</label>
                            <input type="text" class="form-control" id="programName" name="program_name" placeholder="Enter Program Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="brochureFees" class="form-label">Brochure Fees</label>
                            <input type="number" class="form-control" id="brochureFees" name="brochure_fees" placeholder="Enter Brochure Fees" required>
                        </div>
                        <div class="mb-3">
                            <label for="programFees" class="form-label">Program Fees</label>
                            <input type="number" class="form-control" id="programFees" name="fees" placeholder="Enter Program Fees" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Program</button>
                        <button  class="btn btn-danger">Reset</button>
                    </form>
                </div>
            </div>
<?= $this->endSection(); ?>