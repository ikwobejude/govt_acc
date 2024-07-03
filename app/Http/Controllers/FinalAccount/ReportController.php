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
        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, revenue_amount as total")
        ->groupBy('revenue_code')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, amount as total")
        // ->groupBy('expenditure_code')
        ->get();


        return view('GeneralLedger.financial_performace', compact('revenue', 'ExpenditureRegister', 'currentT', 'from', 'to'));
    }

    public function downloadFinancialPerformance(Request $request) {
        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, revenue_amount as total")
        ->groupBy('revenue_code')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, amount as total")
        // ->groupBy('expenditure_code')
        ->get();


        return view('GeneralLedger.download_financial_performace', compact('revenue', 'ExpenditureRegister', 'currentT', 'from', 'to'));
    }

    public function cashFlow(Request $request) {

        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $revenue = Revenue::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("revenue_line as line, revenue_code as code, asset_name as uniId, revenue_amount as total")
        ->groupBy('revenue_code')
        ->get();

        $ExpenditureRegister = ExpenditureRegister::Where('service_id',37483)
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw("expenditure_type as uniId, expenditure_code as code, expenditure_name  as line, amount as total")
        // ->groupBy('expenditure_code')
        ->get();

        $asset = DB::table('acct_assests')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->selectRaw('acct_assests.assest_name AS line, acct_assests.asset_rev AS code, acct_assests.asset_rev_type, acct_assest_types.assest_type, acct_assests.opening_value as total')
        // ->groupBy('assest_type_id')
        ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
        ->get();

        // dd($asset);

        $liability = DB::table('liabilities')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw('liabilities.liability AS line, liabilities.economic_code AS code, liabilities.type_of_liability, liabilities.amount as total')
        // ->groupBy('liabilities.type_of_liability')
        ->get();

        // dd($arr,  $revenue);
        return view('GeneralLedger.cash_flow', compact('revenue', 'ExpenditureRegister', 'asset', 'liability', 'currentT', 'to', 'from'));
    }
}
