<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TreasuryController extends Controller
{
    public function index(){
        $data = User::where('user_type','Treasury')->get();

        // return $data;

        return Inertia::render('Admin/Treasury/Index',[
            'treasurers' => $data
        ]);
    }

    public function create(){
        return Inertia::render('Admin/Treasury/Create');
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

    public function edit(User $user){

        return Inertia::render('Admin/Treasury/Edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'status' => 'required',
            'user_type' => 'required',
        ]);

        User::find($request->id)->update($data);
    }
}
