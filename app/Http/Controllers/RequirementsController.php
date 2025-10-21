<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RequirementsController extends Controller
{
    public function index(){
        $requirements = Requirement::all();


        return Inertia::render('Admin/Requirement/Index',[
            'requirements' => $requirements
        ]);    
    }

    public function create(){
        return Inertia::render('Admin/Requirement/Create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'requirement_name' => 'required',
            'description' => 'required',
            'file_type_allowed' => 'required'
        ]);

        Requirement::create($data);
    }

    public function edit(Requirement $requirement){

        return Inertia::render('Admin/Requirement/Edit',[
            'requirement' => $requirement
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'requirement_name' => 'required',
            'description' => 'required',
            'file_type_allowed' => 'required'
        ]);

        Requirement::find($request->id)->update($data);
    }
}
