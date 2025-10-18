<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
        $users = User::all();

        return Inertia::render('Admin/Users/Index',[
            'users' => $users
        ]);
    }

    public function create(){
        return Inertia::render('Admin/Users/Create');
    }
}
