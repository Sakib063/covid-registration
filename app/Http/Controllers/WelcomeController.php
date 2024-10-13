<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    public function index(Request $request){
        if ($request->ajax()) {
            return (new User())->find_user($request);
        }
//        $search=(new User())->find_user($request);
        return view('welcome');
    }
}
