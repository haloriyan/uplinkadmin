<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function delete($id) {
        $data = Customer::where('id', $id);
        $customer = $data->first();
        $deleteData = $data->delete();
    }
}
