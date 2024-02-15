<?php

namespace App\Http\Controllers\FinalAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GeneralLedgerController extends Controller
{
    public function payable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');

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

        return view('GeneralLedger.payable', compact('ExpenditureRegister'));
    }

    public function accountReceivable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');

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

        return view('GeneralLedger.receivable', compact('revenue'));
    }
}
