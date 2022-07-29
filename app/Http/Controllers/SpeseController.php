<?php

namespace App\Http\Controllers;

use App\Models\Spese;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpeseController extends Controller
{
    public function register_expenses(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:200',
            'account' => 'required',
            'amount' => 'required|max:200',
            'pay' => 'required',
            'created_by' => 'required',
            'updated_by' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();

        if ($this->_check_login($request)) {
            Spese::create($data);
            $response = ['expenses_list' => $this->_get_all_expenses(), 'status' => 'OK', 'code' => 'SUCC002', 'message' => 'Nota Spesa Inserita'];
            return response()->json($response, 200);
        } else {
            $response = ['status' => 'KO', 'code' => 'ERR003', 'message' => 'Utente non loggato!'];
            return response()->json($response, 200);
        }
    }

    public function get_expenses_by_me(Request $request)
    {
        $data = $request->all();

        if ($this->_check_login($request)) {
            $expenses = Spese::where('account', $data['user'])->get();
            $response = ['expenses_list' => $expenses, 'status' => 'OK', 'code' => 'SUCC003', 'message' => 'La tua lista spese'];
            return response()->json($response, 200);
        } else {
            $response = ['status' => 'KO', 'code' => 'ERR003', 'message' => 'Utente non loggato!'];
            return response()->json($response, 200);
        }
    }

    public function get_all_expenses_with_login(Request $request)
    {
        if ($this->_check_login($request)) {
            $expenses = $this->_get_all_expenses();
            $response = ['expenses_list' => $expenses, 'status' => 'OK', 'code' => 'SUCC003', 'message' => 'La lista completa delle spese'];
            return response()->json($response, 200);
        } else {
            $response = ['status' => 'KO', 'code' => 'ERR003', 'message' => 'Utente non loggato!'];
            return response()->json($response, 200);
        }
    }

    private function _check_login(Request $request)
    {
        $data = $request->all();

        if ($data) {
            $existing_user = User::where('id', $data['user'])->first();
            if ($existing_user)
                return true;
            else
                return false;
        } else return false;
    }

    private function _get_all_expenses()
    {
        return Spese::get();
    }
}
