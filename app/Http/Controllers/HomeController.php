<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role  = Auth::user()->role;

        dd($role);

        if ($role == 'admin') {
            return redirect()->route('admin');
        } elseif ($role == 'user') {
            return redirect()->route('user');
        } else {
            return redirect()->route('login');
        }
    }
}
