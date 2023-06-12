<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::select('id','name','age','mobile','city','country')->get();
        $res = [
            'error' =>false,
            'user' => $users,

        ];

        return response()->json($res, 200);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'age'=>'required',
            'mobile'=>'required',
            'city'=>'required',
            'country'=>'required',

        ]);

        try{

            $user = User::create([
                'email' => $request->email,
                'name' => $request->name,
                'city' => $request->city,
                'age' => $request->age,
                'password' => '12345678',
                'mobile' => $request->mobile,
                'country' => $request->country,
            ]);

            $res = [
                'error' =>false,
                'user' => $user,

            ];

            return response()->json($res, 200);
        }catch(\Exception $e){
            \Log::error($e->getMessage());
            $res = [
                'error' =>true,
                'user' => $user,
                'message' => 'somethingwenr wrong'
            ];

            return response()->json($res, 200);
        }
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {

    }
    public function update_user(Request $request, string $id)
    {
        $request->validate([
            'email'=>'required',
            'name'=>'required',
            'age'=>'required',
            'mobile'=>'required',
            'city'=>'required',
            'country'=>'required'
        ]);

        try{

            $user = User::where('id',$id)->update([
                'name' => $request->name,
                'city' => $request->city,
                'age' => $request->age,
                'mobile' => $request->mobile,
                'country' => $request->country,
            ]);
            $res = [
                'error' =>true,
                'user' => $user,

            ];

            return response()->json($res, 200);

        }catch(\Exception $e){
            \Log::error($e->getMessage());
            $res = [
                'error' =>true,
                'user' => $user,
                'message' => 'somethingwenr wrong'
            ];

            return response()->json($res, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete_user(string $id)
    {
        $user = User::find($id);
        if(!empty($user)){
                $user->delete();
                $res = [
                    'error' =>false,

                    'message' => 'delete successfullu'
                ];

                return response()->json($res, 200);
        }
        else{
            $res = [
                'error' =>true,

                'message' => 'something went wrong'
            ];

            return response()->json($res, 200);
        }
    }
}
