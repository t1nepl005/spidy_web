<?php

namespace App\Http\Controllers\Activities;

use App\Http\Controllers\Controller;
use App\Models\act1user;
use Illuminate\Http\Request;

class Activity1Controller extends Controller
{
    //
    public function index() {
        $users = act1user::all();
        return view('activities.activity1', compact('users'));
    }
}
