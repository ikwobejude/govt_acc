<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureBatchName;

class TransactionControllers extends Controller
{
    public function revenueTransaction(Request $request) {
        $revenue_code = $request->query('revenue_code');
        $created_by = $request->query('created_by');
        $rrr = $request->query('rrr');
        $authority_ref = $request->query('authority_ref');
        $received_from = $request->query('received_from');
        $from = $request->query('from');
        $to = $request->query('to');


        $revenue = DB::table('acc_revenue')
        ->select('acc_revenue.*', 'users.name')
        ->leftJoin('users', 'users.username', 'acc_revenue.created_by')
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
         ->when(!empty($created_by), function ($query) use ($created_by) {
            return $query->where('user.username', 'LIKE', "%{$created_by}%");
         })
        ->orderBy('acc_revenue.revenue_id', 'ASC')
        ->get();

        // dd($revenues);
        $initiators = DB::table('users')
        ->select('username', 'name')
        ->where('group_id', 3500)->get();
        // dd($initiators);
        $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
        return view('transaction.revenue_transactions', compact('revenue','revenue_lines', 'initiators'));
    }


    public function expenditureTransactions(Request $request)
    {
        $batch_type = $request->query("batch_type");
        $expenditure = $request->query("expenditure");
        $authority_document_ref_no = $request->query("authority_document_ref_no");
        $pait_to = $request->query("pait_to");
        $from = $request->query("from");
        $to = $request->query("to");
        $created_by = $request->query('created_by');


        $months = DB::table('_months')->orderBy('month')->get();
        $expenditureType = RevenueLine::where('type', 2)->get();
        $batchName = ExpenditureBatchName::all();

        $ExpenditureRegister = db::table('expenditure_payregister')
        ->select("expenditure_payregister.*", "users.name as user_name")
        ->leftJoin('users', 'users.username', 'expenditure_payregister.created_by')
        ->where('expenditure_payregister.service_id', 37483)
        ->where('expenditure_payregister.deleted', 0)
        ->where('expenditure_payregister.approved', 2)
        ->when(!empty($expenditure), function ($query) use ($expenditure) {
            return $query->where('expenditure_code', $expenditure);
        })
        ->when(!empty($pait_to), function ($query) use ($pait_to) {
            return $query->where('expenditure_payregister.name', 'like', "%{$pait_to}%");
        })
        ->when(!empty($batch_type), function ($query) use ($batch_type) {
            return $query->where('expenditure_payregister.batch_name', '=', $batch_type);
        })
        ->when(!empty($authority_document_ref_no), function ($query) use ($authority_document_ref_no) {
            return $query->where('expenditure_payregister.payment_ref', '=', $authority_document_ref_no);
        })
        ->when(!empty($created_by), function ($query) use ($created_by) {
            return $query->where('users.username', '=', $created_by);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('expenditure_payregister.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('expenditure_payregister.created_at', '<=', $to);
        })
        ->orderBy('expenditure_name', 'ASC')
        ->get();

        $initiators = DB::table('users')
        ->select('username', 'name')
        ->where('group_id', 3500)->get();
        // dd($ExpenditureRegister);
        return view('transaction.expenditure_transactions', compact('ExpenditureRegister', 'months', 'expenditureType', 'batchName', 'initiators'));
    }
}
