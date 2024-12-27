<?php
namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\StudentDetailsModel;
use App\Models\StudentInstituteAllocationModel;
use App\Models\InstituteModel;
use App\Models\DocumentRequirementsModel;

class FetchDocuments extends BaseController
{
    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->studentDetailsModel = new StudentDetailsModel();
        $this->allocationModel = new StudentInstituteAllocationModel();
        $this->instituteModel = new InstituteModel();
        $this->documentRequirementsModel = new DocumentRequirementsModel();
    }

    public function fetchdocuments()
    {
        // Get UID from session
        $uid = session()->get('user_id');
        if (!$uid) {
            return redirect()->to('/login')->with('error', 'Session expired or UID not found.');
        }

        // Fetch student details using UID
        $student = $this->studentModel->where('uid', $uid)->first();
        if (!$student) {
            return redirect()->to('/login')->with('error', 'Student not found.');
        }

        // Join with studentdetails table to get category
        $studentDetails = $this->studentDetailsModel
            ->where('uid', $student['uid'])
            ->select('id,category')
            ->first();
        
        // Fetch the allocation status for the student
        $allocation = $this->allocationModel
            ->where('student_id', $studentDetails['id'])
            ->where('allocation_status', 'allocated')
            ->first();
        
        // Get allocated institute details
        $allocated_institute = $allocation ? $this->instituteModel->find($allocation['institute_id']) : null;

        $instituteAddress = $allocated_institute ? $allocated_institute['location'] : 'Address not available';


        // Get document requirements based on program and category
        // $documents = $this->documentRequirementsModel
        //     ->where('Program_Type', $student['program_interested'])
        //     ->orWhere('Program_Type', 'All')
        //     ->groupStart()
        //         ->where('Category', $studentDetails['category'])
        //         ->orWhere('Category', 'All')
        //     ->groupEnd()
        //     ->findAll();
        $documents = $this->documentRequirementsModel
    ->groupStart()
        ->where('Program_Type', $student['program_interested'])
        ->orWhere('Program_Type', 'All')
    ->groupEnd()
    ->groupStart()
        ->like('Category', $studentDetails['category'])
        ->orLike('Category', 'All')
    ->groupEnd()
    ->findAll();


    $currentStage = $student['stage'];  // Assuming 'stage' is the column storing the student's current stage
        $alertMessage = '';  // Variable to hold alert message
        $redirectUrl = ''; 

        $desiredStage = 5;

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



        // Prepare data for the view
        $data = [
            'student' => $student,
            'category' => $studentDetails['category'],
            'allocated_institute' => $allocated_institute ? $allocated_institute['institute_name'] : 'Not Allocated',
            'address' => $instituteAddress,
            'documents' => $documents,
            'alertMessage' => $alertMessage,    
            'redirectUrl' => $redirectUrl

        ];

        return view('fetch_documents', $data);
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
            return '/admission';
        case 8:
            return '/hostel-admission';
        default:
            return '/dashboard';
    }
}

}
