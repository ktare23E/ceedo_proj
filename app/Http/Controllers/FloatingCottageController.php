<?php

namespace App\Http\Controllers;

use App\Models\FloatingCottage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FloatingCottageController extends Controller
{
    public function index(){
        $cottages = FloatingCottage::all();

        return Inertia::render('Admin/Cottages/Index',[
            'cottages' => $cottages
        ]);
    }

    public function create(){

        return Inertia::render('Admin/Cottages/Create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_hour' => 'required|numeric',
            'capacity' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload
        $path = $request->file('image')->store('floating_cottages', 'public');

        FloatingCottage::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_hour' => $request->price_per_hour,
            'capacity' => $request->capacity,
            'status' => 'available',
            'image' => $path,
        ]);

        // return redirect()->route('floating_cottages.index')
        //     ->with('success', 'Floating cottage created successfully!');
    }

    public function edit(FloatingCottage $cottage){

        return Inertia::render('Admin/Cottages/Edit',[
            'cottage' => $cottage
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_hour' => 'required|numeric',
            'capacity' => 'required|integer',
        ]);

        FloatingCottage::find($request->id)->update($data);
    }
}
