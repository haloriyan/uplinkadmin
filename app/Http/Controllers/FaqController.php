<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function get($filter = NULL) {
        if ($filter == NULL) {
            return new Faq;
        }
        return Faq::where($filter);
    }
    public function store(Request $request) {
        $saveData = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return redirect()->route('settings.faq')->with(['message' => "New item has been added"]);
    }
    public function delete($id) {
        $data = Faq::where('id', $id);
        $deleteData = $data->delete();
        return redirect()->route('settings.faq')->with(['message' => "FAQ item has been deleted"]);
    }
    public function update(Request $request) {
        $data = Faq::where('id', $request->id);
        $updateData = $data->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        return redirect()->route('settings.faq')->with(['message' => "FAQ item has been updated"]);
    }
    public function api() {
        $faqs = Faq::orderBy('updated_at', 'DESC')->get();
        return response()->json($faqs);
    }
}
