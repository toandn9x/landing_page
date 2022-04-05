<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Menus;
use App\Models\Contents;
use App\Models\News;

class apiController extends Controller
{
    //
    public function getContents() {
        $contents = DB::table('contents')
            ->join('menus', 'menus.id', '=','contents.id_menu')
            ->select('contents.*', 'menus.name')
            ->where('contents.status', 1)
            ->get();
        return response()->json(['contents' => $contents]);
    }
    public function getMenus() {
        $menus = DB::table('menus')
            ->where('status', 1)
            ->get();
        return response()->json(['menus' => $menus]);
    }
    public function getContentsByid($id) {
        $content = DB::table('contents')
            ->where('id_menu', $id)
            ->get();
        return response()->json(['content' => $content]);
    }
}
