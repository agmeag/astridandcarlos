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

    public function adminGallery()
    {
        return view('wedding.admin.gallery');
    }

    public function deleteFile(Request $request)
    {
        $query = $request->id;
        $photos = Photo::where('idphoto', $query)->first();
        if ($photos) {
            $photos->deleted = 1;
            $photos->update();
        }
        return true;
    }



    public function restoreFile(Request $request)
    {
        $query = $request->id;
        $photos = Photo::where('idphoto', $query)->first();
        if ($photos) {
            $photos->deleted = 0;
            $photos->update();
        }
        return true;
    }

    public function getAdminList()
    {
        $photos = Photo::get();
        return $photos;
    }

    public function deleteForever()
    {
    }

    public function saveImage(Request $request)
    {
        $image = $request->image_file;
        $filesInFolder = File::files('photos');
        $filename = (count($filesInFolder) + 1) . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('photos'), $filename);
        $path = "/photos" . "/" . $filename;
        $query = new Photo();
        $query->url = $path;
        $query->save();
        return Photo::where('idphoto', $query->idphoto)->first();
    }
}
