<?php

namespace App\Controllers;

class ForgotPass extends BaseController
{
    public function index(): string
    {
        return view('forgotpass');
    }
}
