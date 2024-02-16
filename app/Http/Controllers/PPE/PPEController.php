<?php

namespace App\Http\Controllers\PPE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PPEController extends Controller
{
    public function index(Request $request) {

        $ppeClass = DB::table('acct_ppe_class')->get();
        $acctPPE = DB::table('acct_ppe')->orderBy('id', 'desc')->get();
        $state = DB::table('_states')->get();

        return view('PPE.acc_ppe', compact('ppeClass', 'acctPPE', 'state'));
    }
}
