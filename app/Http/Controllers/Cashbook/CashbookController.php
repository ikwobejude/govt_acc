<?php

namespace App\Http\Controllers\Cashbook;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Revenue\Revenue;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CashbookController extends Controller
{
    public function cashbook(Request $request) {
        // dd(count($request->query()));
        $code = $request->query('code');
        $created_by = $request->query('created_by');
        $rrr = $request->query('rrr');
        $authority_ref = $request->query('authority_ref');
        $received_from = $request->query('received_from');
        $pait_to = $request->query("pait_to");
        $from = (count($request->query()) > 0 && $request->query("from") ? $request->query("from") :
                (count($request->query()) < 0 && !$request->query("from") ? Carbon::now()->format('Y-m-01') : ""));
        // count($request->query()) > 0 && $request->query("from") ? $request->query("from") ? $request->query("from") : Carbon::now()->format('Y-m-01') : "";
        $to = (count($request->query()) > 0 && $request->query("from") ? $request->query("to") :
        (count($request->query()) < 0 && !$request->query("from") ? Carbon::now()->format('Y-m-t') : ""));


        // dd($from, $to);

        $revenue = DB::table('acc_revenue')
        ->select( "revenue_date as date", "description as narration", "revenue_code as code", "revenue_line as line", "authority_document_ref_no as ref", "revenue_amount as amount")
        ->where('acc_revenue.service_id', 37483)
        ->where('acc_revenue.deleted', '0')
        ->where('acc_revenue.approved', 2)
        ->when(!empty($code) , function ($query) use ($code) {
            return $query->where('revenue_code', $code);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acc_revenue.settlement_date', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acc_revenue.settlement_date', '<=', $to);
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
         ->when(!empty($created_by), function ($query) use ($created_by) {
            return $query->where('acc_revenue.created_by','=', $created_by);
         })
        ->orderBy('acc_revenue.revenue_id', 'ASC')
        ->get();

        $expenses = db::table('expenditure_payregister')
        ->select('drafted_on as date', 'narration', 'expenditure_code as code', 'expenditure_name as line', 'payment_ref as ref', 'amount' )
        ->where('expenditure_payregister.service_id', 37483)
        ->where('expenditure_payregister.deleted', 0)
        ->where('expenditure_payregister.approved', 2)
        ->when(!empty($code), function ($query) use ($code) {
            return $query->where('expenditure_code', $code);
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
            return $query->whereDate('expenditure_payregister.drafted_on', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('expenditure_payregister.drafted_on', '<=', $to);
        })
        ->when(!empty($created_by), function ($query) use ($created_by) {
            return $query->where('expenditure_payregister.created_by','=', $created_by);
         })
        ->orderBy('expenditure_name', 'ASC')
        ->get();

        $resultObj = $revenue->merge($expenses);
        // Convert the object to a collection
        // dd($resultObj,  $from, $to);
        $collection = collect($resultObj);

        // Sort the collection by the 'date' key
        $sorted = $collection->sortBy('date');
        // dd($sorted);


        // $arr = [];
        // for

        // dd($revenues);
        $initiators = DB::table('users')
        ->select('username', 'name')
        ->where('group_id', 3500)->get();
        // dd($initiators);
        $line = array(1, 2);
        $revenue_lines = DB::table('revenue_line')->whereIn('type', $line)->get();
        // dd($revenue_lines);
        return view('Cashbook.cashbook', compact('sorted', 'revenue_lines', 'initiators'));
    }



}
