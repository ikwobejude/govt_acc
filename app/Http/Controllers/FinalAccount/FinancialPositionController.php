<?php

namespace App\Http\Controllers\FinalAccount;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FinancialPositionController extends Controller
{
    public function index(Request $request) {
        // dd($firstDay, $lastDay);
        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $asset = DB::table('acct_assests')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->selectRaw('acct_assests.assest_name, acct_assests.asset_rev, acct_assest_types.assest_type, SUM(acct_assests.opening_value) as opening_value')
        ->groupBy('assest_type_id')
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
        ->selectRaw('liabilities.liability, liabilities.economic_code, liabilities.type_of_liability, SUM(liabilities.amount) as amount')
        ->groupBy('liabilities.type_of_liability')
        ->get();

        // dd($liability);

        $revenue = DB::table('acc_revenue')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw('acc_revenue.received_from, acc_revenue.revenue_line, SUM(acc_revenue.revenue_amount) as revenue_amount')
        ->get();

        // dd($asset, $liability, $revenue);
        return view('GeneralLedger.statement_of_financial_position', compact('asset', 'liability', 'revenue', 'to', 'from'));
    }

    public function download(Request $request) {
        // dd($firstDay, $lastDay);
        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $asset = DB::table('acct_assests')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acct_assests.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acct_assests.created_at', '<=', $to);
        })
        ->selectRaw('acct_assests.assest_name, acct_assests.asset_rev, acct_assest_types.assest_type, SUM(acct_assests.opening_value) as opening_value')
        ->groupBy('assest_type_id')
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
        ->selectRaw('liabilities.liability, liabilities.economic_code, liabilities.type_of_liability, SUM(liabilities.amount) as amount')
        ->groupBy('liabilities.type_of_liability')
        ->get();

        // dd($liability);

        $revenue = DB::table('acc_revenue')
        ->where('approved', 2)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->selectRaw('acc_revenue.received_from, acc_revenue.revenue_line, SUM(acc_revenue.revenue_amount) as revenue_amount')
        ->get();

        // dd($asset, $liability, $revenue);
        return view('GeneralLedger.download_statement_of_financial_position', compact('asset', 'liability', 'revenue', 'to', 'from'));
    }

}
