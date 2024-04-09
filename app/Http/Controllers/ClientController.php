<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Guru;
use App\Services\MainContenService;
use App\Services\MenuService;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MenuService $menuService)
    {
        $data = new stdClass();
        $data->menu = $menuService->getTreeMenu();
        $data->blogs = Blog::all()->sortByDesc('id');
        return json_encode($data);
    }

    public function menus(MenuService $menuService)
    {
        $data = $menuService->getTreeMenu();
        return json_encode($data);
    }

    public function getBlog($id)
    {
        $data = Blog::find($id);
        if($data->konten){
            $data->konten = html_entity_decode($data->konten);
        }
        $data->author;
        return $data->toJson();
    }

    public function getBlogs()
    {
        $data = Blog::where("publish","=", true)->orderBy('id', 'desc')->get();
        foreach ($data as $key => $value) {
            $value->konten = html_entity_decode($value->konten);
            $value->author;
        }
        return $data->toJson();
    }

    public function getCarousels()
    {
        $blogs = DB::table('blogs')
            ->where("oncarousel","=", true)
            ->select('judul', 'gambar')
            ->limit(5)
            ->get();
        return $blogs->toJson();
    }


    function getGuru($id)
    {
        $data = Guru::find($id);
        return $data->toJson();
    }

    function getGurus()
    {
        $data = Guru::all();
        $data->sortBy('urutan')->sortBy('level_jabatan');
        return $data->toJson();
    }

    public function changepubish($id)
    {
        $data = Blog::find($id);
        if ($data) {
            $data->publish = !$data->publish;
        }
        $data->save();
        Alert::success('berhasil ubah data');
    }

    function getMainContent($id, MainContenService $mainContentService)
    {
        $data = $mainContentService->getById($id);

        return json_encode($data);
    }
}
