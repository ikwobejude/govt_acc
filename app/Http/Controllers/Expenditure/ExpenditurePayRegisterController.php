<?php

namespace App\Http\Controllers\Expenditure;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureBatchName;
use App\Models\Expenditure\ExpenditureType;
use App\Models\Expenditure\ExpenditureRegister;
use App\Models\Revenue\RevenueLine;

class ExpenditurePayRegisterController extends Controller
{
    public function index()
    {
        // return view('Expenditure.view_expenditure_payregister');
        $months = DB::table('_months')->orderBy('month')->get();
        $expenditureType = RevenueLine::where('type', 2)->get();
        $batchName = ExpenditureBatchName::all();
        $ExpenditureRegister = ExpenditureRegister::where('service_id', 37483)->where('approved',0)->get();
        // dd($expenditureType);
        return view('Expenditure.expenditure_payregister', compact('ExpenditureRegister', 'months', 'expenditureType', 'batchName'));
    }


    public function store(Request $request) {
            $request->validate([
                'batch_type' => ['required', 'string'],
                'date' => ['required', 'string'],
                'name' => ['required', 'string'],
                'amount' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
                'narration' => ['required', 'string'],
                'expenditure_type' => ['required', 'string'],
            ]);

            $carbon = Carbon::parse($request->date);
            $year = $carbon->format('Y');
            $month = $carbon->format('F');

            $arr = explode(',', $request->expenditure_type);

            // dd( $arr);
            ExpenditureRegister::insert([
                'batch_name' => $request->batch_type,
                'approved_on' => $request->date,
                'expenditure_type' =>  $arr[2],
                'expenditure_code' =>  $arr[1],
                'expenditure_name' => $arr[0],
                'name' =>  $request->name,
                'amount' =>  $request->amount,
                'narration' =>  $request->narration,
                'service_id' => 37483,
                'created_by' => auth()->user()->email,
                'payment_ref' => $request->authority_document_ref_no,
                'month' => $month,
                'year' => $year
            ]);

            $notification = array(
                'message' => 'created successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    }


    public function expenditures()
    {
        // return view('Expenditure.view_expenditure_payregister');
        $expenditureType = ExpenditureType::all();
        $ExpenditureRegister = ExpenditureRegister::where('service_id', 37483)->where('approved',1)->get();
        // dd($expenditureType);
        return view('Voucher.view_expenditures', compact('ExpenditureRegister', 'expenditureType'));
    }

    public function expenditureVoucher(Request $request, $id)
    {
        // dd($id);
        $ExpenditureRegister = ExpenditureRegister::where('service_id', 37483)
        ->where('approved',1)
        ->where('idexpenditure_payregister', $id)
        ->first();
        // dd($ExpenditureRegister);
        return view('Receipts.voucher', compact('ExpenditureRegister'));
    }
}
