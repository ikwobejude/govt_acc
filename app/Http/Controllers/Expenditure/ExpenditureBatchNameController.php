<?php

namespace App\Http\Controllers\Expenditure;

use App\Http\Controllers\Controller;
use App\Models\Expenditure\ExpenditureBatchName;
use Illuminate\Http\Request;

class ExpenditureBatchNameController extends Controller
{
    public function index(Request $request) {
        $batch_names = ExpenditureBatchName::all();
        return view('Expenditure.expenditure_batch_name', compact('batch_names'));
    }

    public function store(Request $request){
        $request->validate([
            'batch_name' => ['required', 'string']
        ]);

        ExpenditureBatchName::create([
            "name" => $request->batch_name,
            "created_by" => auth()->user()->email,
            'service_id' => 37483,
        ]);

        $notification = array(
            'message' => 'Expenditure Batch Name Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
