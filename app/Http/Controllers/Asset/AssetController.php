<?php

namespace App\Http\Controllers\Asset;

use Carbon\Carbon;
use App\Models\Asset\Assets;
use Illuminate\Http\Request;
use App\Models\Asset\AssetType;
use App\Models\Asset\AssetSizes;
use App\Models\Asset\AssetValues;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Asset\AssetCategories;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function index(Request $request) {

        $categories = AssetCategories::all();
        $types = AssetType::all();
        $sizes = AssetSizes::all();
        $asset_values = AssetValues::all();
        $revenue_lines = DB::table('revenue_line')->where('type', 3)->get();

        // dd($request->query());
        $revenue_code = $request->query('revenue_code');
        $asset_type = $request->query('asset_type');
        $asset_category = $request->query('asset_category');
        $asset_size = $request->query('asset_size');
        $assest_name = $request->query('assest_name');
        $authority_document_ref_no = $request->query('authority_document_ref_no');
        $from = $request->query('from');
        $to = $request->query('to');
        $approvalLevels = $request->query('approvalLevels');


        if(groupId() == 3500 ) {
            $assets = Assets::latest()
            ->select('acct_assests.*', 'acct_assest_categories.assest_category', 'acct_assest_types.assest_type', 'acct_assest_sizes.assest_size', 'users.name' )
            ->leftJoin('acct_assest_categories', 'acct_assest_categories.assest_category_id', 'acct_assests.assest_category_id')
            ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
            ->leftJoin('acct_assest_sizes', 'acct_assest_sizes.id', 'acct_assests.assest_size_id')
            ->leftJoin('users', 'users.username', 'acct_assests.created_by')
            ->where('acct_assests.created_by', username())
            ->where('acct_assests.service_id', 37483)
            ->where('acct_assests.approved', 0)
            ->where('acct_assests.deleted', 0)
            ->when($revenue_code, function ($query, string $revenue_code) {
                $query->where('acct_assests.asset_rev', $revenue_code);
            })
            ->when($asset_category, function ($query, string $asset_category) {
                $query->where('acct_assests.assest_category_id', $asset_category);
            })
            ->when($asset_type, function ($query, string $asset_type) {
                $query->where('acct_assests.assest_type_id', $asset_type);
            })
            ->when($asset_size, function ($query, string $asset_size) {
                $query->where('acct_assests.assest_size_id', $asset_size);
            })
            ->when($assest_name, function ($query, string $assest_name) {
                $query->where('acct_assests.assest_name', 'like', "%{$assest_name}%");
            })
            ->when($from, function ($query, string $from) {
                $query->whereDate('acct_assests.created_at', '>=', $from);
            })
            ->when($to, function ($query, string $to) {
                $query->whereDate('acct_assests.created_at', '<=', $to);
            })
            ->when($approvalLevels, function ($query, string $approvalLevels) {
                $query->where('acct_assests.approved', $approvalLevels);
            })
            ->get();
        } else {
            $assets = Assets::latest()
            ->select('acct_assests.*', 'acct_assest_categories.assest_category', 'acct_assest_types.assest_type', 'acct_assest_sizes.assest_size', 'users.name' )
            ->leftJoin('acct_assest_categories', 'acct_assest_categories.assest_category_id', 'acct_assests.assest_category_id')
            ->leftJoin('acct_assest_types', 'acct_assest_types.id', 'acct_assests.assest_type_id')
            ->leftJoin('acct_assest_sizes', 'acct_assest_sizes.id', 'acct_assests.assest_size_id')
            ->leftJoin('users', 'users.username', 'acct_assests.created_by')
            ->where('acct_assests.service_id', 37483)
            ->where('acct_assests.approved', 0)
            ->where('acct_assests.deleted', 0)
            ->when($revenue_code, function ($query, string $revenue_code) {
                $query->where('acct_assests.asset_rev', $revenue_code);
            })
            ->when($asset_category, function ($query, string $asset_category) {
                $query->where('acct_assests.assest_category_id', $asset_category);
            })
            ->when($asset_type, function ($query, string $asset_type) {
                $query->where('acct_assests.assest_type_id', $asset_type);
            })
            ->when($asset_size, function ($query, string $asset_size) {
                $query->where('acct_assests.assest_size_id', $asset_size);
            })
            ->when($assest_name, function ($query, string $assest_name) {
                $query->where('acct_assests.assest_name', 'like', "%{$assest_name}%");
            })
            ->when($from, function ($query, string $from) {
                $query->whereDate('acct_assests.created_at', '>=', $from);
            })
            ->when($to, function ($query, string $to) {
                $query->whereDate('acct_assests.created_at', '<=', $to);
            })
            ->when($approvalLevels, function ($query, string $approvalLevels) {
                $query->where('acct_assests.approved', $approvalLevels);
            })
            ->get();
        }



        return view('AccAsset.acc_asset', compact('categories', 'types', 'sizes', 'asset_values', 'assets', 'revenue_lines'));

    }

    public function store(Request $request) {



        $request->validate([
            'revenue_code' => ['required', 'string'],
            'asset_type' => ['required', 'string'],
            'assest_name' => ['required', 'string'],
            // 'authority_document_ref_no' => ['required', 'string'],
            'date_purchased' => ['required', 'string'],
            'opening_value' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
            'asset_category'  => ['required', 'string'],
            'asset_size'  => ['required', 'string'],
        ]);

        $arr = explode(',', $request->revenue_code);
        // dd($arr);

        $carbon = Carbon::parse($request->date_purchased);
        $year = $carbon->format('Y');
        $month = $carbon->format('F');
        $day = $carbon->day;



        Assets::insert([
            'assest_type_id' => $request->asset_type,
            'assest_category_id' => $request->asset_category,
            'assest_size_id' => $request->asset_size,
            'assest_name' => $request->assest_name,
            'assest_decription' => $request->assest_decription,
            'date_purchased' => $request->date_purchased,
            'service_id' => 37483,
            'created_by' => auth()->user()->email,
            'opening_value' => $request->opening_value,
            'asset_rev_type' => $arr[2],
            'asset_rev_name' => $arr[0],
            'asset_rev' => $arr[1],
            'day'=> $day,
            'month' => $month,
            'year' => $year
        ]);

        $notification = array(
            'message' => 'Asset detail saved!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function update(Request $request) {

        // dd($request->all());
        $validateUser = Validator::make($request->all(), [
            'revenue_code' => ['required', 'string'],
            'asset_type' => ['required', 'string'],
            'assest_name' => ['required', 'string'],
            // 'authority_document_ref_no' => ['required', 'string'],
            'date_purchased' => ['required', 'string'],
            'opening_value' => ['required', 'regex:/^(\d+|\d+(\.\d{1,2})?|(\.\d{1,2}))$/'],
            'asset_category'  => ['required', 'string'],
            'asset_size'  => ['required', 'string'],
        ]);

        if($validateUser->fails()) {
            return redirect()->back()
            ->withErrors($validateUser->errors())
            ->withInput();
        }

        $arr = explode(',', $request->revenue_code);
        // dd($arr);
        $carbon = Carbon::parse($request->date_purchased);
        $year = $carbon->format('Y');
        $month = $carbon->format('F');
        $day = $carbon->day;


        Assets::where('assest_id', $request->id)->update([
            'assest_type_id' => $request->asset_type,
            'assest_category_id' => $request->asset_category,
            'assest_size_id' => $request->asset_size,
            // 'assest_location_id' => $request->
            'assest_name' => $request->assest_name,
            'assest_decription' => $request->assest_decription,
            'date_purchased' => $request->date_purchased,
            'service_id' => 37483,
            'created_by' => auth()->user()->email,
            'opening_value' => $request->opening_value,
            'asset_rev_type' => $arr[2],
            'asset_rev_name' => $arr[0],
            'asset_rev' => $arr[1],
            'day'=> $day,
            'month' => $month,
            'year' => $year
        ]);

        $notification = array(
            'message' => 'Changes saved',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    public function destroy($id) {
        // dd($id);
        Assets::where('assest_id', $id)->update([
            'deleted' => 1,
        ]);

        $notification = array(
            'message' => 'Record deleted',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function finalize(Request $request) {
        // dd($request->itemid);
        Assets::whereIn('assest_id', $request->itemid)->update([
            'approved' => 4
        ]);

        $notification = array(
            'message' => 'Record submitted',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
