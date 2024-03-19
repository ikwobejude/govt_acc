<?php

namespace App\Http\Controllers\Budgeting;

use Illuminate\Http\Request;
use App\Models\Budgets\Bedgets;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BudgetController extends Controller
{
    public function index(Request $request) {

        $budgetType = $request->query('budgetType');
        $economicCode = $request->query('economicCode');
        $project = $request->query('project');
        $approved = $request->query('approved');
        $from = $request->query('from');
        $to = $request->query('to');

        $NCOS = RevenueLine::whereIn('type', [2,3])->get();

        if($economicCode) {
            $arr = explode(',', $economicCode);
            $economicCode = $arr[1];
        }


        // dd($budgetType, $economicCode, $project, $approved, $from, $to);
        $budges = DB::table('acct_budgets')
        ->select("acct_budgets.*", 'users.name')
        ->leftJoin('users', 'users.username', 'acct_budgets.created_by')
        ->whereIn('acct_budgets.approved', [0, 3])
        ->where('acct_budgets.deleted', 0)
        ->when($budgetType, function ($query, string $budgetType) {
            $query->where('acct_budgets.budget_type', $budgetType);
        })
        ->when($economicCode, function ($query, string $economicCode) {
            $query->where('acct_budgets.economic_code', $economicCode);
        })
        ->when($project, function ($query, string $project) {
            $query->where('acct_budgets.project', $project);
        })
        ->when($approved, function ($query, string $approved) {
            $query->where('acct_budgets.approved', $approved);
        })
        ->when($from, function ($query, string $from) {
            $query->whereDate('acct_budgets.created_at', '>=', $from);
        })
        ->when($to, function ($query, string $to) {
            $query->whereDate('acct_budgets.created_at', '<=', $to);
        })
        ->get();
        return view('Budget.budget', compact('budges', 'NCOS'));
    }

    public function store(Request $request) {
        try {
            // dd($request->all());
            $validateUser = Validator::make($request->all(), [
                'budgetType' => 'required|integer',
                'economicCode' => 'required|string',
                'project' => 'required|string',
                'current_budget' => 'required|string',
            ]);

            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }

            $arr = explode(',', $request->economicCode);

            DB::table('acct_budgets')->insert([
                "budget_type" => $request->budgetType == "2,3" ? 2 : $request->budgetType,
                "economic_code" => $arr[1],
                "line" => $arr[2],
                "economic_type" => $arr[0],
                "found_source" => ($request->budgetType == 2 ? "02101" :
                                  ($request->budgetType == 3 ? "02201" : "03101" )),
                "project" => $request->project,
                "current_budget" => $request->current_budget,
                "created_by" => username()
            ]);

            $notification = array(
                'message' => "Budget added!",
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
           $notification = array(
                'message' => $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request) {
        try {
            // dd($request->all());
            $validateUser = Validator::make($request->all(),  [
                'budgetType' => 'required|integer',
                'economicCode' => 'required|string',
                'project' => 'required|string',
                'current_budget' => 'required|string',
            ]);


            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }


            $arr = explode(',', $request->economicCode);
            // dd($arr);

            DB::table('acct_budgets')->where('id', $request->id)->update([
                "budget_type" => $request->budgetType,
                "economic_code" => $arr[1],
                "line" => $arr[0],
                "economic_type" => $arr[2],
                "found_source" => ($request->budgetType == 2 ? "02101" :
                                  ($request->budgetType == 3 ? "02201" : "03101" )),
                "project" => $request->project,
                "current_budget" => $request->current_budget
            ]);

            $notification = array(
                'message' => "Budget Updated!",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
           $notification = array(
                'message' => $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function destroy (Request $request) {
        try {
            DB::table('acct_budgets')->where('id', $request->id)->update([
                "deleted" => 1
            ]);

            $notification = array(
                'message' => "Budget Deleted!",
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
           $notification = array(
                'message' => $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function finalization (Request $request) {
        try {
            // dd($request->itemid);
            Bedgets::whereIn('id', $request->itemid)->update([
                "approved" => 4
            ]);

            $notification = array(
                'message' => "Budget Deleted!",
                'alert-type' => 'info'
            );
            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
           $notification = array(
                'message' => $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
