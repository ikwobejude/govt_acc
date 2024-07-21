<?php

namespace App\Http\Controllers\Expenditure;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Revenue\RevenueLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Expenditure\ExpenditureType;
use App\Models\Expenditure\ExpenditureRegister;
use App\Models\Expenditure\ExpenditureBatchName;

class ExpenditurePayRegisterController extends Controller
{
    public function index(Request $request)
    {
        // return view('Expenditure.view_expenditure_payregister');

        // dd($request->query());

        $expenditureType = $request->query('expenditureType');
        // dd($expenditureType);
        $from = $request->query("dateFrom");
        $to = $request->query('dateTo');
        $doc_ref_no = $request->query('document_ref_no');
        // $received_from = $request->query('received_from');
        $approvalLevels = $request->query('approvalLevels');
        $batchType = $request->query('batchType');
        $name = $request->query('name');

        $months = DB::table('_months')->orderBy('month')->get();
        $expenditureType = RevenueLine::where('type', 2)->get();
        $batchName = ExpenditureBatchName::all();

        if(groupId() == 3500 ) {
            $ExpenditureRegister = db::table('expenditure_payregister')
            ->select("expenditure_payregister.*", "users.name as user_name")
            ->leftJoin('users', 'users.username', 'expenditure_payregister.created_by')
            ->where('expenditure_payregister.service_id', 37483)
            ->where('expenditure_payregister.created_by', username())
            ->where('expenditure_payregister.deleted', 0)
            ->where('expenditure_payregister.approved', 0)
            ->when(!empty($name), function ($query) use ($name) {
                return $query->where('name', 'like', "%{$name}%");
            })
            ->when(!empty($batchType), function ($query) use ($batchType) {
                return $query->where('batch_name', '=', $batchType);
            })
            ->when(!empty($doc_ref_no), function ($query) use ($doc_ref_no) {
                return $query->where('payment_ref', '=', $doc_ref_no);
            })
            ->when(!empty($approvalLevels), function ($query) use ($approvalLevels) {
                return $query->where('approved', '=', $approvalLevels);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('created_at', '>=', $from);
            })
            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('created_at', '<=', $to);
            })
            ->orderBy('expenditure_name', 'ASC')
            ->get();
        } else {
            $ExpenditureRegister = db::table('expenditure_payregister')
            ->select("expenditure_payregister.*", "users.name as user_name")
            ->leftJoin('users', 'users.username', 'expenditure_payregister.created_by')
            ->where('expenditure_payregister.service_id', 37483)
            ->where('expenditure_payregister.deleted', 0)
            ->where('expenditure_payregister.approved', 0)
            ->when(!empty($name), function ($query) use ($name) {
                return $query->where('name', 'like', "%{$name}%");
            })
            ->when(!empty($batchType), function ($query) use ($batchType) {
                return $query->where('batch_name', '=', $batchType);
            })
            ->when(!empty($doc_ref_no), function ($query) use ($doc_ref_no) {
                return $query->where('payment_ref', '=', $doc_ref_no);
            })
            ->when(!empty($approvalLevels), function ($query) use ($approvalLevels) {
                return $query->where('approved', '=', $approvalLevels);
            })
            ->when(!empty($from), function ($query) use ($from) {
                return $query->whereDate('created_at', '>=', $from);
            })
            ->when(!empty($to), function ($query) use ($to) {
                return $query->whereDate('created_at', '<=', $to);
            })
            ->orderBy('expenditure_name', 'ASC')
            ->get();
        }

        // dd($ExpenditureRegister);
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
            $day = $carbon->day;

            $arr = explode(',', $request->expenditure_type);

            // dd( $arr);
            ExpenditureRegister::insert([
                'batch_name' => $request->batch_type,
                'drafted_on' => $request->date,
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
                'year' => $year,
                'day' => $day
            ]);

            $notification = array(
                'message' => 'created successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    }

    public function update(Request $request) {
        // dd($request->all());
        $validateUser = Validator::make($request->all(), [
            'batch_type' => ['required', 'string'],
            'date' => ['required', 'string'],
            'name' => ['required', 'string'],
            'amount' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
            'narration' => ['required', 'string'],
            'expenditure_type' => ['required', 'string'],
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

        $carbon = Carbon::parse($request->date);
        $year = $carbon->format('Y');
        $month = $carbon->format('F');
        $day = $carbon->day;

        $arr = explode(',', $request->expenditure_type);

        // dd( $arr);
        ExpenditureRegister::where('idexpenditure_payregister', $request->id)->update([
            'batch_name' => $request->batch_type,
            'drafted_on' => $request->date,
            'expenditure_type' =>  $arr[2],
            'expenditure_code' =>  $arr[1],
            'expenditure_name' => $arr[0],
            'name' =>  $request->name,
            'amount' =>  $request->amount,
            'narration' =>  $request->narration,
            'service_id' => 37483,
            'created_by' => emailAddress(),
            'payment_ref' => $request->authority_document_ref_no,
            'month' => $month,
            'year' => $year,
            'day' => $day
        ]);

        $notification = array(
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
}

public function destroy($id) {

    // dd( $arr);
    ExpenditureRegister::where('idexpenditure_payregister', $id)->update([
        'deleted' => 1
    ]);

    $notification = array(
        'message' => 'Deleted',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
}


    public function expenditures(Request $request)
    {
        // return view('Expenditure.view_expenditure_payregister');
        $expenditureType = ExpenditureType::all();
        //TODO
        //

        $from = $request->query("dateFrom");
        $to = $request->query('dateTo');
        $doc_ref_no = $request->query('document_ref_no');
        // $received_from = $request->query('received_from');
        $approvalLevels = $request->query('approvalLevels');
        $batchType = $request->query('batchType');
        $name = $request->query('name');

        $ExpenditureRegister = ExpenditureRegister::where('service_id', 37483)
        ->where('approved',1)
        ->when(!empty($name), function ($query) use ($name) {
            return $query->where('name', 'like', "%{$name}%");
        })
        ->when(!empty($batchType), function ($query) use ($batchType) {
            return $query->where('batch_name', '=', $batchType);
        })
        ->when(!empty($doc_ref_no), function ($query) use ($doc_ref_no) {
            return $query->where('payment_ref', '=', $doc_ref_no);
        })
        ->when(!empty($approvalLevels), function ($query) use ($approvalLevels) {
            return $query->where('approved', '=', $approvalLevels);
        })
        ->when(!empty($from), function ($query) use ($from) {
            return $query->whereDate('created_at', '>=', $from);
        })
        ->when(!empty($to), function ($query) use ($to) {
            return $query->whereDate('created_at', '<=', $to);
        })
        ->orderBy('expenditure_name', 'ASC')
        ->get();
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

    public function finalize(Request $request)
    {
        ExpenditureRegister::whereIn('idexpenditure_payregister', $request->itemid)->update([
            'approved' => 4
        ]);

        $notification = array(
            'message' => 'Record(s) successfully submitted',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
