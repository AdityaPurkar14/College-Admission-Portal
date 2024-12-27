<h2>Payment Successful</h2>
<p>Your payment has been successfully processed.</p>

<div class="print-button">
    <button id="downloadButton" onclick="downloadPDF()">Download PDF</button>
    <!-- <a href="<?= base_url('admission-form/downloadPDF') ?>" class="btn btn-primary">Download Admission Form</a> -->

</div>

<script>
    function downloadPDF() {
        window.location.href = '<?= base_url('/admission-form/downloadPDF'); ?>';
    }
</script>