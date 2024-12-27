<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\StudentDetailsModel;
use CodeIgniter\Controller;

class FillAdmission extends Controller
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }
        $session = session();
        $userId = $session->get('user_id');

        // Fetch student data from the 'students' table
        $studentModel = new StudentModel();
        $studentData = $studentModel->where('uid', $userId)->first();

        $currentStage = $studentData['stage'];  // Assuming 'stage' is the column storing the student's current stage
        $alertMessage = '';  // Variable to hold alert message
        $redirectUrl = ''; 

        $desiredStage = 3;

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
    
        return view('filladmission', ['studentData' => $studentData, 'alertMessage' => $alertMessage,
        'redirectUrl' => $redirectUrl]);
       
    }


    public function submitAdmission()
    {
        $session = session();
        $userId = $session->get('user_id');

        // Define validation rules based on selected program
        $program = $this->request->getPost('program_interested');
        $rules = [
            'university_name' => 'required|max_length[255]',
            'mother_name' => 'required|max_length[100]',
            'address' => 'required|max_length[500]',
            'dob' => 'required|valid_date',
            'category' => 'required',
            'aadhar' => 'required|numeric|exact_length[12]',
            'ssc_marks' => 'required|numeric|greater_than[0]|less_than_equal_to[100]',
            'ssc_board' => 'required|max_length[255]',
            'hsc_percentage' => 'required|numeric|greater_than[0]|less_than_equal_to[100]',
            'hsc_board' => 'required|max_length[255]',
            'entrance_percentage' => 'required|numeric|greater_than[0]|less_than_equal_to[100]',
        ];

        // Additional rules based on program type
        if ($program === 'MCA' || $program === 'MBA') {
            $rules['grad_percentage'] = 'required|numeric|greater_than[0]|less_than_equal_to[100]';
            $rules['grad_board'] = 'required|max_length[255]';
        } elseif ($program === 'Engineering') {
            $rules['physics_marks'] = 'required|numeric|greater_than[0]|less_than_equal_to[100]';
            $rules['chemistry_marks'] = 'required|numeric|greater_than[0]|less_than_equal_to[100]';
            $rules['maths_marks'] = 'required|numeric|greater_than[0]|less_than_equal_to[100]';
            $rules['engineering_preferences.*'] = 'required|max_length[100]';
        } elseif ($program === 'Pharmacy' || $program === 'Architecture') {
            $rules['physics_marks'] = 'required|numeric|greater_than[0]|less_than_equal_to[100]';
            $rules['chemistry_marks'] = 'required|numeric|greater_than[0]|less_than_equal_to[100]';
            $rules['maths_marks'] = 'required|numeric|greater_than[0]|less_than_equal_to[100]';
        }

        if ($this->validate($rules)) {
            // Validation successful, save data to 'studentDetails' table
            $studentDetailsModel = new StudentDetailsModel();
            $data = [
                'uid' => $userId,
                'university_name' => $this->request->getPost('university_name'),
                'mother_name' => $this->request->getPost('mother_name'),
                'address' => $this->request->getPost('address'),
                'dob' => $this->request->getPost('dob'),
                'category' => $this->request->getPost('category'),
                'aadhar' => $this->request->getPost('aadhar'),
                'ssc_marks' => $this->request->getPost('ssc_marks'),
                'ssc_board' => $this->request->getPost('ssc_board'),
                'hsc_percentage' => $this->request->getPost('hsc_percentage'),
                'hsc_board' => $this->request->getPost('hsc_board'),
                'entrance_percentage' => $this->request->getPost('entrance_percentage'),
                // Additional fields as per program
            ];
            

            if ($program === 'MCA' || $program === 'MBA') {
                $data['grad_percentage'] = $this->request->getPost('grad_percentage');
                $data['grad_board'] = $this->request->getPost('grad_board');
            } elseif ($program === 'Engineering') {
                $data['physics_marks'] = $this->request->getPost('physics_marks');
                $data['chemistry_marks'] = $this->request->getPost('chemistry_marks');
                $data['maths_marks'] = $this->request->getPost('maths_marks');
                $data['engineering_preferences'] = json_encode($this->request->getPost('engineering_preferences'));
            }elseif ($program === 'Pharmacy' || $program === 'Architecture') {
                $data['physics_marks'] = $this->request->getPost('physics_marks');
                $data['chemistry_marks'] = $this->request->getPost('chemistry_marks');
                $data['maths_marks'] = $this->request->getPost('maths_marks');
            }
            log_message('debug', 'Student Data to Insert: ' . print_r($data, true));
            $studentDetailsModel->insert($data);
           
            $studentModel = new StudentModel();
            $updated = $studentModel->where('uid', $userId)
                        ->set(['stage' => 4])
                        ->update();

            return redirect()->to('/getdetails')->with('success', 'Admission details submitted successfully');
        } else {
            // Validation failed, return with errors
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
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
            return '/admission';
        case 8:
            return '/hostel-admission';
        default:
            return '/dashboard';
    }
}
}