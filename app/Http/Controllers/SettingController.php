<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function setEnv($datas) {
        $path = base_path('.env');

        if (file_exists($path)) {
            foreach ($datas as $key => $value) {
                $oldKey = env($key);

                // Checking if contain space
                $s = explode(" ", $value);
                if (isset($s[1])) {
                    $value = "\"$value\"";
                }
                if (isset(explode(" ", $oldKey)[1])) {
                    $oldKey = "\"$oldKey\"";
                }
                
                $patt = "$key=$oldKey";
                $repl = "$key=$value";
                file_put_contents($path, str_replace($patt, $repl, file_get_contents($path)));
            }
        }
    }
    public function category() {
        $myData = AdminController::me();
        $categories = explode(",", env('CATEGORIES'));

        return view('settings.category', [
            'myData' => $myData,
            'categories' => $categories
        ]);
    }
    public function saveCategory(Request $request) {
        $sett = $this->setEnv([
            'CATEGORIES' => implode(",", $request->categories)
        ]);
        return response()->json($sett);
    }
    public function email() {
        $myData = AdminController::me();
        
        return view('settings.email', ['myData' => $myData]);
    }
}
