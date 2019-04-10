<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use Illuminate\Support\Facades\Session;

class AdminMediasController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }
    public function create()
    {
        
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $name = Photo::addImage($request->file('file'));
        Photo::create(['file' => $name]);

        return redirect('admin/media');
    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        unlink(public_path() . $photo->file);
        $photo->delete();
        
        Session::flash('photo_deleted', 'Photo deleted Successfully');
        return redirect('admin/media');
    }

}
