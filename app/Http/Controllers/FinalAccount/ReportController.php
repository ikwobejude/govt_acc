<?php

namespace App\Http\Controllers\FinalAccount;

use App\Models\Asset\Assets;
use Illuminate\Http\Request;
use App\Models\Revenue\Revenue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureRegister;

class ReportController extends Controller
{
    public function financialPerformance(Request $request) {
        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, revenue_amount as total")
        ->groupBy('revenue_code')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, amount as total")
        // ->groupBy('expenditure_code')
        ->get();

        // $asset = DB::table('acct_assests')
        // ->where('approved', 2)
        // ->selectRaw('acct_assests.assest_name AS line, acct_assests.asset_rev AS code, acct_assests.asset_rev_type, acct_assest_types.assest_type, acct_assests.opening_value as total')
        // ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        // ->get();


        // $liability = DB::table('liabilities')
        // ->where('approved', 2)
        // ->selectRaw('liabilities.liability, liabilities.economic_code, liabilities.type_of_liability, liabilities.amount')
        // ->get();





        // dd($arr,  $revenue);
        return view('GeneralLedger.financial_performace', compact('revenue', 'ExpenditureRegister'));
    }

    public function cashFlow(Request $request) {
        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, revenue_amount as total")
        ->groupBy('revenue_code')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, amount as total")
        // ->groupBy('expenditure_code')
        ->get();

        $asset = DB::table('acct_assests')
        ->where('approved', 2)
        ->selectRaw('acct_assests.assest_name AS line, acct_assests.asset_rev AS code, acct_assests.asset_rev_type, acct_assest_types.assest_type, acct_assests.opening_value as total')
        // ->groupBy('assest_type_id')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->get();

        // dd($asset);

        $liability = DB::table('liabilities')
        ->where('approved', 2)
        ->selectRaw('liabilities.liability, liabilities.economic_code, liabilities.type_of_liability, liabilities.amount')
        // ->groupBy('liabilities.type_of_liability')
        ->get();





        // dd($arr,  $revenue);
        return view('GeneralLedger.cash_flow', compact('revenue', 'ExpenditureRegister', 'asset', 'liability'));
    }
}
