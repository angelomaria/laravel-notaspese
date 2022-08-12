<?php

namespace App\Http\Controllers;

use App\Models\team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class TeamController extends Controller
{

    const HTTP_OK = Response::HTTP_OK;
    const HTTP_CREATED = Response::HTTP_CREATED;
    const HTTP_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;

    public function store_team(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $data = $request->all();

        $team = team::create($data);
        $HasTeamController = new HasTeamController();
        $hasTeam = "";
        if($data['user'])
            $hasTeam = $HasTeamController->store_has_team($team['id'], $data['user']);

        $response =  self::HTTP_CREATED;
        $results = [
            'team' => $team,
            'has_team' => $hasTeam
        ];
        return $this->get_http_response("success", $results, $response);
    }

    private function get_http_response(string $status = null, $data = null, $response)
    {
        return response()->json([
            'status' => $status,
            'data' => $data,
        ], $response);
    }
}
