<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Pay_Plan;
use Carbon\Carbon;

class AdminController extends Controller
{   
   
    public function index()
    {
        $title = 'Subcription Service';
        if(auth()->user()->assign_role == 1 && auth()->user()->user_type == "admin"){
            return view('admin.dashboard.index',compact('title'));
        }
        elseif(auth()->user()->assign_role == 2 && auth()->user()->user_type == "company"){
            $now = Carbon::now();
            $order = Auth::user()->order;
            if(empty($order)){
                return redirect()->route('admin.plan');
            }
            elseif($order->expiry_date >= $now){
                return view('admin.dashboard.index',compact('title'));
            }
            else{
                Auth::logout();
                return redirect('/');
            }
        }
        else{
            Auth::logout();
            return redirect('/');
        }
       
    }

    public function getPlan(){

        $plans = Pay_Plan::latest()->get()->toArray();
        return view('paypal.plans',compact('plans'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }


    public function edit(){
        $user = Auth::user();
        return view('admin.settings.edit', ['title' => 'Edit Admin Profile','user'=>$user]);
    }

    
    public function update(Request $request)
    {
        $admin = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|unique:users,email,'.$admin->id,
            'profile_pic' => 'mimes:jpeg,png,jpg,gif',
        ]);
        $input = $request->all();
        if (empty($input['password'])) {
            $input['password'] = $admin->password;
        } else {
            $input['password'] = bcrypt($input['password']);
        }
        if ($request->hasFile('profile_pic')) {
			if ($request->file('profile_pic')->isValid()) {
				$this->validate($request, [
					'profile_pic' => 'required|mimes:jpeg,png,jpg'
				]);
				$file = $request->file('profile_pic');
				$destinationPath = public_path('/uploads');
				//$extension = $file->getProductOriginalExtension('logo');
				$thumbnail = $file->getClientOriginalName('profile_pic');
				$thumbnail = rand() . $thumbnail;
				$request->file('profile_pic')->move($destinationPath, $thumbnail);
				$input['profile_pic'] = $thumbnail;
			}
		}
        $admin->fill($input)->save();
        Session::flash('success_message', 'Great! admin successfully updated!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
