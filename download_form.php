<?= $this->extend('Views/dashboard'); ?>
<?= $this->section('download-form'); ?>

<style>
    /* Container for the download form */
    .download-container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        text-align: center; /* Center content within the container */
    }

    /* Heading Style */
    .download-container h2 {
        color: #2C3E50;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 20px;
    }

    /* Lead Text Styling */
    .download-container p {
        font-size: 1.1rem;
        color: #34495E;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    /* Button Styling */
    .btn-download {
        background-color: #3498db; /* New color for the button */
        color: #fff;
        font-weight: bold;
        font-size: 1.2rem;
        padding: 15px;
        border-radius: 8px;
        transition: background-color 0.3s ease, transform 0.2s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 100%; /* Make button span the full width of the container */
    }

    /* Button Hover Effect */
    .btn-download:hover {
        background-color: #2980b9; /* Darker shade for hover effect */
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
    }

    /* Add a subtle animation when the page loads */
    .download-container {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
    <div class="download-container">
        <h2>Download Application Form</h2>
        <p class="lead">
            You can now download your application form by clicking the button below! It's simple and quick.
        </p>
        <form action="<?= base_url('admission-form/downloadPDF'); ?>" method="POST">
            <button type="submit" class="btn btn-download btn-lg">Download</button>
        </form>
    </div>
</div>

<?= $this->endSection(); ?>
