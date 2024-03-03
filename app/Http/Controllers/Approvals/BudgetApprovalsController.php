<?php

namespace App\Http\Controllers\Approvals;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BudgetApprovalsController extends Controller
{
    public function index(Request $request) {

        $budgetType = $request->query('budgetType');
        $economicCode = $request->query('economicCode');
        $project = $request->query('project');
        $approved = $request->query('approved');
        $from = $request->query('from');
        $to = $request->query('to');

        if($economicCode) {
            $arr = explode(',', $economicCode);
            $economicCode = $arr[1];
        }


        // dd($budgetType, $economicCode, $project, $approved, $from, $to);
        if(groupId() == 111111) {
            $budges = DB::table('acct_budgets')
            ->whereIn('approved', [1,2,3,4])
            ->where('deleted', 0)
            ->when($budgetType, function ($query, string $budgetType) {
                $query->where('budget_type', $budgetType);
            })
            ->when($economicCode, function ($query, string $economicCode) {
                $query->where('economic_code', $economicCode);
            })
            ->when($project, function ($query, string $project) {
                $query->where('project', $project);
            })
            ->when($approved, function ($query, string $approved) {
                $query->where('approved', $approved);
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
            $budges = DB::table('acct_budgets')
            ->where('approved', 4)
            ->where('deleted', 0)
            ->when($budgetType, function ($query, string $budgetType) {
                $query->where('budget_type', $budgetType);
            })
            ->when($economicCode, function ($query, string $economicCode) {
                $query->where('economic_code', $economicCode);
            })
            ->when($project, function ($query, string $project) {
                $query->where('project', $project);
            })
            ->when($approved, function ($query, string $approved) {
                $query->where('approved', $approved);
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
            $budges = DB::table('acct_budgets')
            ->where('approved', 1)
            ->where('deleted', 0)
            ->when($budgetType, function ($query, string $budgetType) {
                $query->where('budget_type', $budgetType);
            })
            ->when($economicCode, function ($query, string $economicCode) {
                $query->where('economic_code', $economicCode);
            })
            ->when($project, function ($query, string $project) {
                $query->where('project', $project);
            })
            ->when($approved, function ($query, string $approved) {
                $query->where('approved', $approved);
            })
            ->when($from, function ($query, string $from) {
                $query->whereDate('created_at', '>=', $from);
            })
            ->when($to, function ($query, string $to) {
                $query->whereDate('created_at', '<=', $to);
            })
            ->get();
        }

        return view('Approvals.budget_approvals', compact('budges'));
    }


    public function approveAsset(Request $request) {
        try {
            if(groupId() == 3000) {
                DB::table('acct_budgets')
                ->where('id', $request->query('id'))
                ->update([
                    "approved" => 1,
                    "approved_on" => Carbon::now(),
                    "approved_by" => auth()->user()->email
                ]);
            }

            if(groupId() == 1500) {
                DB::table('acct_budgets')
                ->where('id', $request->query('id'))
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

    public function rejected(Request $request) {
        try {
            DB::table('acct_budgets')
            ->where('id', $request->query('id'))
            ->update([
                "reason" => $request->reason,
                "approved" => 3,
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



// SELECT `DEFAULT_COLLATION_NAME` FROM `information_schema`.`SCHEMATA` WHERE `SCHEMA_NAME`='govt_acc';
