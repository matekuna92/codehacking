<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;

class AdminMediasController extends Controller
{
    //

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
        $file = $request->file('file'); // ez a default neve a "$_FILES" változóban tárolt képinfo-nak dropzone-nál
        $name = time() . $file->getClientOriginalName();
        $file->move('images',$name);
        Photo::create(['file'=>$name]);
        // ha behúzom a területre weboldalon a képet, mostmár a public/images-ben is tárolódik egyből !!
    }
}
