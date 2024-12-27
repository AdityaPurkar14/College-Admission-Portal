<?php
namespace App\Controllers;
use App\Models\StudentModel;
use CodeIgniter\Email\Email;
use App\Models\StateModel;
use App\Models\ProgramModel;
use App\Models\ProgramEntranceMappingModel;
use App\Models\ExamModel;

class Register extends BaseController
{
    public $program_name;
    public function index(): string
    {
        $stateModel = new StateModel();  // Initialize the model
        $data['states'] = $stateModel->getStates(); 

        $programModel = new ProgramModel();
        $data['programs'] = $programModel->findAll();



        return view('registration',$data);
    }
    public function insert(): string
    {
        $students = new StudentModel();
        
        //generation of uid and password
        $uid = $this->generateUniqueUID($students);
        $plainPassword = $this->generateRandomPassword();
        $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);
        
        //fetch program name according to program selected
        $program_id = $this->request->getPost('program_interested');
        $db = \Config\Database::connect();
        $query = $db->query("SELECT program_name FROM programs WHERE program_id = ?", [$program_id]);
        $result = $query->getRow(); // Get the first row of the result
        if ($result) {
            $this->program_name = $result->program_name;
        } else {
            $this->program_name = 'Unknown Program';
        }
        
        // fetch entrance_name according to id
        $data = [
           // 'enquiry_id'        => $this->request->getPost('enquiry_id'),
            'uid'               => $this->generateUniqueUID($students),
            'password'          => $hashedPassword,
            'student_name'      => $this->request->getPost('student_name'),
            'degree'            => $this->request->getPost('degree'),
            // 'program_interested'=> $this->request->getPost('program_interested'),
            'program_interested'=> $this->program_name,
            'student_contact'   => $this->request->getPost('student_contact'),
            'guardian_contact'  => $this->request->getPost('guardian_contact'),
            'city'              => $this->request->getPost('city'),
            'state'             => $this->request->getPost('state'),
            'email'             => $this->request->getPost('email'),
            'gender'            => $this->request->getPost('gender'),
            'entrance_name'     => $this->request->getPost('entrance_name'),
            'entrance_score'    => $this->request->getPost('entrance_score'),
            'query'             => $this->request->getPost('query'),
            'registration_date' => $this->request->getPost('registration_date'),
            'first_time_login'  => true
        ];
            if ($students->insert($data)) {
                $this->sendEmail($data['email'], $data['student_name'], $uid, $plainPassword);
                session()->setFlashdata('success', 'Registration successful! Please log in.');
                return view('login', ['alert' => 'Registration successful!']);
            } else {
                return view('registration', ['alert' => 'Registration failed. Please try again.']);
            }

}
private function sendEmail(string $email, string $studentName, string $uid, string $password): void
{
    $emailService = \Config\Services::email();

    $emailService->setFrom('shreyashdeshmane7@gmail.com', 'Sinhgad Technical Education Society'); // Your email and name
    $emailService->setTo($email); // Student's email
    $emailService->setSubject('Registration Successful');
    $emailService->setMessage("<p>Dear $studentName,</p>
        <p>Thanks for your interest in admission at Sinhgad Institutes. We will get back to you soon.</p>
        <p>Your UID for further reference is: <strong>$uid</strong></p>
        <p>Your Password is: <strong>$password</strong></p>
        <p>Please keep this information safe for future login purposes.</p>
        <p>Best Regards,<br>Sinhgad Institues</p>");
    if (!$emailService->send()) {
        // Log error message if the email couldn't be sent
        log_message('error', $emailService->printDebugger(['headers']));
    }
}

    private function generateUniqueUID($students): string
{
    $currentMonth = date('n'); 
    $currentYear = date('Y');

    if ($currentMonth >= 6) {
        $yearPrefix = substr($currentYear, 2) . substr($currentYear + 1, 2);
    } else {
        $yearPrefix = substr($currentYear - 1, 2) . substr($currentYear, 2); 
    }

    $prefix="";
   
    if($this->program_name=='Architecture'){
        $prefix="ARCH";
    }
    else if($this->program_name=="Diploma"){
        $prefix="DP";
    }
    else if($this->program_name=="Pharmacy"){
        $prefix="PH";
    }
    else if($this->program_name=="Engineering"){
        $prefix="FE";
    }
    else if($this->program_name=="MBA"){
        $prefix="MBA";
    }
    else if($this->program_name=="MCA"){
        $prefix="MCA";
    }
    $prefix = $prefix. $yearPrefix;
    do {
        $randomNumber = mt_rand(100000, 999999);
        $uid = $prefix . $randomNumber;

        $existingUID = $students->where('uid', $uid)->first();
    } while ($existingUID);

    return $uid;
}

private function generateRandomPassword(): string
{
    $upperLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowerLetters = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $specialCharacters = '!@#$%^&*()_-+=<>?';

    
    $password = $upperLetters[rand(0, strlen($upperLetters) - 1)] .
                $lowerLetters[rand(0, strlen($lowerLetters) - 1)] .
                $numbers[rand(0, strlen($numbers) - 1)] .
                $specialCharacters[rand(0, strlen($specialCharacters) - 1)];

    
    $allCharacters = $upperLetters . $lowerLetters . $numbers . $specialCharacters;

    for ($i = 4; $i < 8; $i++) {
        $password .= $allCharacters[rand(0, strlen($allCharacters) - 1)];
    }

    return str_shuffle($password);
}

public function getExamsByProgram($programId)
{
    $mappingModel = new ProgramEntranceMappingModel();
    $examModel = new ExamModel();
    
    // Fetch exam IDs associated with the selected program
    $examIds = $mappingModel->where('program_id', $programId)->findAll();

    // Fetch exam names based on the IDs
    $exams = [];
    foreach ($examIds as $examId) {
        $exam = $examModel->find($examId['exam_id']);
        if ($exam) {
            $exams[] = $exam;
        }
    }
    
    return $this->response->setJSON($exams);
}

}
