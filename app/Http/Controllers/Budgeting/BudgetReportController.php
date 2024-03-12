<?php

namespace App\Http\Controllers\Budgeting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BudgetReportController extends Controller
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
        ->selectRaw('
        acct_budgets.budget_type as budget_type,
        acct_budgets.economic_code as economic_code,
        acct_budgets.line as line,
        acct_budgets.project as project,
        acct_budgets.economic_type as economic_type,
        acct_budgets.found_source as found_source,
        acct_budgets.region as region,
        acct_budgets.approved as approved,
        acct_budgets.current_budget as current_budget,
        expenditure_payregister.expenditure_code,
        sum(expenditure_payregister.amount) as amount')
        ->leftJoin('expenditure_payregister', 'expenditure_payregister.expenditure_code', 'acct_budgets.economic_code')
        // ->where('expenditure_payregister.expenditure_type', 2)
        ->where('acct_budgets.budget_type', 2)

        ->groupBy('expenditure_payregister.expenditure_code')
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

        // dd($budges);
        return view('Budget.budget_report', compact('budges'));
    }

    public function overhead(Request $request) {

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
        ->selectRaw('
        acct_budgets.budget_type as budget_type,
        acct_budgets.economic_code as economic_code,
        acct_budgets.line as line,
        acct_budgets.project as project,
        acct_budgets.economic_type as economic_type,
        acct_budgets.found_source as found_source,
        acct_budgets.region as region,
        acct_budgets.approved as approved,
        acct_budgets.current_budget as current_budget,
        acct_assests.asset_rev as economic_code,
        sum(acct_assests.opening_value) as amount')
        ->leftJoin('acct_assests', 'acct_assests.asset_rev', 'acct_budgets.economic_code')
        ->where('acct_assests.approved', 2) // approved
        ->where('acct_budgets.economic_type', 3)
        ->where('acct_budgets.budget_type', 3)

        ->groupBy('acct_assests.asset_rev')
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

        // dd($budges);
        return view('Budget.budget_report', compact('budges'));
    }



    public function capital(Request $request) {

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
        ->selectRaw('
        acct_budgets.budget_type as budget_type,
        acct_budgets.economic_code as economic_code,
        acct_budgets.line as line,
        acct_budgets.project as project,
        acct_budgets.economic_type as economic_type,
        acct_budgets.found_source as found_source,
        acct_budgets.region as region,
        acct_budgets.approved as approved,
        acct_budgets.current_budget as current_budget,
        liabilities.economic_code,
        sum(liabilities.amount) as amount')
        ->leftJoin('liabilities', 'liabilities.economic_code', 'acct_budgets.economic_code')
        ->where('liabilities.approved', 2) // approved
        ->where('acct_budgets.economic_type', 3)
        ->where('acct_budgets.budget_type', 3)

        ->groupBy('liabilities.economic_code')
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

        // dd($budges);
        return view('Budget.budget_report', compact('budges'));
    }




}
