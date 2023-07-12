<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Models\User;

class MainController extends Controller
{
    public function home()
    {
        return view('index');
    }
}
