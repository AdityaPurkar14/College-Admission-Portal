<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\StudentDetailsModel;
use App\Models\StudentInstituteAllocationModel;
use App\Models\InstituteModel;
use App\Models\ProgramFeeModel;
use CodeIgniter\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mpdf\Mpdf;

class AdmissionForm extends Controller
{
    public function showpage(){
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }
        
        $userId = session()->get('user_id');
        $db = \Config\Database::connect();
        
        // Fetch user's program and fee details
        $studentModel = $db->table('students');
        $student = $studentModel->where('uid', $userId)->get()->getRow();
        $currentStage = $student->stage;  // Assuming 'stage' is the column storing the student's current stage
        $alertMessage = '';  // Variable to hold alert message
        $redirectUrl = ''; 

        $desiredStage = 7;

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
        return view('download_form');
    }
    public function index()
    {
        try {
        // Load necessary models
        $studentModel = new StudentModel();
        $studentDetailsModel = new StudentDetailsModel();
        $studentInstituteModel = new StudentInstituteAllocationModel();
        $instituteModel = new InstituteModel();
        $programFee = new ProgramFeeModel();

        // Get the student ID (uid) from the session
        $session = session();
        $uid = $session->get('user_id'); // Assuming 'uid' is stored in the session

        if (!$uid) {
            // Redirect to login or show an error if uid is not found in session
            return redirect()->to('/login');
        }

        // Fetch the student's basic information using the uid
        $student = $studentModel->where('uid', $uid)->first();

        if (!$student) {
            // Handle the case where the student is not found
            return redirect()->to('/login')->with('error', 'Student not found');
        }

        // Fetch the student's details
        $studentDetails = $studentDetailsModel->where('uid', $uid)->first();

        if (!$studentDetails) {
            // Handle the case where student details are not found
            return redirect()->to('/login')->with('error', 'Student details not found');
        }

        // Fetch the student's institute allocation details using student_id from studentDetails
        $studentInstitute = $studentInstituteModel->where('student_id', $studentDetails['id'])->first();

        if (!$studentInstitute) {
            // Handle the case where the student is not allocated an institute
            return redirect()->to('/login')->with('error', 'Institute allocation not found');
        }

        // Fetch the institute name from the institutes table using institute_id
        $institute = $instituteModel->find($studentInstitute['institute_id']);

        if (!$institute) {
            // Handle the case where the institute is not found
            return redirect()->to('/login')->with('error', 'Institute not found');
        }
        
        $feeDetails = $programFee->where('user_id', $student['uid'])->get()->getRowArray();

        // Pass data to the view
        // return view('admission_form', [
        //     'student' => $student,
        //     'studentDetails' => $studentDetails,
        //     'studentInstitute' => $studentInstitute,
        //     'institute_name' => $institute['institute_name'],
        //     'category' => $studentDetails['category'],
        //     'aadhar' => $studentDetails['aadhar']
        // ]);

        // require_once APPPATH . './vendor/autoload.php'; // Adjusted path to autoload.php

        // $html = view('admission_form',[
        //     'student' => $student,
        //     'studentDetails' => $studentDetails,
        //     'studentInstitute' => $studentInstitute,
        //     'institute_name' => $institute['institute_name'],
        //     'category' => $studentDetails['category'],
        //     'aadhar' => $studentDetails['aadhar'],
        //     'feeDetails' => $feeDetails
        // ]);
        $data = [
            'student' => $student,
            'studentDetails' => $studentDetails,
            'studentInstitute' => $studentInstitute,
            'institute_name' => $institute['institute_name'],
            'category' => $studentDetails['category'],
            'aadhar' => $studentDetails['aadhar'],
            'feeDetails' => $feeDetails
        ];
        log_message('debug', 'View data: ' . print_r($data, true));

    // Test rendering
    $html = view('admission_form', $data);
    if (!$html) {
        throw new \Exception('View rendering failed.');
    }

        
            // // Initialize mPDF
            // $mpdf = new Mpdf([
            //     'format' => 'A4',
            //     'margin_top' => 10,
            //     'margin_bottom' => 10,
            //     'margin_left' => 10,
            //     'margin_right' => 10,
            // ]);
            
            // // Write HTML to PDF
            // $mpdf->WriteHTML($html);

            // // Output as download
            // // $mpdf->Output('Admission_Form_' . $studentData['student_name'] . '.pdf', 'D'); // Trigger download with student name
            // return $mpdf->Output('Admission_Form.pdf', 'D');


            // //DomPDf
            // $options = new Options();
            // $options->set('defaultFont', 'DejaVu Sans'); // For Unicode support
            // $options->set('isHtml5ParserEnabled', true);
            // $dompdf = new Dompdf($options);
            // $options->set('margin_top', 10); // Adjust as necessary
            // $options->set('margin_bottom', 10);
            // $options->set('margin_left', 10);
            // $options->set('margin_right', 10);

            // // Load HTML into Dompdf
            // $dompdf->loadHtml($html);

            // // Set paper size and orientation
            // $dompdf->setPaper('A4', 'portrait');

            // // Render the PDF
            // $dompdf->render();

            // // Output the PDF to download
            // $dompdf->stream('Admission_Form_' . $student['student_name'] . '.pdf', ['Attachment' => 1]);
            $dompdf = new Dompdf();

            // Load HTML content
            $html = view('admission_form', $data);
        
            // Set paper size to A4 and orientation to portrait
            $dompdf->setPaper('A4', 'portrait');
        
            // Render the HTML as PDF
            $dompdf->loadHtml($html);
            $dompdf->render();
            $filename = 'Application_Form_' . $student['student_name'] . '.pdf'; 
            // Force download with a specific filename
            $dompdf->stream($filename, ["Attachment" => true]);

        } catch (\Exception $e) {
            log_message('error', 'PDF Generation Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to generate PDFaw: ' . $e->getMessage());
        }


}
    public function downloadPDF()
    {
        // Load necessary models
        $studentModel = new StudentModel();
        $studentDetailsModel = new StudentDetailsModel();
        $studentInstituteModel = new StudentInstituteAllocationModel();
        $instituteModel = new InstituteModel();

        // Get the student ID (uid) from the session
        $session = session();
        $uid = $session->get('user_id'); // Assuming 'uid' is stored in the session

        if (!$uid) {
            return redirect()->to('/login');
        }

        // Fetch the student's data
        $student = $studentModel->where('uid', $uid)->first();
        $studentDetails = $studentDetailsModel->where('uid', $uid)->first();
        $studentInstitute = $studentInstituteModel->where('student_id', $studentDetails['id'])->first();
        $institute = $instituteModel->find($studentInstitute['institute_id']);

        // Prepare data to be passed to the view for PDF generation
        $data = [
            'student' => $student,
            'studentDetails' => $studentDetails,
            'studentInstitute' => $studentInstitute,
            'institute_name' => $institute['institute_name'],
            'category' => $studentDetails['category'],
            'aadhar' => $studentDetails['aadhar']
        ];

        // Load the HTML content for the PDF
        $htmlContent = view('admission_form', $data);

        // Initialize DOMPDF with options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options); 

        // Load the HTML content into DOMPDF
        $dompdf->loadHtml($htmlContent);

        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF (first pass to auto-calculate height/width)
        $dompdf->render();

        // Stream the PDF to browser for download
        $dompdf->stream("admission_form.pdf", array("Attachment" => 1)); // 1 forces download
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
