<?php

namespace App\Http\Controllers;

use App\Models\envoice;
use App\Models\team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class EnvoiceController extends Controller
{
    public function store_envoice(Request $request)
    {
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

    public function dashboardData(Request $request)
    {

        $teams_q = DB::table('has_team as ht')
            ->join('team as t', function ($join) {
                $join->on("ht.id_team", "=", "t.id");
            })
            ->select("t.id")
            ->where(['ht.id_user' => $request->user])
            ->get();

        $teams = [];
        foreach ($teams_q as $value) {
            array_push($teams, $value->id);
        }

        $fatturato = DB::table('envoice as e')
            ->join('team as t', function ($join) {
                $join->on("e.team", "=", "t.id");
            })
            ->selectRaw('sum(e.amount) as fatturato, sum(e.bollo) as bollo, sum(e.cassa) as cassa, t.name as team, YEAR(e.created_at) as anno')
            ->whereIn('e.team', $teams)
            ->where(['pay' => 1])
            ->orderBy('anno', 'DESC')
            ->groupBy(DB::raw('YEAR(e.created_at), e.team'))
            ->get();

        $spese = DB::table('spese as s')
            ->join('team as t', function ($join) {
                $join->on("s.team", "=", "t.id");
            })
            ->selectRaw('sum(s.amount) as spese, t.name as team, YEAR(s.created_at) as anno')
            ->whereIn('s.team', $teams)
            ->where(['pay' => 1])
            ->orderBy('anno', 'DESC')
            ->groupBy(DB::raw('YEAR(s.created_at), s.team'))
            ->get();

        $data = [
            'reddito' => $fatturato,
            'spese' => $spese,
        ];

        $response = ['data' => $data, 'status' => 'OK', 'code' => 'SUCC005', 'message' => 'Dashboard Data'];
        return response()->json($response, 200);
    }
}
