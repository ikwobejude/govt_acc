<?php

namespace App\Http\Controllers\FinalAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialPositionController extends Controller
{
    public function index(Request $request) {
        $asset = DB::table('acct_assests')
        ->where('approved', 2)
        ->selectRaw('acct_assests.assest_name, acct_assests.asset_rev, acct_assest_types.assest_type, SUM(acct_assests.opening_value) as opening_value')
        ->groupBy('assest_type_id')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->get();

        // dd($asset);

        $liability = DB::table('liabilities')
        ->where('approved', 2)
        ->selectRaw('liabilities.liability, liabilities.economic_code, liabilities.type_of_liability, SUM(liabilities.amount) as amount')
        ->groupBy('liabilities.type_of_liability')
        ->get();

        // dd($liability);

        $revenue = DB::table('acc_revenue')
        ->where('approved', 2)
        ->selectRaw('acc_revenue.received_from, acc_revenue.revenue_line, SUM(acc_revenue.revenue_amount) as revenue_amount')
        ->get();

        // dd($asset, $liability, $revenue);
        return view('GeneralLedger.statement_of_financial_position', compact('asset', 'liability', 'revenue'));
    }

}
