<?php

namespace App\Http\Controllers\Transaction;

use Carbon\Carbon;
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
        // dd($created_by);
        $rrr = $request->query('rrr');
        $authority_ref = $request->query('authority_ref');
        $received_from = $request->query('received_from');
        $from = $request->has("from")
        ? ($request->query("from") ?: null)  // Use the provided date or leave it empty if it's an empty string
        : Carbon::now()->format('Y-m-01');   // Default to first day of the month if "from" is not in the query

        $to = $request->has("to")
            ? ($request->query("to") ?: null)    // Use the provided date or leave it empty if it's an empty string
            : Carbon::now()->format('Y-m-t');    // Default to last day of the month if "to" is not in the query


          // Fetch revenues with conditional filters
            $revenue = DB::table('acc_revenue')
            ->select('acc_revenue.*', 'users.name')
            ->leftJoin('users', 'users.username', '=', 'acc_revenue.created_by')
            ->where([
                ['acc_revenue.service_id', '=', 37483],
                ['acc_revenue.deleted', '=', '0'],
                ['acc_revenue.approved', '=', 2]
            ])
            ->when($request->query('revenue_code'), fn($query, $revenue_code) => $query->where('revenue_code', $revenue_code))
            ->when($from, fn($query) => $query->whereDate('acc_revenue.settlement_date', '>=', $from))
            ->when($to, fn($query) => $query->whereDate('acc_revenue.settlement_date', '<=', $to))
            ->when($request->query('authority_ref'), fn($query, $authority_ref) => $query->where('acc_revenue.authority_document_ref_no', $authority_ref))
            ->when($request->query('rrr'), fn($query, $rrr) => $query->where('acc_revenue.rrr', $rrr))
            ->when($request->query('received_from'), fn($query, $received_from) => $query->where('acc_revenue.received_from', 'LIKE', "%{$received_from}%"))
            ->when($request->query('created_by'), fn($query, $created_by) => $query->where('acc_revenue.created_by', 'LIKE', "%{$created_by}%"))
            ->orderBy('acc_revenue.revenue_id', 'ASC')
            ->get();

        // Fetch other data for the view
        $initiators = DB::table('users')->select('username', 'name')->get();
        $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
        return view('transaction.revenue_transactions', compact('revenue','revenue_lines', 'initiators'));
    }


    public function expenditureTransactions(Request $request)
    {
        // dd($request->query());
        $batch_type = $request->query("batch_type");
        $expenditure = $request->query("expenditure");
        $authority_document_ref_no = $request->query("authority_document_ref_no");
        $pait_to = $request->query("pait_to");
        $from = $request->has("from")
        ? ($request->query("from") ?: null)  // Use the provided date or leave it empty if it's an empty string
        : Carbon::now()->format('Y-m-01');   // Default to first day of the month if "from" is not in the query

    $to = $request->has("to")
        ? ($request->query("to") ?: null)    // Use the provided date or leave it empty if it's an empty string
        : Carbon::now()->format('Y-m-t');    // Default to last day of the month if "to" is not in the query
        $created_by = $request->query('created_by');

        // dd($from,$to );


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
            return $query->whereDate('expenditure_payregister.drafted_on', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('expenditure_payregister.drafted_on', '<=', $to);
        })
        ->orderBy('idexpenditure_payregister', 'DESC')
        // ->toSql();
        ->get();

        // dd($ExpenditureRegister);

        $initiators = DB::table('users')
        ->select('username', 'name')->get();
        // dd($ExpenditureRegister);
        return view('transaction.expenditure_transactions', compact('ExpenditureRegister', 'months', 'expenditureType', 'batchName', 'initiators'));
    }
}
