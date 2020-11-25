<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    //
    public function Index()
    {
        return View('brand.index');
    }

}
