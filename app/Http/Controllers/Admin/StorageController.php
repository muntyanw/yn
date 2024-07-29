<?php
// app/Http/Controllers/StorageController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function index()
    {
        $directories = Storage::directories('public');
        $files = [];

        foreach ($directories as $directory) {
            $files[$directory] = Storage::files($directory);
        }

        return view('admin.storage.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!Storage::exists('public/common')) {
            Storage::makeDirectory('public/common');
        }

        $path = $request->file('image')->store('public/common');

        return response()->json(['success' => true, 'path' => Storage::url($path)]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        $path = str_replace('/storage/', 'public/', $request->path);

        if (Storage::exists($path)) {
            Storage::delete($path);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => __('File not found')]);
    }
}
