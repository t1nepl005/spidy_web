<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class HomeController extends Controller
{
    public function index() {
        $members = Member::all();
        // how to update in model
        
        return view('welcome', ['members' => $members]);
    }
}
