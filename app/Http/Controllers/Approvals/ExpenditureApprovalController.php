<?php

namespace App\Http\Controllers\Approvals;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureRegister;
use App\Models\Expenditure\ExpenditureBatchName;

class ExpenditureApprovalController extends Controller
{
    public function index(Request $request) {
         // return view('Expenditure.view_expenditure_payregister');

        $batch_type = $request->query('batch_type');
        $authority_document_ref_no = $request->query('authority_document_ref_no');
        $expenditure_type = $request->query('expenditure_type');
        $from = $request->query('from');
        $to = $request->query('to');
        // dd($batch_type,
        // $authority_document_ref_no,
        // $expenditure_type,
        // $from,
        // $to);

         $months = DB::table('_months')->orderBy('month')->get();
         $expenditureType = RevenueLine::where('type', 2)->get();
         $batchName = ExpenditureBatchName::all();


         $ExpenditureRegister = DB::table('expenditure_payregister')
         ->where('service_id', 37483)
         ->when(!empty($batch_type) , function ($query) use ($batch_type) {
            return $query->where('batch_name', $batch_type);
         })
         ->when(!empty($authority_document_ref_no) , function ($query) use ($authority_document_ref_no) {
            return $query->where('payment_ref', $authority_document_ref_no);
         })
         ->when(!empty($expenditure_type) , function ($query) use ($expenditure_type) {
             return $query->where('expenditure_code', $expenditure_type);
          })
          ->when(!empty($from), function ($query) use ($from) {
             return $query->whereDate('created_at', '>=', $from);
          })
          ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('created_at', '<=', $to);
           })
        //    ->toSql();
        ->paginate(20);

        // dd($ExpenditureRegister);
        return view('Approvals.expenditure_approvals', compact('months', 'expenditureType', 'batchName', 'ExpenditureRegister'));
    }

    public function approveExpenditure(Request $request) {
        try {
            DB::table('expenditure_payregister')
            ->where('idexpenditure_payregister', $request->query('id'))
            ->update([
                "approved" => (groupId() == 3000 ? 1 : (groupId() == 1500 ? 2: 0)) ,
                "reapproved" => groupId() == 1500 ? 1: 0,
                "reapproved_by" => groupId() == 1500 ? auth()->user()->email: "",
                "approved_on" => Carbon::now(),
                "approved_by" => groupId() == 3000 ? auth()->user()->email : ""
            ]);

            return response()->json([
                "status" => true,
                "message" => "Approved"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function disApprovedExpenditure(Request $request) {
        try {
            // dd($request->query('id'));
            DB::table('expenditure_payregister')
            ->where('idexpenditure_payregister', $request->query('id'))
            ->update([
                "approved" => 3,
                "reason" => $request->query("reason"),
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
            ]);

            return response()->json([
                "status" => true,
                "message" => "Rejected"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
}
