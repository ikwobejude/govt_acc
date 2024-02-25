<?php

namespace App\Http\Controllers\FinalAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureBatchName;

class GeneralLedgerController extends Controller
{
    public function payable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');
        $expenditureType = RevenueLine::where('type', 2)->get();
        $batchName = ExpenditureBatchName::all();
        $ExpenditureRegister = DB::table('expenditure_payregister')
        ->where('service_id', 37483)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('expenditure_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->orderBy('expenditure_name', 'ASC')
        ->get();

        // dd($ExpenditureRegister);

        return view('GeneralLedger.payable', compact('ExpenditureRegister', 'expenditureType', 'batchName'));
    }

    public function accountReceivable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');

        $revenue_lines  = RevenueLine::where('type', 1)->get();
        $revenue = DB::table('acc_revenue')
        ->where('service_id', 37483)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('revenue_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->orderBy('revenue_line', 'ASC')
        ->get();

        return view('GeneralLedger.receivable', compact('revenue', 'revenue_lines'));
    }
}
