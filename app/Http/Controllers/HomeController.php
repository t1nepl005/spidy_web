<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    $members = \App\Models\Member::all();
    return view('welcome', compact('members'));
    }

    public function member($id) {
        switch ($id) {
            case 1:
                return view('members.david');
                break;
            case 2:
                return view('members.christine');
                break;
            default:
                return redirect()->route('/');
        }
    }

}
