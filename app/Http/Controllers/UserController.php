<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
        $users = User::whereNot('user_type','Admin')->get();

        return Inertia::render('Admin/Users/Index',[
            'users' => $users
        ]);
    }

    public function create(){
        return Inertia::render('Admin/Users/Create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'password' => 'required',
            'status' => 'required',
            'user_type' => 'required',
        ]);

        User::create($data);
    }
}
