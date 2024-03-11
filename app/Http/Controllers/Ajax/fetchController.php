<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Location\Lga;
use App\Models\Location\State;
use App\Models\Revenue\RevenueLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function economicLines(Request $request) {
        $type = $request->query('type');
        $state = DB::table('revenue_line')
        ->whereIn('type', [$type])
        ->get();
        return response()->json([
            "status" => true,
            "data" => $state
        ]);
    }
}
