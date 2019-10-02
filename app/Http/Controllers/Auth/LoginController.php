<?php
namespace App\Http\Controllers;

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginController extends Controller
{

    public function showLoginForm()
    {

        return view('home');

    }

}
