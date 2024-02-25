<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request) {
        $user_role = $request->user_role;
        $name = $request->name;
        $email_phone = $request->email_phone;
        $from = $request->from;
        $to = $request->to;

        $users = DB::table('users')
        ->select('users.*', 'user_groups.group_name')
        ->leftJoin('user_groups', 'users.group_id', 'user_groups.group_id')
        ->when($user_role, function ($query, string $user_role) {
            $query->where('users.group_id', $user_role);
        })
        ->when($name, function ($query, string $name) {
            $query->where('users.name', 'like', "%{$name}%");
        })
        ->when($email_phone, function ($query, string $email_phone) {
            $query->where('phone', '=', $email_phone)
            ->orWhere('email', '=', $email_phone);
        })
        ->when($from, function ($query, string $from) {
            $query->whereDate('created_at', '>=', $from);
        })
        ->when($to, function ($query, string $to) {
            $query->whereDate('created_at', '<=', $to);
        })
        ->orderBy('users.id', 'desc')
        ->paginate(20);
        $groupId = DB::table('user_groups')->get();
        return view('User.create_user', compact('users', 'groupId'));
    }

    public function store(Request $request) {
        // dd($request->all());
        try {
            $this->validate($request, [
                'username' => 'required|min:3|unique:users,username',
                'user_role' => 'required|integer',
                'fullname' => 'required|string',
                // 'firstname' => 'required|string',
                // 'middlename' => 'nullable|string',
                'email' => 'required|string|email|max:255',
                'phone_number' => 'required|string|max:11',
            ]);


            User::insert([
                'username' => $request->username,
                'group_id' => $request->user_role,
                'name' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone_number,
                'password' => bcrypt("1234567")
            ]);

            $notification = array(
                'message' => 'User created!',
                'alert-type' => 'success'
            );

            // dd($notification);
            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }


    }


    public function update(Request $request) {

     try {
        // dd($request->all());
        $this->validate($request, [
            // 'username' => 'required|min:3|unique:users,username',
            'user_role' => 'required|integer',
            'fullname' => 'required|string',
            // 'firstname' => 'required|string',
            // 'middlename' => 'nullable|string',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:11',
        ]);

        $user = User::find($request->id);
        $user->group_id = $request->user_role;
        $user->name = $request->fullname;
        // $user->middlename = $request->middlename;
        $user->email = $request->email;
        $user->phone = $request->phone_number;
        // $user->updated_by = $request->updated_by;
        // $user->inactive = $request->inactive;
        $user->save();

        $notification = array(
            'message' => 'The user was successfully updated',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
     } catch (\Throwable $th) {
        dd($th);
     }

    }


    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete($id);

            $notification = array(
                'message' => 'The user has successfully been deleted.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } catch (\Exception $exception) {
            $notification = array(
                'message' => "Error. Unable to delete record. " . $exception->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
            // return redirect()->route('users.edit', $id)->with('error', "Error. Unable to delete record. " . $exception->errorInfo[2]);
        }
    }
}