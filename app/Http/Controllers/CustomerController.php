<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store_customer(Request $request) {
        $validator = Validator::make($request->all(), [
            'denominazione' => 'required|max:300',
            'paese' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();

        customer::create($data);

        $response = ['status' => 'OK', 'code' => 'SUCC003', 'message' => 'Cliente Inserito'];
        return response()->json($response, 200);
    }
}
