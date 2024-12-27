<?= $this->extend('Views/dashboard'); ?>
<?= $this->section('content'); ?>
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
     <div class="container">
        <div class="payment-container">
            <h2 class="text-center mb-4">Pay Brochure Fees</h2>
            <p class="lead text-center" style="font-size:1.5 rem;">Brochure Fees: ₹<?= $brochureFee;?></p>
            <form action="<?= base_url('payment/process'); ?>" method="POST">
                <!-- <input type="hidden" name="amount" value="100000"> Amount in paisa -->
                <!-- <input type="hidden" name="name" value="Your Name"> -->
                <!-- <input type="hidden" name="email" value="your.email@example.com"> -->
                <!-- <input type="hidden" name="contact" value="9999999999"> -->
                <button type="submit" class="btn btn-pay btn-lg w-100">Pay ₹<?= $brochureFee;?></button>
            </form>
        </div>
    </div>
    <?= $this->endSection(); ?>