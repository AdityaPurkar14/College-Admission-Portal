<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use Razorpay\Api\Api;

class PayFees extends Controller
{
    private $apiKey = 'rzp_test_ZJUCaTR2A09Ggj';
    private $apiSecret = 'AaWIjV6SmkRAEFUMCL4u5Jtn';

    // Index for Fee Payment
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }
        
        $userId = session()->get('user_id');
        $db = \Config\Database::connect();
        
        // Fetch user's program and fee details
        $studentModel = $db->table('students');
        $student = $studentModel->where('uid', $userId)->get()->getRow();
        $programModel = $db->table('programs');
        $program = $programModel->where('program_name', $student->program_interested)->get()->getRow();
        
        // Fetch the program's fees
        $fees = $program->fees;

        $currentStage = $student->stage;  // Assuming 'stage' is the column storing the student's current stage
        $alertMessage = '';  // Variable to hold alert message
        $redirectUrl = ''; 

        $desiredStage = 6;

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

        
        // Load the payment view with the fees
        return view('feepayment', [
            'fees' => $fees,
            'alertMessage' => $alertMessage,    
            'redirectUrl' => $redirectUrl

        ]);
    }

    // Process Fee Payment
    public function processPayment()
    {
        $userId = session()->get('user_id');
        $db = \Config\Database::connect();

        // Fetch user's program and fee details
        $studentModel = $db->table('students');
        $student = $studentModel->where('uid', $userId)->get()->getRow();

        if (!$student) {
            return redirect()->to('/payment/failed')->with('error', 'Student not found');
        }

        $programModel = $db->table('programs');
        $program = $programModel->where('program_name', $student->program_interested)->get()->getRow();

        if (!$program) {
            return redirect()->to('/payment/failed')->with('error', 'Program not found');
        }

        $fees = $program->fees;
        $feesInPaisa = $fees * 100; // Amount in paisa

        // Initialize Razorpay API
        $api = new Api($this->apiKey, $this->apiSecret);

        // Create Razorpay order
        $orderData = [
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $feesInPaisa,
            'currency' => 'INR',
            'payment_capture' => 1
        ];

        $razorpayOrder = $api->order->create($orderData);
        $orderId = $razorpayOrder['id'];

        // Store the transaction in the database
        $transactionModel = $db->table('feedetails');
        $transactionModel->insert([
            'order_id' => $orderId,
            'amount' => $fees,
            'name' => $student->student_name,
            'email' => $student->email,
            'contact' => $student->student_contact,
            'status' => 'created',
            'user_id' => $userId,
        ]);

        // Pass Razorpay details to the view
        $data = [
            'key' => $this->apiKey,
            'order_id' => $orderId,
            'amount' => $feesInPaisa,
            'name' => $student->student_name,
            'email' => $student->email,
            'contact' => $student->student_contact
        ];

        return view('razorpay_view_fee', $data);
    }

    // Payment Callback (Razorpay Success or Failure)
    public function paymentCallback()
    {
        $userId = session()->get('user_id');
        $api = new Api($this->apiKey, $this->apiSecret);

        $razorpayPaymentId = $this->request->getPost('razorpay_payment_id');
        $razorpayOrderId = $this->request->getPost('razorpay_order_id');
        $razorpaySignature = $this->request->getPost('razorpay_signature');

        if (empty($razorpayPaymentId) || empty($razorpaySignature)) {
            $db = \Config\Database::connect();
            $transactionModel = $db->table('feedetails');
            $transactionModel->where('order_id', $razorpayOrderId)
                ->update(['status' => 'failed']);
            return redirect()->to('/payment/failed');
        }

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $razorpayOrderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $razorpaySignature
            ]);

            // Update transaction status to paid
            $db = \Config\Database::connect();
            $transactionModel = $db->table('feedetails');
            $transactionModel->where('order_id', $razorpayOrderId)
                ->update([
                    'status' => 'paid',
                    'payment_id' => $razorpayPaymentId,
                    'signature' => $razorpaySignature
                ]);
                $db->table('students')
            ->where('uid', $userId)
            ->update(['stage' => 7]);
            
            return redirect()->to('/admission-form');
        } catch (\Exception $e) {
            $db = \Config\Database::connect();
            $transactionModel = $db->table('feedetails');
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

