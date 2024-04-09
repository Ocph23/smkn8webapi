<?php

namespace App\Services;

use App\Models\MenuContent;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getTreeMenu(): Collection
    {
        $menus = MenuContent::where("level", 0)->get();

        foreach ($menus as $key => $value) {
            # code...
            $data = MenuContent::where("level", 1)->where('parent_id', $value->id)->get();
            $value->childs = $data;
            if ($data) {
                foreach ($data as $key => $item) {
                    $data1 = MenuContent::where("level", 2)->where("parent_id", $item->id)->get();
                    $item->childs = $data1;
                }
            }
        }
        return $menus;
    }
}
