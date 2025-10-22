<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\Stall;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StallController extends Controller
{
    public function create(Establishment $establishment){

        return Inertia::render('Admin/Stall/Create',[
            'establishment' => $establishment
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'establishment_id' => 'required',
            'stall_number' => 'required',
            'price' => 'required',
            'status' => 'required',
            'description' => 'required',
            'size' => 'required',
            'images.*'     => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $stall = Stall::create($data);


        // Save uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('stalls', 'public');
                $stall->images()->create(['file_path' => $path]);
            }
        }
    }

    public function edit(Stall $stall){

        return Inertia::render('Admin/Stall/Edit',[
            'stall' => $stall
        ]);
    }

    public function update(Request $request){
        $data = $request->validate([
            'stall_number' => 'required',
            'price' => 'required',
            'status' => 'required',
            'description' => 'required',
            'size' => 'required',
        ]);

        Stall::find($request->id)->update($data);
    }

    public function view(Stall $stall){

        return Inertia::render('Admin/Stall/View',[
            'stall' => $stall,
            'images' => $stall->images
        ]);
    }
}
