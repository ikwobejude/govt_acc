<?php

namespace App\Http\Controllers\FinalAccount;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Expenditure\ExpenditureBatchName;

class GeneralLedgerController extends Controller
{

    public function generalLedger(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from") ? $request->query("from") :  firstDay();
        $to = $request->query('to') ? $request->query('to') : lastDay();
        $currentT = $request->query("from") ? 1 : 2;
        $expenditureType = RevenueLine::get();
        $batchName = ExpenditureBatchName::all();

        // Revenue
        $revenue = DB::table('acc_revenue')
        ->selectRaw('created_at, description as narration, SUM(revenue_amount) as amount, revenue_line as economic_name, revenue_code as economic_code')
        ->where('service_id', 37483)
        ->where('approved', 2)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('revenue_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->groupBy('revenue_code')
        ->orderBy('revenue_line', 'ASC')
        ->get();

        $liabilities = DB::table('liabilities')
        ->selectRaw('created_at, narration, SUM(amount) AS amount, economic_name, economic_code')
        // ->where('service_id', 37483)
        ->where('approved', 2)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('economic_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->groupBy('economic_code')
        ->orderBy('economic_code', 'ASC')
        ->get();

        $ExpenditureRegister = DB::table('expenditure_payregister')
        ->selectRaw('created_at, narration, SUM(amount) AS amount, expenditure_name as economic_name, expenditure_code as economic_code')
        ->where('service_id', 37483)
        ->where('approved', 2)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('expenditure_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->groupBy('expenditure_code')
        ->orderBy('expenditure_name', 'ASC')
        ->get();

        $assests = DB::table('acct_assests')
        ->selectRaw('created_at, assest_decription as narration, SUM(opening_value) as amount, asset_rev_name as economic_name, asset_rev as economic_code')
        ->where('service_id', 37483)
        ->where('approved', 2)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('asset_rev_name', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('created_at', '<=', $to);
        })
        ->groupBy('asset_rev')
        ->orderBy('asset_rev_name', 'ASC')
        ->get();

        return view('GeneralLedger.general_ledge', compact('expenditureType', 'batchName', 'revenue', 'liabilities', 'ExpenditureRegister', 'assests', 'currentT'));
    }

    public function payable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');

        // Expenditures
        $account_payable = DB::table('account_payable')
        ->select('account_payable.*', 'users.name')
        ->leftJoin('users', 'users.username', 'account_payable.created_by')
        ->where('account_payable.service_id', 37483)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('account_payable.expenditure_code', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('account_payable.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('account_payable.created_at', '<=', $to);
        })
        ->orderBy('account_payable.payid', 'DESC')
        ->get();

        // dd($account_payable);
        return view('GeneralLedger.payable', compact('account_payable'));
    }

    public function storePayable(Request $request) {
        try {
            // dd($request->all());
            $validateUser = Validator::make($request->all(), [
                'vendor' => ['required', 'string'],
                'payable_to' => ['required', 'string'],
                'payable_amount' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
                'due_date' => ['required', 'string'],
                'description' => ['required', 'string'],
            ]);

            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }

            DB::table('account_payable')->insert([
                "vendor" => $request->vendor,
                "payable_to" => $request->payable_to,
                "payable_amount" => $request->payable_amount,
                "due_date" => $request->due_date,
                "narration" => $request->description,
                "service_id" => 37483,
                "created_by" => emailAddress()
            ]);

            $notification = array(
                'message' => 'saved!',
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

    public function accountReceivable(Request $request) {
        $economicCode = $request->query('revenue_code');
        $from = $request->query("from");
        $to = $request->query('to');

        // $revenue_lines  = RevenueLine::where('type', 1)->get();
        $receivables = DB::table('account_receivable')
        ->select('account_receivable.*', 'users.name')
        ->leftJoin("users", "users.username", "account_receivable.created_by")
        ->where('account_receivable.service_id', 37483)
        ->when(!empty($economicCode) , function ($query) use ($economicCode) {
            return $query->where('account_receivable.vendor', $economicCode);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('account_receivable.created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
           return $query->whereDate('account_receivable.created_at', '<=', $to);
        })
        ->orderBy('accid', 'DESC')
        ->get();

        return view('GeneralLedger.receivable', compact('receivables'));
    }

    public function storeReceivables(Request $request) {
        try {
            // dd($request->all());
            $validateUser = Validator::make($request->all(), [
                'receivable_from' => ['required', 'string'],
                'amount' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
                'due_date' => ['required', 'string'],
                'description' => ['required', 'string'],
            ]);

            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }

            DB::table('account_receivable')->insert([
                "receivable_from" => $request->receivable_from,
                "receivable_amount" => $request->amount,
                "due_date" => $request->due_date,
                "narration" => $request->description,
                "service_id" => 37483,
                "created_by" => emailAddress()
            ]);

            $notification = array(
                'message' => 'saved!',
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
}
