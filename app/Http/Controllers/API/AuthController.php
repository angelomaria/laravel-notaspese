<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller
{

    const HTTP_OK = Response::HTTP_OK;
    const HTTP_CREATED = Response::HTTP_CREATED;
    const HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('authToken')->accessToken;
                $response = ['access_token' => $token, 'user' => $user, 'status' => 'OK', 'code' => 'SUCC001', 'message' => 'Credenziali Corrette'];
                return response()->json($response, 200);
            } else {
                $response = ['status' => 'KO', 'code' => 'ERR001', 'message' => 'Password Errata'];
                return response()->json($response, 200);
            }
        } else {
            $response = ['status' => 'KO', 'code' => 'ERR002', 'message' => 'Utente non esistente'];
            return response()->json($response, 200);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'vat' => 'required',
            'coeff_redditivita' => 'required',
            'perc_contributi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $success['token'] = $this->get_user_token($user, "AuthToken");
        $success['name'] =  $user->name;
        $response =  self::HTTP_CREATED;
        return $this->get_http_response("success", $success, $response);
    }

    public function get_http_response(string $status = null, $data = null, $response)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
        ], $response);
    }

    public function get_user_token($user, string $token_name = null)
    {
        return $user->createToken($token_name)->accessToken;
    }
}
