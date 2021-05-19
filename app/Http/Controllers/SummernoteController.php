<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SummernoteController extends Controller
{
    public function imageUpload(Request $request) {
        $images = [];

        $request->validate([
            'images' => 'required',
        ]);

        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach($images as $image) {
                $name = Str::uuid() . '-' . preg_replace('/[^a-zA-Z0-9-_.]/', '', $image->getClientOriginalName());
                $path = $image->storeAs('uploads/blog/images', $name, 'public'); // thay doi thu muc uploads
                $images[] = Storage::url($path);
            }
        }

        return $images;
    }
}
