<?php

namespace App\Controllers;

use App\Models\StudentModel;
use CodeIgniter\Controller;

class Login extends BaseController
{
    public function index(): string
    {
        return view('login');
    }

    public function loginProcess()
    {
        $studentModel = new StudentModel();

        // Get input from the login form
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Check if it's the admin
        if ($email === 'admin@gmail.com' && $password === 'password') {
            return redirect()->to('/add-program');
        }

        // Fetch the student record using email
        $student = $studentModel->where('email', $email)->first();

        // Validate the student record and password
        if ($student && password_verify($password, $student['password'])) {
            // Check if it's the first login
            if ($student['first_time_login'] == 1) {
                // Set session data
                $sessionData = [
                    'user_id'   => $student['uid'],
                    'email'     => $student['email'],
                    'name'      => $student['student_name'],
                    'stage'     => $student['stage'],
                    'isLoggedIn' => true,
                ];
                session()->set($sessionData);

                // Redirect to change password page
                return redirect()->to('/change-pass')->with('alert', 'Please change your password on your first login');
            }

            // Set session data for subsequent logins
            $sessionData = [
                'user_id'   => $student['uid'],
                'email'     => $student['email'],
                'name'      => $student['student_name'],
                'stage'     => $student['stage'],
                'isLoggedIn' => true,
            ];
            session()->set($sessionData);

            // Redirect based on the user's stage
            return $this->redirectToStage($student['stage']);
        } else {
            return redirect()->back()->with('alert', 'Invalid email or password');
        }
    }

    private function redirectToStage($stage)
    {
        switch ($stage) {
            case 2:
                return redirect()->to('/paybrochure');
            case 3:
                return redirect()->to('/fill-admission');
            case 4:
                return redirect()->to('/getdetails');
            case 5:
                return redirect()->to('/fetch-documents');
            case 6:
                return redirect()->to('/feepayment');
            case 7:
                return redirect()->to('/admission');
            case 8:
                return redirect()->to('/hostel-admission');
            default:
                return redirect()->to('/dashboard');
        }
    }
}
