<?php

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;

class LoginSSO extends Controller
{
    public function index()
    {

        return view('page.sso.acs');

    }

    public function logout()
    {

        return view('page.sso.sls');

    }


}
