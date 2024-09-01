<?php

namespace App\Http\Controllers\Liability;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Liability\LiabilityType;

class LiabilityTypeController extends Controller
{
    //
    public function index(Request $request) {
        $liability_type = DB::table('liability_type')->get();
        return view('Liability.liability_type', compact('liability_type'));
    }

    public function create(Request $request) {
         // dd($request->all());
        $request->validate([
        'type' => ['required', 'string'],
        ]);

        DB::table('liability_type')->insert([
        'type' => $request->type,
        'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Created',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function edit(Request $request) {
        // dd($request->all());
       $request->validate([
       'type' => ['required', 'string'],
       ]);


       $type = LiabilityType::find($request->id);

       $type->update([
           'type' => $request->type,
           'description' => $request->description
       ]);

       $notification = array(
           'message' => 'Created',
           'alert-type' => 'success'
       );

       return redirect()->back()->with($notification);
    }


    public function destroy($id) {

       LiabilityType::where('id', $id)->delete();
       $notification = array(
           'message' => 'Deleted',
           'alert-type' => 'Updated'
       );

       return redirect()->back()->with($notification);
    }
}
