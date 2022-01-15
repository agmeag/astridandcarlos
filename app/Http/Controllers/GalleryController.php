<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function gallery()
    {
        return view('wedding.gallery');
    }

    public function getFileList()
    {
        $files = [];
        $filesInFolder = File::files('images');

        foreach ($filesInFolder as $path) {
            $manuals[] = pathinfo($path);
        }
        return $files;
    }

    public function getPhotoList()
    {
        $photos = Photo::where('deleted', 0)->get();
        return $photos;
    }
}
