<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        return true;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' . now()->timestamp;
            $file->storeAs('public/uploads/tmp/' . $folder, $filename);

            if (TemporaryFile::where('field', 'thumbnail')->count()) {
                TemporaryFile::where('field', 'thumbnail')->delete();
            }
            TemporaryFile::create([
                'field' => 'thumbnail',
                'folder' => $folder,
                'filename' => $filename,
            ]);

            return $folder;
        }

        if ($request->images) {
            foreach ($request->images as $file) {
                $folder = uniqid() . '-' . now()->timestamp;
                $filename = $file->getClientOriginalName();
                $file->storeAs('public/uploads/tmp/' . $folder, $filename);

                TemporaryFile::create([
                    'field' => 'images',
                    'folder' => $folder,
                    'filename' => $filename,
                ]);
            }
            return true;
        }

        return abort('404');
    }
}