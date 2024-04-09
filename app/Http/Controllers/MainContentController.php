<?php

namespace App\Http\Controllers;

use App\Models\MainContent;
use App\Models\MenuContent;
use Illuminate\Http\Request;

class MainContentController extends Controller
{
    //

    public function create($req)
    {
        $data = MainContent::find($req);
        if (!$data) {
            $data = new MainContent();
            $data->id = $req;
        }
        $data->content = html_entity_decode($data->content);
        return view("MainContents/create", ["data" => $data]);
    }

    public function post(Request $req)
    {
        try {
            $datax = $req->all();
            $data = MainContent::find($datax["id"]);
            if ($data) {
                $data->judul = $datax["judul"];
            } else {
                $data = new MainContent($datax);
            }
            $data->content = htmlentities($datax["content"]);
            $data->save();
            $data->content = html_entity_decode($data->content);

          
            $menu = MenuContent::find($data->id);
            if ($menu) {
                $menu->hasContent = true;
                $menu->save();
            }


            return view("MainContents/create", ["data" => $data]);
        } catch (\Throwable $th) {
           return back()->withErrors(['error'=> $th->getMessage()]);
        }
    }
}
