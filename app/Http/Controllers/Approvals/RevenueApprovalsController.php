<?php

namespace App\Http\Controllers\Approvals;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RevenueApprovalsController extends Controller
{
    // approve revenue draft

    public function revenueDraft(Request $request) {
        if(groupId() == 1500) {
            $economicCode = $request->query('revenue_code');
            $from = $request->query("from");
            $to = $request->query('to');
            // dd($economicCode);

            $revenue = DB::table('acc_revenue')
            ->where('service_id', 37483)
            ->whereIn('approved', ['1'])
            ->when(!empty($economicCode) , function ($query) use ($economicCode) {
                return $query->where('revenue_code', $economicCode);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('acc_revenue.created_at', '>=', $from);
            })

            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('acc_revenue.created_at', '<=', $to);
            })
            ->paginate(20);
            $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
        } else {
            $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');
        // dd($economicCode);

        $revenue = DB::table('acc_revenue')
        ->where('service_id', 37483)
        ->whereIn('approved', ['4'])
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('revenue_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('acc_revenue.created_at', '>=', $from);
        })

        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('acc_revenue.created_at', '<=', $to);
        })
        ->paginate(20);
        $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
        }


        return view('Approvals.revenue_approvals', compact('revenue', 'revenue_lines'));
    }

    public function approveRevenue(Request $request) {
        try {
            DB::table('acc_revenue')
            ->where('revenue_id', $request->query('id'))
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

    public function disApprovedRevenue(Request $request) {
        try {
            DB::table('acc_revenue')
            ->where('revenue_id', $request->query('id'))
            ->update([
                "approved" => 3,
                "reason" => $request->query("reason"),
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
            ]);

            return response()->json([
                "status" => true,
                "message" => "Dis approved"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ]);
        }
    }
}
