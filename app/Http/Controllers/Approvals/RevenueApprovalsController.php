<?php

namespace App\Http\Controllers\Approvals;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Revenue\Revenue;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;

class RevenueApprovalsController extends Controller
{
    // approve revenue draft

    public function revenueDraft(Request $request) {
        //ACCOUNTANT
        if(groupId() == 1500) {
            $economicCode = $request->query('revenue_code');
            $from = $request->query("from");
            $to = $request->query('to');
            // dd($economicCode);

            $revenue = DB::table('acc_revenue')
            ->select("acc_revenue.*", "users.name")
            ->leftJoin("users", "users.username", "acc_revenue.created_by")
            ->where('acc_revenue.service_id', 37483)
            ->where('acc_revenue.deleted', 0)
            ->where('acc_revenue.approved', 1)
            ->when(!empty($economicCode) , function ($query) use ($economicCode) {
                return $query->where('acc_revenue.revenue_code', $economicCode);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('acc_revenue.created_at', '>=', $from);
            })

            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('acc_revenue.created_at', '<=', $to);
            })
            ->orderBy('acc_revenue.revenue_id', 'DESC')
            ->paginate(20);
            $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
            return view('Approvals.revenue_approvals', compact('revenue', 'revenue_lines'));
        }

        //REVIEWER
        if(groupId() == 3000) {
            $economicCode = $request->query('revenue_code');
            $from = $request->query("from");
            $to = $request->query('to');
            // dd($economicCode);

            $revenue = DB::table('acc_revenue')
            ->select("acc_revenue.*", "users.name")
            ->leftJoin("users", "users.username", "acc_revenue.created_by")
            ->where('acc_revenue.service_id', 37483)
            ->where('acc_revenue.deleted', 0)
            ->where('acc_revenue.approved', 4)
            ->when(!empty($economicCode) , function ($query) use ($economicCode) {
                return $query->where('acc_revenue.revenue_code', $economicCode);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('acc_revenue.created_at', '>=', $from);
            })

            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('acc_revenue.created_at', '<=', $to);
            })
            ->orderBy('acc_revenue.revenue_id', 'DESC')
            ->paginate(20);
            $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
            return view('Approvals.revenue_approvals', compact('revenue', 'revenue_lines'));
        }

        //SETUP ADMIN
        // dd(groupId());
        if(groupId() == 111111) {
            $economicCode = $request->query('revenue_code');
            $from = $request->query("from");
            $to = $request->query('to');
            // dd($economicCode);

            $revenue = DB::table('acc_revenue')
            ->select("acc_revenue.*", "users.name")
            ->leftJoin("users", "users.username", "acc_revenue.created_by")
            ->where('acc_revenue.service_id', 37483)
            ->where('acc_revenue.deleted', 0)
            ->whereIn('acc_revenue.approved', ['1', '4'])
            ->when(!empty($economicCode) , function ($query) use ($economicCode) {
                return $query->where('acc_revenue.revenue_code', $economicCode);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('acc_revenue.created_at', '>=', $from);
            })

            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('acc_revenue.created_at', '<=', $to);
            })
            ->orderBy('acc_revenue.revenue_id', 'DESC')
            ->paginate(20);
            $revenue_lines = DB::table('revenue_line')->where('type', 1)->get();
            return view('Approvals.revenue_approvals', compact('revenue', 'revenue_lines'));
        }
    }

    public function approveRevenue(Request $request) {
        try {
            if(groupId() == 3000) {
                DB::table('acc_revenue')
                ->where('revenue_id', $request->query('id'))
                ->update([
                    "approved" => 1,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);
            }

            if(groupId() == 1500) {
                DB::table('acc_revenue')
                ->where('revenue_id', $request->query('id'))
                ->update([
                    "approved" => 2,
                    "reapproved" => 1,
                    "reapproved_by" => auth()->user()->email,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);
            }


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

    public function multiple_approvals(Request $request) {
        // dd($request->all());

        if(groupId() == 3000) {
            DB::table('acc_revenue')
            ->whereIn('revenue_id', $request->itemid)
            ->update([
                "approved" => 1,
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
            ]);
        }

        if(groupId() == 1500) {
            DB::table('acc_revenue')
            ->whereIn('revenue_id', $request->itemid)
            ->update([
                "approved" => 2,
                "reapproved" => 1,
                "reapproved_by" => auth()->user()->email,
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
            ]);
        }

        $notification = array(
            'message' => 'Approved successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }


}
