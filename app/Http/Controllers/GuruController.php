<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Error;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class GuruController extends Controller
{
    public function index(): View
    {
        $data = Guru::all();
        return view('guru.index', ["gurus" => $data->sortBy('urutan')->sortBy('level_jabatan')]);
    }

    public function edit($id)
    {
        $data = Guru::find($id);
        $data->konten = html_entity_decode($data->konten);
        return view('guru.edit', ["model" => $data]);
    }

    public function create()
    {
        return view('guru.create');
    }

    public function post(Request $request)
    {

        try {

            $request->validate([
                'nama' => 'required|max:255',
                'jk' => 'required',
                'level_jabatan' => 'required',
                'urutan' => 'required',
            ]);


            $GambarFile = $request->file('image');
            $filename = null;
            if ($GambarFile) {
                $filename = time() . '.' . $GambarFile->getClientOriginalExtension();
                $path = $GambarFile->storeAs('guru', $filename, 'public');
            }

            Guru::create([
                'nama' => $request->nama,
                'jk' => $request->jk,
                'level_jabatan' => $request->level_jabatan,
                'jabatan' => $request->jabatan,
                'pelajaran' => $request->pelajaran,
                'urutan' => $request->urutan,
                'photo' => $filename
            ]);
            Alert::success('Berhasil buat konten');
            return redirect(route('guru.index'));
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function put(Request $request)
    {
        try {

            $request->validate([
                'nama' => 'required|max:255',
                'jk' => 'required',
                'level_jabatan' => 'required',
                'urutan' => 'required',
            ]);

            $GambarFile = $request->file('image');
            $filename = null;
            if ($GambarFile) {
                $filename = time() . '.' . $GambarFile->getClientOriginalExtension();
                $path = $GambarFile->storeAs('guru', $filename, 'public');
            }

            $data = Guru::find($request->id);
            if ($data) {
                $data->nama = $request->nama;
                $data->level_jabatan = $request->level_jabatan;
                $data->level_jabatan = $request->level_jabatan;
                $data->jabatan = $request->jabatan;
                $data->pelajaran = $request->pelajaran;
                $data->urutan = $request->urutan;
                if ($filename) {
                    $data->photo = $filename;
                }

                $data->save();
                Alert::success('Berhasil disimpan !');
                return redirect(route('guru.index'));
            } else {
                throw new Error('data tidak ditemukan');
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return back()->withErrors(['error' => $th->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            $data = Guru::find($id);
            if (!$data)
                throw new Error("Data tidak ditemukan");

            $data->delete();
            Alert::success('Berhasil Hapus Data !');
            return redirect(route('guru.index'));
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
        }
    }
}
