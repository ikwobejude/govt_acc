<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NCOAController extends Controller
{
    public function NCOAEconomicalCode(Request $request) {
        $revenue_code = $request->query("revenue_code");
        $note = $request->query("note");
        $revenue_lines = DB::table('revenue_line')
        // ->where("type", 1)
        ->when(!empty($revenue_code), function ($query) use ($revenue_code) {
            return $query->where('economic_code', '=', $revenue_code);
        })
        ->when(!empty($note), function ($query) use ($note) {
            return $query->where('note', '=', $note);
        })
        ->paginate(20);
        $revenue = DB::table('revenue_line')->get();
        $notes = DB::table("notes")->get();
        // dd(count($revenue));
        // dd($revenue_lines,  auth()->user()->name);
        return view('Settings.economical_code', compact('revenue_lines', 'revenue', 'notes'));
    }
}
