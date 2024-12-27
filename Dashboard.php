<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');  // Redirect to login page
        }

        $user_id = session()->get('id');
        $email = session()->get('email');
        $name = session()->get('student_name');
        return view('dashboard',['user_id'=>$user_id,'email'=>$email,'student_name'=>$name]);
    }
    public function logout()
{
    // Destroy the session
    session()->destroy();

    // Redirect to the login page
    return redirect()->to('/login');
}

}
