<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RequirementsController extends Controller
{
    public function index(){
        return Inertia::render('Admin/Requirement/Index');    
    }
}
