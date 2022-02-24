<?php

namespace App\Http\Controllers;

use App\Models\VisitorOrder;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function detail($id) {
        $myData = AdminController::me();
        $sale = VisitorOrder::where('id', $id)->with(['details.digital_product_item','user','visitor'])
        ->first();

        return view('sales.Detail', [
            'myData' => $myData,
            'sale' => $sale
        ]);
    }
}
