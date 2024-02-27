<?php

namespace App\Http\Controllers\FinalAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialPositionController extends Controller
{
    public function index(Request $request) {
        $asset = DB::table('acct_assests')
        ->selectRaw('acct_assests.assest_name, acct_assest_types.assest_type, acct_assests.opening_value')
        // ->groupBy('assest_type_id')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->get();

        $liability = DB::table('liabilities')
        ->selectRaw('liabilities.liability, liabilities.type_of_liability, liabilities.amount')
        ->get();

        $revenue = DB::table('acc_revenue')
        ->selectRaw('acc_revenue.received_from , acc_revenue.revenue_line, acc_revenue.revenue_amount')
        ->get();

        // dd($asset, $liability, $revenue);
        return view('GeneralLedger.statement_of_financial_position', compact('asset', 'liability', 'revenue'));
    }

}
