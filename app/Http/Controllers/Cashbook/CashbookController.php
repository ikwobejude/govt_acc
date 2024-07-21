<?php

namespace App\Http\Controllers\Cashbook;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Revenue\Revenue;

class CashbookController extends Controller
{
    public function cashbook(Request $request) {
        $revenue_code = $request->query('revenue_code');
        $created_by = $request->query('created_by');
        $rrr = $request->query('rrr');
        $authority_ref = $request->query('authority_ref');
        $received_from = $request->query('received_from');
        $pait_to = $request->query("pait_to");
        $from = $request->query('from');
        $to = $request->query('to');


        // $cashbook = Revenue::leftJoin('expenditure_payregister', function($join) {
        //     $join->on(DB::raw('DATE(expenditure_payregister.created_at)'), '=', DB::raw('DATE(acc_revenue.created_at)'));
        // })
        // ->where('acc_revenue.service_id', 37483)
        // ->select('expenditure_payregister.*', 'acc_revenue.*')
        // ->toSql();

        // dd($cashbook);


        $revenue = DB::table('acc_revenue')
        ->select( "revenue_date", "received_from", "description", "revenue_code", "authority_document_ref_no", "revenue_amount")
        ->where('acc_revenue.service_id', 37483)
        ->where('acc_revenue.deleted', '0')
        ->where('acc_revenue.approved', 2)
        ->when(!empty($revenue_code) , function ($query) use ($revenue_code) {
            return $query->where('revenue_code', $revenue_code);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acc_revenue.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acc_revenue.created_at', '<=', $to);
        })
        ->when(!empty($authority_ref), function ($query) use ($authority_ref) {
            return $query->where('acc_revenue.authority_document_ref_no', '=', $authority_ref);
         })
         ->when(!empty($rrr), function ($query) use ($rrr) {
            return $query->where('acc_revenue.rrr', '=', $rrr);
         })
         ->when(!empty($received_from), function ($query) use ($received_from) {
            return $query->where('acc_revenue.received_from', 'LIKE', "%{$received_from}%");
         })
        ->orderBy('acc_revenue.revenue_id', 'ASC')
        ->get();

        $expenses = db::table('expenditure_payregister')
        ->select("expenditure_payregister.*")
        ->where('expenditure_payregister.service_id', 37483)
        ->where('expenditure_payregister.deleted', 0)
        ->where('expenditure_payregister.approved', 2)
        ->when(!empty($revenue_code), function ($query) use ($revenue_code) {
            return $query->where('expenditure_code', $revenue_code);
        })
        ->when(!empty($pait_to), function ($query) use ($pait_to) {
            return $query->where('expenditure_payregister.name', 'like', "%{$pait_to}%");
        })
        // ->when(!empty($batch_type), function ($query) use ($batch_type) {
        //     return $query->where('expenditure_payregister.batch_name', '=', $batch_type);
        // })
        ->when(!empty($authority_ref), function ($query) use ($authority_ref) {
            return $query->where('expenditure_payregister.payment_ref', '=', $authority_ref);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->orderBy('expenditure_name', 'ASC')
        ->get();

        // dd($revenues);
        $initiators = DB::table('users')
        ->select('username', 'name')
        ->where('group_id', 3500)->get();
        // dd($initiators);
        $line = array(1, 2);
        $revenue_lines = DB::table('revenue_line')->whereIn('type', $line)->get();
        // dd($revenue_lines);
        return view('Cashbook.cashbook', compact('revenue', 'expenses', 'revenue_lines', 'initiators'));
    }



}
