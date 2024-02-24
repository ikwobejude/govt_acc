<?php

namespace App\Http\Controllers\Budgeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
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
        $budges = DB::table('acct_budgets')
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
        return view('Budget.budget', compact('budges'));
    }

    public function store(Request $request) {
        try {
            // dd($request->all());
            $this->validate($request, [
                'budgetType' => 'required|integer',
                'economicCode' => 'required|string',
                'project' => 'required|string',
                'current_budget' => 'required|string',
            ]);

            $arr = explode(',', $request->economicCode);

            DB::table('acct_budgets')->insert([
                "budget_type" => $request->budgetType,
                "economic_code" => $arr[1],
                "line" => $arr[2],
                "economic_type" => $arr[0],
                "found_source" => ($request->budgetType == 2 ? "02101" :
                                  ($request->budgetType == 3 ? "02201" : "03101" )),
                "project" => $request->project,
                "current_budget" => $request->current_budget
            ]);

            $notification = array(
                'message' => "Budget added!",
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
}
