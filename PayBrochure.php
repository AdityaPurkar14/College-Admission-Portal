<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Razorpay\Api\Api;

class PayBrochure extends Controller
{
    // Razorpay credentials
    private $apiKey = 'rzp_test_ZJUCaTR2A09Ggj';
    private $apiSecret = 'AaWIjV6SmkRAEFUMCL4u5Jtn';
    public $user_id=null;

    public function __construct()
    {
        // Initialize the global user_id variable when the controller is loaded
        $this->user_id = null;
    }

    
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }
        $userId = session()->get('user_id'); // Get logged-in user's ID
        $this->user_id = $userId; // Get logged-in user's ID


        // Fetch user data (e.g., program_interested) and the brochure fee from the database
        $db = \Config\Database::connect();

        // Fetch the student's program and brochure fee
        $studentModel = $db->table('students');
        $student = $studentModel->where('uid', $userId)->get()->getRow();
        $programModel = $db->table('programs');
        $program = $programModel->where('program_name', $student->program_interested)->get()->getRow();;

        $brochureFee = $program->brochure_fees;

        $currentStage = $student->stage;  // Assuming 'stage' is the column storing the student's current stage
        $alertMessage = '';  // Variable to hold alert message
        $redirectUrl = ''; 

        $desiredStage = 2;

        if ($desiredStage > $currentStage) {
            // If the user is trying to access a future stage (stage > currentStage)
            $alertMessage = 'Please complete previous steps first to access this page.';
            $redirectUrl = $this->redirectToStage($currentStage); // Redirect to the correct stage
        } 
        else if ($desiredStage < $currentStage) {
            // If the user is trying to access a completed stage (stage < currentStage)
            $alertMessage = 'You have already completed this step.';
            $redirectUrl = $this->redirectToStage($currentStage); // Redirect to the current stage
        } 
        else {
            // If the desired stage is the same as the current stage, do nothing
            $alertMessage = '';  // No alert message
            $redirectUrl = '';  // No redirection
        }


        // Show the payment page
        return view('paybrochure',[
            'brochureFee' =>$brochureFee,
            'alertMessage' => $alertMessage,    
            'redirectUrl' => $redirectUrl // Pass brochureFee to the view
        ]);
    }

    public function success()
    {
        return view('success'); // Load the success view
    }

    public function failed()
    {
        return view('failure'); // Load the failure view
    }

    public function processPayment()
    {
        // Ensure user is logged in and retrieve user details from session
       
        $userId = session()->get('user_id'); // Get logged-in user's ID

        // Fetch user data (e.g., program_interested) and the brochure fee from the database
        $db = \Config\Database::connect();

        // Fetch the student's program and brochure fee
        $studentModel = $db->table('students');
        $student = $studentModel->where('uid', $userId)->get()->getRow();;

        if (!$student) {
            return redirect()->to('/payment/failed')->with('error', 'Student not found');
        }

        // Fetch the program's brochure fee based on the student's interested program
        $programModel = $db->table('programs');
        $program = $programModel->where('program_name', $student->program_interested)->get()->getRow();;

        if (!$program) {
            return redirect()->to('/payment/failed')->with('error', 'Program not found');
        }

        $brochureFee = $program->brochure_fees;
        $brochureFeeinPaisa=$brochureFee*100; // Amount in paisa

        // Initialize Razorpay API
        $api = new Api($this->apiKey, $this->apiSecret);

        // Create an order with Razorpay
        $orderData = [
            'receipt' => 'order_rcptid_' . time(), // Unique receipt ID
            'amount' => $brochureFeeinPaisa, // Amount in paisa
            'currency' => 'INR',
            'payment_capture' => 1 // Auto capture
        ];

        // Create Razorpay order
        $razorpayOrder = $api->order->create($orderData);
        $orderId = $razorpayOrder['id'];

        // Store transaction details in the database
        $transactionModel = $db->table('transactions');
        $transactionModel->insert([
            'order_id' => $orderId,
            'amount' => $brochureFee,
            'name' => $student->student_name,
            'email' => $student->email,
            'contact' => $student->student_contact,
            'status' => 'created',
            'user_id' => $userId, // Track user ID
        ]);

        // Prepare data for Razorpay checkout
        $data = [
            'key' => $this->apiKey,
            'order_id' => $orderId,
            'amount' => $brochureFeeinPaisa,
            'name' => $student->student_name,
            'email' => $student->email,
            'contact' => $student->student_contact
        ];

        // Load the Razorpay view to proceed with payment
        return view('razorpay_view', $data);
    }

    public function paymentCallback()
    {
        $userId = session()->get('user_id'); // Get logged-in user's ID
        // Initialize Razorpay API
        $api = new Api($this->apiKey, $this->apiSecret);

        // Collect Razorpay POST data
        $razorpayPaymentId = $this->request->getPost('razorpay_payment_id');
        $razorpayOrderId = $this->request->getPost('razorpay_order_id');
        $razorpaySignature = $this->request->getPost('razorpay_signature');

        // Log callback data for debugging
        log_message('info', 'Callback Data: ' . json_encode($this->request->getPost()));

        // Check if Razorpay response contains the payment ID and signature
        if (empty($razorpayPaymentId) || empty($razorpaySignature)) {
            // Payment failed, update the transaction status to 'failed'
            log_message('error', 'Payment failed or incomplete. Order ID: ' . $razorpayOrderId);

            // Update the transaction status in the database
            $db = \Config\Database::connect();
            $transactionModel = $db->table('transactions');
            $transactionModel->where('order_id', $razorpayOrderId)
                ->update(['status' => 'failed']);

            return redirect()->to('/payment/failed');
        }

        // Verify the payment signature
        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $razorpaySignature
            ]);

            // Update the transaction status to 'paid'
            $db = \Config\Database::connect();
            $transactionModel = $db->table('transactions');
            $transactionModel->where('order_id', $razorpayOrderId)
                ->update([
                    'status' => 'paid',
                    'payment_id' => $razorpayPaymentId,
                    'signature' => $razorpaySignature
                ]);

              $db->table('students')
            ->where('uid', $userId)
            ->update(['stage' => 3]);
            
            log_message('info', 'Transaction status updated to PAID for order ID: ' . $razorpayOrderId);

            return redirect()->to('/fill-admission');
        } catch (\Exception $e) {
            // Log the exception
            log_message('error', 'Payment verification failed: ' . $e->getMessage());

            // Update the transaction status to 'failed'
            $db = \Config\Database::connect();
            $transactionModel = $db->table('transactions');
            $transactionModel->where('order_id', $razorpayOrderId)
                ->update(['status' => 'failed']);

            return redirect()->to('/payment/failed');
        }
    }
    private function redirectToStage($stage)
    {
        switch ($stage) {
            case 2:
                return '/paybrochure';
            case 3:
                return '/fill-admission';
            case 4:
                return '/getdetails';
            case 5:
                return '/fetch-documents';
            case 6:
                return '/feepayment';
            case 7:
                return '/admission-form';
            case 8:
                return '/hostel-admission';
            default:
                return '/dashboard';
        }
    }
}
