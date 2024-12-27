<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm; /* Set margins for A4 */
            }
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333        }
        .page {
            width: 95%;
            min-height: 100vh; /* Ensure it takes up the full height */
            padding: 20pt; /* Reduced padding */
            background: #fff;
            box-sizing: border-box;
            margin-bottom:50px;
            border:solid black 1px;
            /* page-break-after: always; Force a page break after this section */
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px; /* Reduced margin */
            border-bottom: 2px solid purple; /* Underline for header */
            padding-bottom: 5px; /* Reduced padding */
        }
        .header img {
            width: 80px;
            height: 60px;
            margin-right: 10px; /* Reduced margin */
        }
        .header h1 {
            font-size: 22px; /* Slightly reduced font size */
            color: purple;
            margin: 0;
            text-align: left;
        }
        .section-title {
            font-size: 18px; /* Slightly reduced font size */
            color: purple;
            margin-top: 15px; /* Reduced margin */
            padding-bottom: 5px;
            border-bottom: 2px solid purple; /* Thicker underline */
        }
        .details-table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            border: 1px solid #ddd;
            font-size: 14px; /* Slightly reduced font size */
        }
        .details-table th, 
        .details-table td {
            padding: 5px 10px; /* Adjusted padding */
            text-align: left;
            vertical-align: top;
        }
        .details-table th {
            background-color: #e9ecef; /* Light gray background for headers */
            font-weight: bold;
            border-bottom: 2px solid #ddd; /* Bottom border for header */
            width: 30%; /* Fixed width for labels */
        }
        .details-table td {
            background-color: #fff;
            border-bottom: 1px solid #ddd; /* Bottom border for rows */
            width: 70%; /* Increased width for content */
        }
        .undertaking {
            font-size:16px;
            margin-top: 15px; /* Reduced margin */

        }
        .undertaking h2 {
            font-size: 22px; /* Slightly reduced font size */
            color: purple;
            text-align: center;
            margin-bottom: 10px; /* Reduced margin */
            text-transform: uppercase;
        }
        .undertaking p {
            text-align: justify;
            line-height: 1.5; /* Improved line height for readability */
            margin-bottom: 8px; /* Reduced margin */
        }
        .signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 20px; /* Reduced margin */
            font-size: 14px; /* Slightly reduced font size */
            
        }
        .signatures div {
            display: inline-block;
            text-align: center; /* Centers the text inside each div */
            width: 55%;
            text-align: center;
        }
        .signatures p {
            border-top: 1px solid #555;
            padding-top: 5px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="page">
        <!-- Header -->
        <div class="header">
            <img src="<?= base_url('/resources/logo.png'); ?>" alt="Logo">
            <h1>Sinhgad Technical Education Society</h1>
        </div>

        <!-- Student Information Section -->
        <h2 class="section-title">Student Information</h2>
        <table class="details-table">
            <tr><th>Name</th><td><?= $student['student_name'] ?></td></tr>
            <tr><th>UID</th><td><?= $student['uid'] ?></td></tr>
            <tr><th>Phone Number</th><td><?= $student['student_contact'] ?></td></tr>
            <tr><th>Gender</th><td><?= ucfirst($student['gender']) ?></td></tr>
            <tr><th>Email</th><td><?= $student['email'] ?></td></tr>
        </table>

        <!-- Additional Information Section -->
        <h2 class="section-title">Additional Information</h2>
        <table class="details-table">
            <tr><th>Mother's Name</th><td><?= $studentDetails['mother_name'] ?></td></tr>
            <tr><th>Date of Birth (DOB)</th><td><?= date('d/m/Y', strtotime($studentDetails['dob'])) ?></td></tr>
            <tr><th>Category</th><td><?= ucfirst($studentDetails['category']) ?></td></tr>
            <tr><th>Aadhaar Number</th><td><?= $studentDetails['aadhar'] ?></td></tr>
            <tr><th>Address</th><td><?= $studentDetails['address'] ?></td></tr>
        </table>

        <!-- Institute Allocation Section -->
        <h2 class="section-title">Institute Allocation</h2>
        <table class="details-table">
            <tr><th>Allocated Institute</th><td><?= $institute_name ?></td></tr>
            <tr><th>Allocation Status</th><td><?= ucfirst($studentInstitute['allocation_status']) ?></td></tr>
            <tr><th>Allocated On</th><td><?= date('d/m/Y', strtotime($studentInstitute['allocated_on'])) ?></td></tr>
        </table>

        <!-- Fee Details Section -->
        <h2 class="section-title">Fee Details</h2>
        <table class="details-table">
            <tr><th>Order ID</th><td><?= $feeDetails['order_id'] ?></td></tr>
            <tr><th>Payment ID</th><td><?= $feeDetails['payment_id'] ?></td></tr>
            <tr><th>Amount</th><td>₹<?= number_format($feeDetails['amount'], 2) ?></td></tr>
            <tr><th>Status</th><td><?= ucfirst($feeDetails['status']) ?></td></tr>
            <tr><th>Paid On</th><td><?= date('d/m/Y', strtotime($feeDetails['created_at'])) ?></td></tr>
        </table>
    </div>

    <!-- Undertaking Section (Second Page) -->
    <div class="page undertaking">
        <h2>Undertaking</h2>
        <p>1. We, the undersigned, are fully aware that the Fee Regulation Authority (FRA), Government of Maharashtra approves the admission fee of Engineering and Management education from time to time.</p>
        <p>We hereby agree to pay Interim / Adhoc fee prescribed by FRA. We further agree and undertake that if the final fee (Tuition + Development) and other charges decided by FRA are more than the Interim / Adhoc for any academic year, we will pay the difference to the Institute on demand.</p>
        <p>2. We hereby declare that we have carefully read and understood the rules and regulations of:</p>
        <ul>
            <li>a) Directorate of Technical Education (DTE) about admission.</li>
            <li>b) Government of Maharashtra about Prohibition of Ragging.</li>
            <li>c) Savitribai Phule Pune University about student’s eligibility, attendance, examinations, etc.</li>
        </ul>
        <p>3. We also agree to abide by the code of conduct in the campus and any changes during the student’s study period in the institution.</p>
        <div class="signatures">
            <div>
                <p>Student Signature</p>
            <div>
                <p>Guardian Signature</p>
            </div>
        </div>
    </div>
</body>
</html>
