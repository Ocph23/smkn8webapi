<?php

namespace App\Http\Controllers;

use App\Models\Gambar;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class GalleryController extends Controller
{
    //
    public function create()
    {
        return view('gallery.create');
    }

    public function store(Request $request)
    {
        try {
            
            $request->validate([
                'title' => 'required|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,mp4,webm |max:20480',
            ]);

            $GambarFile = $request->file('image');
            $filename = time() . '.' . $GambarFile->getClientOriginalExtension();

            $path = $GambarFile->storeAs('galleries', $filename, 'public');

            Gambar::create([
                'title' => $request->title,
                'filename' => $filename
            ]);
            Alert::success('Berhasil upload gambar');
            return redirect(route('gallery.index'));
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    /**
     * Display a listing of the Gambars.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images  = Gambar::all();
        return view('gallery.index', compact('images'));
    }
}
