<?php

namespace App\Http\Controllers\Cashbook;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Revenue\Revenue;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
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
        ->select(
            "settlement_date as date",
            "description as narration",
            "revenue_code as code",
            "revenue_line as line",
            "authority_document_ref_no as ref",
            "revenue_amount as amount"
        )
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
        ->select(
            'drafted_on as date',
            'narration',
            'expenditure_code as code',
            'expenditure_name as line',
            'payment_ref as ref',
            'amount'
        )
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
        dd($collection);

        // Sort the collection by the 'date' key
        $sorted = $collection->sortBy('date');
        dd($sorted);


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


    public function personalCashbook(Request $request) {
        $from = $request->query("from") ? $request->query("from") :  Carbon::now()->startOfYear();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $personnel = DB::table('expenditure_payregister')
        ->select([
            'expenditure_payregister.expenditure_type as payment_ref',
            'expenditure_payregister.narration as narration',
            'expenditure_payregister.drafted_on as date',
            'expenditure_payregister.expenditure_type as uniId',
            'expenditure_payregister.expenditure_code as code',
            'expenditure_payregister.expenditure_name as line',
            DB::raw('SUM(expenditure_payregister.amount) as amount'),
            'revenue_line.note as note'
        ])

        ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
        ->where('expenditure_payregister.approved', 2)
        ->whereIn('revenue_line.note', [11])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->groupBy('expenditure_payregister.expenditure_code')
        // ->orderBy('revenue_line.note', 'ASC')
        ->get();
        $revenue_lines = RevenueLine::where('type', 2)->get();

        // dd($personnel);

        return view('Cashbook.personnel_cashbook', compact('personnel', 'revenue_lines', 'from', 'to'));

    }

    public function capitalCashbook(Request $request) {
        $from = $request->query("from") ? $request->query("from") :  Carbon::now()->startOfYear();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $capital_grant = DB::table("acc_revenue")
        ->select([
            'acc_revenue.authority_document_ref_no as ref',
            'acc_revenue.description as narration',
            'acc_revenue.settlement_date as date',
            'acc_revenue.revenue_code as code',
            'acc_revenue.revenue_line as line',
            'acc_revenue.asset_name as uniId',
            DB::raw('SUM(acc_revenue.revenue_amount) as amount'),
            'revenue_line.note'
        ])
        ->join('revenue_line', 'revenue_line.economic_code', '=', 'acc_revenue.revenue_code')
        ->where('service_id',37483)
        ->where('acc_revenue.approved', 2)
        ->where('revenue_line.note', 8)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acc_revenue.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('acc_revenue.created_at', '<=', $to);
        })

        // ->selectRaw("acc_revenue.revenue_line as line, acc_revenue.revenue_code as code, acc_revenue.asset_name as uniId, acc_revenue.revenue_amount as total, revenue_line.note")
        ->groupBy('acc_revenue.revenue_code')
        // ->groupBy('revenue_line.note')
        ->get();

        $expenditure = DB::table('expenditure_payregister')
        ->select([
            'expenditure_payregister.expenditure_type as ref',
            'expenditure_payregister.narration as narration',
            'expenditure_payregister.drafted_on as date',
            'expenditure_payregister.expenditure_code as code',
            'expenditure_payregister.expenditure_name as line',
            'expenditure_payregister.expenditure_type as uniId',
            DB::raw('SUM(expenditure_payregister.amount) as amount'),
            'revenue_line.note as note'
        ])

        ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
        ->where('expenditure_payregister.approved', 2)
        ->where('revenue_line.note', 8)
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->groupBy('expenditure_payregister.expenditure_code')
        ->get();
        $cap_grant = $capital_grant->toArray();
        $exp_grant = $expenditure->toArray();


        $resultObj = array_merge($cap_grant, $exp_grant);
        // Convert the object to a collection
        // dd($resultObj,  $capital_grant, $expenditure);
        $collection = collect($resultObj);

        // Sort the collection by the 'date' key
        $capital_grant = $collection->sortBy('date');
        // dd($sorted );

        return view('Cashbook.capital_cashbook', compact('capital_grant','from', 'to'));
    }


    public function overheadCashbook(Request $request) {
        $from = $request->query("from") ? $request->query("from") :  Carbon::now()->startOfYear();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;

        $overhead = DB::table('expenditure_payregister')
        ->select([
            'expenditure_payregister.expenditure_type as payment_ref',
            'expenditure_payregister.narration as narration',
            'expenditure_payregister.drafted_on as date',
            'expenditure_payregister.expenditure_type as uniId',
            'expenditure_payregister.expenditure_code as code',
            'expenditure_payregister.expenditure_name as line',
            DB::raw('SUM(expenditure_payregister.amount) as amount'),
            'revenue_line.note as note'
        ])

        ->join('revenue_line', 'revenue_line.economic_code', '=', 'expenditure_payregister.expenditure_code')
        ->where('expenditure_payregister.approved', 2)
        ->whereIn('revenue_line.note', [11])
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->groupBy('expenditure_payregister.expenditure_code')
        // ->orderBy('revenue_line.note', 'ASC')
        ->get();
        // $revenue_lines = RevenueLine::where('type', 2)->get();

        // dd($personnel);

        return view('Cashbook.overhead_cashbook', compact('overhead', 'from', 'to'));

    }



}


