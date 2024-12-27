<?php
namespace App\Controllers;
use App\Models\StudentModel;
use App\Models\InstituteModel;
use App\Models\StudentInstituteAllocationModel;
use CodeIgniter\Controller;

class GetAdmission extends Controller
{
    public function __construct()
    {
        // Load necessary models
        $this->studentModel = new StudentModel();
        $this->instituteModel = new InstituteModel();
        $this->allocationModel = new StudentInstituteAllocationModel();
        $this->db = \Config\Database::connect();
    }

    public function showStudentDetails()
    {
        // Fetch UID from session
        $uid = session()->get('user_id');
        
        if (!$uid) {
            return redirect()->to('/login')->with('error', 'Session expired or UID not found.');
        }

        // Fetch student details based on UID
        // $student = $this->studentModel->where('uid', $uid)->first();

        $student = $this->studentModel
    ->select('students.*, studentdetails.id as studentdetails_id') // Select both student and studentdetails fields
    ->join('studentdetails', 'students.uid = studentdetails.uid', 'left') // Join on `uid`
    ->where('students.uid', $uid) // Ensure we're filtering by UID in the students table
    ->first();

        if (!$student) {
            return redirect()->to('/login')->with('error', 'Student not found.');
        }

        // Fetch the allocation status for the student
        // $allocation = $this->allocationModel->where('student_id', $student['id'])
        //                                      ->where('allocation_status', 'allocated')
        //                                      ->first();
        $allocation = $this->allocationModel
    ->where('student_id', $student['studentdetails_id']) // Use studentdetails.id for allocation
    ->where('allocation_status', 'allocated')
    ->first();

      $isAllocated = $allocation ? true : false;  // True if allocated, false otherwise

        // Get allocated institute details
        $allocated_institute = $allocation ? $this->instituteModel->find($allocation['institute_id']) : null;

        if (is_array($allocated_institute)) {
            $allocated_institute = (object) $allocated_institute;
        }

        $currentStage = $student['stage'];  // Assuming 'stage' is the column storing the student's current stage
        $alertMessage = '';  // Variable to hold alert message
        $redirectUrl = ''; 

        $desiredStage = 4;

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
            'allocated_institute' => $allocated_institute ? $allocated_institute->institute_name : 'Not Allocated',
            'isAllocated' => $isAllocated,
            'alertMessage' => $alertMessage,    
            'redirectUrl' => $redirectUrl

        ];

        

        // Return the student details view
        return view('get_admission', $data);
    }
    public function acceptAllocation()
    {
        // Get the UID from the session
        $uid = session()->get('user_id');  // Ensure you have stored 'uid' in session

        if (!$uid) {
            return redirect()->to('/login')->with('error', 'Session expired or invalid UID.');
        }

        // Find the student using UID
        // $student = $this->studentModel->where('uid', $uid)->first();
        $student = $this->studentModel
        ->select('students.*, studentdetails.id as studentdetails_id') // Select both student and studentdetails fields
        ->join('studentdetails', 'students.uid = studentdetails.uid', 'left') // Join on `uid`
        ->where('students.uid', $uid) // Ensure we're filtering by UID in the students table
        ->first();

        if (!$student) {
            return redirect()->to('/login')->with('error', 'Student not found.');
        }

        // Fetch the allocation record
        $allocation = $this->allocationModel->where('student_id', $student['studentdetails_id'])
                                             ->where('allocation_status', 'allocated')
                                             ->first();

        if ($allocation) {
            // Update the allocation status to "accepted"
            $this->allocationModel->update($allocation['id'], [
                'allocation_status' => 'accepted',
                'updated_at' => date('Y-m-d H:i:s') 
            ]);

            $updated = $this->studentModel->where('uid', $uid)
            ->set(['stage' => 5])
            ->update();

            // Redirect to the next step
            return redirect()->to('/fetch-documents')->with('success', 'Allocation accepted successfully!');
        }

        return redirect()->to('/getdetails')->with('error', 'No allocation found for this student.');
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
