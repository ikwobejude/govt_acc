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
        return view('Budget.budget_report', compact('budges'));
    }


}
