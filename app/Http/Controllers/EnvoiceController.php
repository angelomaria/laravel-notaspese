<?php

namespace App\Http\Controllers;

use App\Models\envoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnvoiceController extends Controller
{
    public function store_envoice(Request $request) {
        $validator = Validator::make($request->all(), [
            'customer' => 'required',
            'amount' => 'required',
            'bollo' => 'required',
            'cassa' => 'required',
            'pay' => 'required',
            'team' => 'required',
            'envoice_created_at' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();

        envoice::create($data);

        $response = ['status' => 'OK', 'code' => 'SUCC004', 'message' => 'Fattura Memorizzata'];
        return response()->json($response, 200);
    }
}
