<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class NoteControllers extends Controller
{
    public function notes(Request $request){
        $notes = DB::table("notes")->paginate(20);
        return view('Settings.notes', compact('notes'));
    }

    // create note
    public function create(Request $request) {
        // dd($request->all());
        try {
            $validateUser = Validator::make($request->all(), [
                'note_name' => ['required', 'string'],
                'note_code' => ['required', 'numeric'],
                'description' => ['required', 'string'],
            ]);


            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }



            if(explode(" ", $request->note_name)[1] != $request->note_code) {
                throw new \Exception('Note name does not match not code');
            }

            DB::table("notes")->insert([
                "note_name" => $request->note_name,
                "note_code" => $request->note_code,
                "description" => $request->description
            ]);

            $notification = array(
                'message' => 'Note created',
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


    public function edit(Request $request) {
        try {
            $validateUser = Validator::make($request->all(), [
                'note_name' => ['required', 'string'],
                'note_code' => ['required', 'numeric'],
                'description' => ['required', 'string'],
            ]);
            if($validateUser->fails()) {
                return redirect()->back()
                ->withErrors($validateUser->errors())
                ->withInput();
            }

            if(explode(" ", $request->note_name)[1] != $request->note_code) {
                throw new \Exception('Note name does not match not code');
            }
            // $d = now();
            DB::table("notes")
            ->where('id', $request->id)
            ->update([
                "note_name" => $request->note_name,
                "note_code" => $request->note_code,
                "description" => $request->description
            ]);

            $notification = array(
                'message' => 'Note Update!',
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


    public function destroyNote($id) {
        DB::table('notes')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Note deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
