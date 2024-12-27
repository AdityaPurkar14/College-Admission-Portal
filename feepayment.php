<?= $this->extend('Views/dashboard'); ?>
<?= $this->section('fee-payment'); ?>
<style>
    .payment-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 8px;
    }
    .btn-pay {
        background-color: #9932cc;
        color: #fff;
        font-weight: bold;
    }
    .btn-pay:hover {
        background-color: #800080;
    }
</style>

<div class="container">
    <div class="payment-container">
        <h2 class="text-center mb-4">Pay Program Fees</h2>
        <p class="lead text-center" style="font-size:1.5 rem;">Program Fees: ₹<?= $fees;?></p>
        <form action="<?= base_url('feepayment/process'); ?>" method="POST">
            <button type="submit" class="btn btn-pay btn-lg w-100">Pay ₹<?= $fees;?></button>
        </form>
    </div>
</div>
<?php if (isset($alertMessage) && $alertMessage != ''): ?>
    <script>
        // Show the alert message
        alert('<?= $alertMessage; ?>');
        
        // Redirect to the specified URL if it's set (only for future or completed steps)
        <?php if ($redirectUrl != ''): ?>
            window.location.href = '<?= $redirectUrl; ?>';
        <?php endif; ?>
    </script>
<?php endif; ?>

<?= $this->endSection(); ?>
