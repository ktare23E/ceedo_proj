<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstablishmentImages;
use Illuminate\Support\Facades\Storage;


class EstablishmentImagesController extends Controller
{
    public function update(Request $request, EstablishmentImages $image)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // 2MB limit
        ]);

        // Delete the old image if exists
        if ($image->file_path && Storage::exists('public/' . $image->file_path)) {
            Storage::delete('public/' . $image->file_path);
        }

        // Store new image
        $newPath = $request->file('file')->store('establishments', 'public');

        // Update database record
        $image->update([
            'file_path' => $newPath,
        ]);

        return back()->with('success', 'Image updated successfully!');
    }
}
