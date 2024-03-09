<?php

namespace App\Http\Controllers\Uploads;

use Illuminate\Http\Request;
use App\Imports\RevenueUpload;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class RevenueUploadController extends Controller
{
    public function import(Request $request)
    {
        try {
            // Validate the uploaded file
            // dd($request->file('file'));
            $validateUser = Validator::make($request->all(), [
                'file' => 'required|mimes:xlsx,xls',
            ]);

            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }

            // Get the uploaded file
            $file = $request->file('file');

            // dd($file);

            // Process the Excel file
            $rec = Excel::toArray(new RevenueUpload, $file);
            // dd($rec);
            $data = [];
            if (count($rec[0]) > 0) {

                foreach ($rec[0] as $row) {
                    $data[] = [
                        'economic_code' => $row['economic_code'],
                        'description' => $row['description'],
                        'type' => $row['code'],
                    ];
                }

                DB::table('revenue_line')->insertOrIgnore($data);
                $notification = array(
                    'message' => 'Uploaded',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with($notification);
            } else {
                $notification = [
                    'message' => 'Excel file is empty',
                    'alert-type' => 'error'
                ];
                return redirect()->back()->with($notification);
            }

        } catch (\Throwable $th) {
            // dd($th);
            $notification = array(
                'message' => $th->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }
}
