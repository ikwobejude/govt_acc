<?php

namespace App\Http\Controllers\Expenditure;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Expenditure\ExpenditureBatchName;

class ExpenditureBatchNameController extends Controller
{
    public function index(Request $request) {
        $batch_names = ExpenditureBatchName::all();
        return view('Expenditure.expenditure_batch_name', compact('batch_names'));
    }

    public function store(Request $request){
        $validateUser = Validator::make($request->all(), [
            'batch_name' => ['required', 'string']
        ]);



        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

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

    public function destroy($id) {
        
        $name = ExpenditureBatchName::find($id);
        $name->delete();

        $notification = array(
            'message' => 'Expenditure Batch Name Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
