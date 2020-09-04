<?php

namespace App\Http\Controllers\Superadmin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    
    public function index(){

        return view('superadmin.admin.index');
    }

}
