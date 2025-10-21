<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EstablishmentController extends Controller
{
    public function index(){
        $establishments = Establishment::all();

        return Inertia::render('Admin/Establishments/Index',[
            'establishments' => $establishments
        ]);
    }

    public function create(){
        return Inertia::render('Admin/Establishments/Create');
    }

    public function store(Request $request){

        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
            'images.*'     => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $establishment = Establishment::create($data);


        // Save uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('establishments', 'public');
                $establishment->images()->create(['file_path' => $path]);
            }
        }

        return redirect()->route('establishments')->with('success', 'Establishments created successfully!');
    }

    public function edit(Establishment $establishment){

        return Inertia::render('Admin/Establishments/Edit',[
            'establishment' => $establishment
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'address' => 'required',
        ]);

        Establishment::find($request->id)->update($data);
    }

    public function view(Establishment $establishment){

        return Inertia::render('Admin/Establishments/View',[
            'establishment' => $establishment,
            'images' => $establishment->images
        ]);
    }
}
