<?php

namespace App\Http\Controllers\Approvals;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;

class ApproveLiabilityController extends Controller
{
    public function index(Request $request) {
        $revenue_code = $request->query('revenue_code');
        $liability = $request->query('liability');
        $type_of_liability = $request->query('type_of_liability');
        $authorize_ref = $request->query('authority_document_ref_no');
        $from = $request->query('from');
        $to = $request->query('to');
        $approvalLevels = $request->query('approvalLevels');

        $revenue_lines = RevenueLine::where('type', 4)->get();
        if(groupId() == 111111) {
            $liabilities = DB::table('liabilities')
            ->whereIn('approved', [1,2,3,4])
            ->where('deleted', 0)
            ->when($revenue_code, function ($query, string $revenue_code) {
                $query->where('economic_code', $revenue_code);
            })
            ->when($liability, function ($query, string $liability) {
                $query->where('liability', 'like', "%{$liability}%");
            })
            ->when($type_of_liability, function ($query, string $type_of_liability) {
                $query->where('type_of_liability', $type_of_liability);
            })
            ->when($authorize_ref, function ($query, string $authorize_ref) {
                $query->where('authorize_ref', $authorize_ref);
            })
            ->when($approvalLevels, function ($query, string $approvalLevels) {
                $query->where('approved', $approvalLevels);
            })
            ->when($from, function ($query, string $from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query, string $to) {
                $query->whereDate('created_at', '<=', $to);
            })
            ->get();
        }

        if(groupId() == 3000) {
            $liabilities = DB::table('liabilities')
            ->where('approved', 4)
            ->where('deleted', 0)
            ->when($revenue_code, function ($query, string $revenue_code) {
                $query->where('economic_code', $revenue_code);
            })
            ->when($liability, function ($query, string $liability) {
                $query->where('liability', 'like', "%{$liability}%");
            })
            ->when($type_of_liability, function ($query, string $type_of_liability) {
                $query->where('type_of_liability', $type_of_liability);
            })
            ->when($authorize_ref, function ($query, string $authorize_ref) {
                $query->where('authorize_ref', $authorize_ref);
            })
            ->when($approvalLevels, function ($query, string $approvalLevels) {
                $query->where('approved', $approvalLevels);
            })
            ->when($from, function ($query, string $from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query, string $to) {
                $query->whereDate('created_at', '<=', $to);
            })
            ->get();
        }

        if(groupId() == 1500) {
            $liabilities = DB::table('liabilities')
            ->where('approved', 1)
            ->where('deleted', 0)
            ->when($revenue_code, function ($query, string $revenue_code) {
                $query->where('economic_code', $revenue_code);
            })
            ->when($liability, function ($query, string $liability) {
                $query->where('liability', 'like', "%{$liability}%");
            })
            ->when($type_of_liability, function ($query, string $type_of_liability) {
                $query->where('type_of_liability', $type_of_liability);
            })
            ->when($authorize_ref, function ($query, string $authorize_ref) {
                $query->where('authorize_ref', $authorize_ref);
            })
            ->when($approvalLevels, function ($query, string $approvalLevels) {
                $query->where('approved', $approvalLevels);
            })
            ->when($from, function ($query, string $from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query, string $to) {
                $query->whereDate('created_at', '<=', $to);
            })
            ->get();
        }

        // Liabilities::all()->sortDesc();
        return view('Approvals.approve_liability', compact('liabilities', 'revenue_lines'));
    }

    public function approveLiability(Request $request) {
        try {
            // dd($request->query('id'));
            if(groupId() == 1500){
                DB::table('liabilities')
                ->where('id', $request->query('id'))
                ->update([
                    "approved" => 2,
                    "reapproved" => 1,
                    "reapproved_by" => auth()->user()->email,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);

            }

            if(groupId() == 3000){
                DB::table('liabilities')
                ->where('id', $request->query('id'))
                ->update([
                    "approved" => 1,
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

    public function rejectedLiability(Request $request) {
        try {
            // dd($request->query('id'));
            DB::table('liabilities')
            ->where('id', $request->query('id'))
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

    public function multiple_approval(Request $request) {

        if(groupId() == 1500){
            DB::table('liabilities')
            ->whereIn('id', $request->itemid)
            ->update([
                "approved" => 2,
                "reapproved" => 1,
                "reapproved_by" => auth()->user()->email,
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
            ]);

        }

        if(groupId() == 3000){
            DB::table('liabilities')
            ->whereIn('id', $request->itemid)
            ->update([
                "approved" => 1,
                "approved_on" => Carbon::now(),
                "approved_by" => auth()->user()->email
            ]);

        }

        $notification = array(
            'message' => "Liability Approved",
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
