<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StallImages;
use Illuminate\Support\Facades\Storage;

class StallImagesController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|image|max:2048', // 2MB max
        ]);

        $image = StallImages::findOrFail($id);

        // Delete old file if exists
        if ($image->file_path && Storage::disk('public')->exists($image->file_path)) {
            Storage::disk('public')->delete($image->file_path);
        }

        // Store new file
        $path = $request->file('file')->store('stalls', 'public');

        // Update DB
        $image->update([
            'file_path' => $path,
        ]);

        return back()->with('success', 'Stall image updated successfully.');
    }
}
