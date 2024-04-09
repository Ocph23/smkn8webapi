<?php

namespace App\Http\Controllers;

use App\Models\MainContent;
use App\Models\MenuContent;
use App\Services\MenuService;
use Error;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use PDOException;
use RealRashid\SweetAlert\Facades\Alert;

class MenuContentController extends Controller
{
    //
    private $fieldValidate = [
        "menu" => "required",
        "level" => "required",
        "parent_id" => "required",
    ];

    public function create($req)
    {
        $data = MenuContent::find($req);
        if ($data && $data->parent_id)
            $data->parent;
        return view("MenuContents/create", ["parent" => $data]);
    }


    public function edit($req)
    {
        $data = MenuContent::find($req);
        if ($data->parent_id)
            $data->parent;
        return view("MenuContents/edit", ["data" => $data]);
    }

    public function index(MenuService $menuService)
    {
        $data = $menuService->getTreeMenu();
        $title = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('MenuContents/menu', compact("data"));
    }

    public function post(Request $req)
    {
        try {
            $data = $req->validate($this->fieldValidate);
            $menu = new MenuContent($data);
            $menu->hasContent = false;
            $menu->save();
            return redirect('/admin/menu');
        } catch (PDOException $ex) {
            return response()->json(DatabaseHelper::GetErrorPDOError($ex), 400);
        } catch (\Throwable $th) {
            $errorMessage["message"] = $th->getMessage();
            return response()->json($errorMessage, 400);
        }
    }


    public function put(Request $req)
    {
        try {
            $req->validate($this->fieldValidate);
            $content = MenuContent::find($req->id);
            if (!$content) {
                throw new Error("Data Tidak Ditemukan !");
            }
            $content->fill($req->all());
            $content->save();
            Alert::success("Berhasil Ubah Data");
            return redirect('/admin/menu');
        } catch (PDOException $ex) {
            return response()->json(DatabaseHelper::GetErrorPDOError($ex), 400);
        } catch (\Throwable $th) {
            $errorMessage["message"] = $th->getMessage();
            return response()->json($errorMessage, 400);
        }
    }


    public function delete($id)
    {
        try {
            $content = MenuContent::find($id);

            if (!$content) {
                throw new Error("Data Tidak Ditemukan !");
            }

            $parent_id = $content->id;
            $menus = MenuContent::where("parent_id", $parent_id)->get();
            foreach ($menus as $key => $value) {
                $menux = MenuContent::where("parent_id", $value->id)->get();
                foreach ($menux as $key => $item) {
                    if ($item->hasContent) {
                        $this->deleteContent($item->id);
                    }
                    $item->delete();
                }
                if ($value->hasContent) {
                    $this->deleteContent($value->id);
                }
                $value->delete();
            }
            if ($content->hasContent) {
                $this->deleteContent($content->id);
            }
            $content->delete();
            alert()->success("Data Berhasil dihapus");
            return redirect('/admin/menu');
        } catch (PDOException $ex) {
            return response()->json(DatabaseHelper::GetErrorPDOError($ex), 400);
        } catch (\Throwable $th) {
            $errorMessage["message"] = $th->getMessage();
            return response()->json($errorMessage, 400);
        }
    }


    private function deleteContent($id)
    {
        $contentx = MainContent::find($id);
        if ($contentx)
            $contentx->delete();
    }
}
