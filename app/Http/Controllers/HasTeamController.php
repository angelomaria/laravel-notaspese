<?php

namespace App\Http\Controllers;

use App\Models\has_team;

class HasTeamController extends Controller
{
    public function store_has_team($idTeam, $idUser) {

        return has_team::create([
            'id_team' => $idTeam,
            'id_user' => $idUser
        ]);

    }
}
