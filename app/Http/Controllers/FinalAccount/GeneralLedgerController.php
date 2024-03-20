<?php

namespace App\Http\Controllers\FinalAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureBatchName;

class GeneralLedgerController extends Controller
{

    public function generalLedger(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');
        $expenditureType = RevenueLine::where('type', 2)->get();
        $batchName = ExpenditureBatchName::all();


        // Revenue
        $revenue = DB::table('acc_revenue')
        ->select('created_at', 'description as narration', 'revenue_amount as amount', 'revenue_line as economic_name', 'revenue_code as economic_code')
        ->where('service_id', 37483)
        ->where('approved', 2)
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

        // dd($revenueData);

        $liabilities = DB::table('liabilities')
        ->select('created_at', 'narration', 'amount', 'economic_name', 'economic_code')
        // ->where('service_id', 37483)
        ->where('approved', 2)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('economic_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->orderBy('economic_code', 'ASC')
        ->get();



        // dd($revenue);

        // dd($ExpenditureRegister);
        // Expenditures
        $ExpenditureRegister = DB::table('expenditure_payregister')
        ->select('created_at', 'narration', 'amount', 'expenditure_name as economic_name', 'expenditure_code as economic_code')
        ->where('service_id', 37483)
        ->where('approved', 2)
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

        $assests = DB::table('acct_assests')
        ->select('created_at', 'assest_decription as narration', 'opening_value as amount', 'asset_rev_name as economic_name', 'asset_rev as economic_code')
        ->where('service_id', 37483)
        ->where('approved', 2)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('asset_rev_name', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->orderBy('asset_rev_name', 'ASC')
        ->get();





        return view('GeneralLedger.general_ledge', compact('expenditureType', 'batchName', 'revenue', 'liabilities', 'ExpenditureRegister', 'assests'));
    }

    public function payable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');
        $expenditureType = RevenueLine::where('type', 2)->get();
        $batchName = ExpenditureBatchName::all();



        // Expenditures
        $ExpenditureRegister = DB::table('expenditure_payregister')
        ->where('service_id', 37483)
        ->where('approved', 2)
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

        return view('GeneralLedger.payable', compact('ExpenditureRegister', 'expenditureType', 'batchName'));
    }

    public function accountReceivable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');

        $revenue_lines  = RevenueLine::where('type', 1)->get();
        $revenue = DB::table('acc_revenue')
        ->where('service_id', 37483)
        ->where('approved', 2)
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
