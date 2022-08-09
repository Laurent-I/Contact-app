<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
//        Settings controller with password confirmation
        $this->middleware(['auth', 'password.confirm']);
    }
    public function index()
    {
        return "<h1>Account Settings</h1>";
    }
}
