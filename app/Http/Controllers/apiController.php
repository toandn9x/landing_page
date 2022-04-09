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
    public function getAlls() {
        $menus = DB::table('menus')
            ->select('id', 'name', 'description')
            ->where('menus.status', 1)
            ->orderBy('menus.m_order', 'asc')
            ->get()->toArray();
        $contents = DB::table('contents')
            ->join('menus', 'menus.id', '=','contents.id_menu')
            ->select('contents.id', 'contents.description', 'contents.content', 'contents.img', 'menus.name as m_name', 'menus.id as m_id', 'menus.description as m_description')
            ->where('menus.status', 1)
            ->where('contents.status', 1)
            ->orderBy('menus.m_order', 'asc')
            ->get()->toArray();
        return response()->json(['menus' => $menus, 'contents' => $contents]);
        
    }
}
