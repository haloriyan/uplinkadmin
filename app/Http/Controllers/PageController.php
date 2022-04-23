<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public static function get($filter = NULL) {
        if ($filter == NULL) {
            return new Page;
        }
        return Page::where($filter);
    }
    public function add() {
        $myData = AdminController::me();
        $message = Session::get('message');

        return view('page.add', [
            'myData' => $myData,
            'message' => $message,
        ]);
    }
    public function edit($id) {
        $myData = AdminController::me();
        $page = Page::where('id', $id)->first();
        
        return view('page.edit', [
            'myData' => $myData,
            'page' => $page,
        ]);
    }
}
