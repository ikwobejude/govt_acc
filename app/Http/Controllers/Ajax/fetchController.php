<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Location\Lga;
use App\Models\Location\State;
use Illuminate\Http\Request;

class fetchController extends Controller
{
    public function localGovernmentArea(Request $request, $id) {
        $localGovt = Lga::where('state_id', $id)->get();
        return response()->json([
            "status" => "success",
            "data" => $localGovt
        ]);
    }

    public function state(Request $request) {
        $state = State::all();
        return response()->json([
            "status" => "success",
            "data" => $state
        ]);
    }
}
