<?php

namespace App\Controllers;

use App\Models\StudentModel;

class ChangePass extends BaseController
{
    public function index(): string
    {
        return view('passChange');
    }

    public function updatePassword()
    {
        $studentModel = new StudentModel();
        $userId = session()->get('user_id');

        // Check if the user is logged in
        if (!$userId) {
            return redirect()->back()->with('alert', 'Session expired. Please log in again.');
        }

        // Retrieve form input
        $currentPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password');
        $repeatPassword = $this->request->getPost('repeat_password');

        // Retrieve the user from the database
        $user = $studentModel->where('uid', $userId)->first();

        // Handle case where the user is not found
        if (!$user) {
            return redirect()->back()->with('alert', 'User not found. Please try again.');
        }

        // Validate current password
        if (!password_verify($currentPassword, $user['password'])) {
            return redirect()->back()->with('alert', 'Current password is incorrect.');
        }

        // Validate new password match
        if ($newPassword !== $repeatPassword) {
            return redirect()->back()->with('alert', 'Passwords do not match.');
        }

        // Update password and first_time_login flag
        $studentModel->where('uid', $userId)->set([
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'first_time_login' => false,
        ])->update();
        

        return $this->redirectToStage($user['stage'])->with('alert', 'Password updated successfully.');

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
