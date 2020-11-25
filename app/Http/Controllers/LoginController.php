<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function Index()
    {
        return View('login.index');
    }

    public function Login(Request $data)
    {
        $name = $data->username;
        $password = $data->password;

        if(Auth::attempt($data->only('username','password')))
        {
            return redirect('/');
        }

        return redirect('/login');
        
    }

    public function Logout()
    {
        session()->forget('locale');
        Auth::logout();
        return redirect('/login');
    }
}
