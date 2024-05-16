<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Error;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class BlogController extends Controller
{
    public function index(): View
    {
        $data = Blog::all();
        return view('blog.index', ["blogs" => $data->sortByDesc('id')]);
    }

    public function edit($id)
    {
        $data = Blog::find($id);
        $data->konten = html_entity_decode($data->konten);
        return view('blog.edit', ["model" => $data]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function post(Request $request)
    {

        try {

            $request->validate([
                'judul' => 'required|max:255',
                'ringkasan' => 'required',
                'konten' => 'required',
                'kategori' => 'required|max:255',
            ]);

            Blog::create([
                'judul' => $request->judul,
                'ringkasan' => $request->ringkasan,
                'konten' => htmlentities($request->konten),
                'gambar' => $request->gambar,
                'user_id' => Auth::id(),
                'publish' => $request->publish?1:0,
                'oncarousel' => $request->oncarousel?1:0,
                'kategori' => $request->kategori
            ]);
            Alert::success('Berhasil buat konten');
            return redirect(route('blog.index'));
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function put(Request $request)
    {
        try {

            $request->validate([
                'judul' => 'required|max:255',
                'ringkasan' => 'required',
                'konten' => 'required',
                'kategori' => 'required|max:255',
            ]);

            $data = Blog::find($request->id);
            if ($data) {
                $data->judul = $request->judul;
                $data->ringkasan = $request->ringkasan;
                $data->konten = $request->konten;
                $data->gambar = $request->gambar;
                $data->publish = $request->publish?1:0;
                $data->oncarousel = $request->oncarousel?1:0;
                $data->user_id = Auth::id();
                $data->kategori = $request->kategori;
                $data->save();    
                Alert::success('Berhasil disimpan !');
                return redirect(route('blog.index'));
            }else{
                throw new Error('data tidak ditemukan');
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete()
    {
    }
}
