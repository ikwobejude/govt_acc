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
         $months = DB::table('_months')->orderBy('month')->get();
         $expenditureType = RevenueLine::where('type', 2)->get();
         $batchName = ExpenditureBatchName::all();

         $economicCode = $request->query('revenue_code');
         $from = $request->query("from");
         $to = $request->query('to');

         $ExpenditureRegister = DB::table('expenditure_payregister')
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

        ->paginate(20);

        return view('Approvals.expenditure_approvals', compact('months', 'expenditureType', 'batchName', 'ExpenditureRegister'));
    }

    public function approveExpenditure(Request $request) {
        try {
            DB::table('expenditure_payregister')
            ->where('idexpenditure_payregister', $request->query('id'))
            ->update([
                "approved" => 1,
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
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
