<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <script>
        var options = {
            "key": "<?= $key; ?>", // Razorpay API Key
            "amount": "<?= $amount; ?>", // Amount in paisa
            "currency": "INR",
            "name": "<?= $name; ?>",
            "description": "Admission Fees Payment",
            "order_id": "<?= $order_id; ?>", // Order ID generated from server
            "handler": function (response){
                // Redirect to payment callback
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = "<?= base_url('payment/callback'); ?>";

                var razorpayPaymentIdInput = document.createElement('input');
                razorpayPaymentIdInput.type = 'hidden';
                razorpayPaymentIdInput.name = 'razorpay_payment_id';
                razorpayPaymentIdInput.value = response.razorpay_payment_id;
                form.appendChild(razorpayPaymentIdInput);

                var razorpayOrderIdInput = document.createElement('input');
                razorpayOrderIdInput.type = 'hidden';
                razorpayOrderIdInput.name = 'razorpay_order_id';
                razorpayOrderIdInput.value = response.razorpay_order_id;
                form.appendChild(razorpayOrderIdInput);

                var razorpaySignatureInput = document.createElement('input');
                razorpaySignatureInput.type = 'hidden';
                razorpaySignatureInput.name = 'razorpay_signature';
                razorpaySignatureInput.value = response.razorpay_signature;
                form.appendChild(razorpaySignatureInput);

                document.body.appendChild(form);
                form.submit();
            },
            "prefill": {
                "name": "<?= $name; ?>", // User's name
                "email": "<?= $email; ?>", // User's email
                "contact": "<?= $contact; ?>" // User's contact number
            },
            // "theme": {
            //     "color": "#F37254" // Theme color
            // }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        var rzp2= new Razorpay(options);

// Handle the failure
rzp2.on('payment.failed', function (response) {
    // Redirect to a failure page or show a custom error message
    alert("Payment failed: " + response.error.description);
    window.location.href = "<?= base_url('payment/failed'); ?>";
});

rzp2.open();
    </script>
</body>
</html>
