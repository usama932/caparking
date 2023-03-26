<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Auth;

class RegisterController extends Controller
{
    

    use RegistersUsers;

  
    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

  
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => '1',
			'assign_role' => '2',
			'user_type' => 'company',
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => '1',
			'assign_role' => '2',
			'user_type' => 'company',
        ]);
        $user->assignRole('company');
        
        if(!empty($user)){
            if(auth()->attempt(array('email' => $user->email, 'password' => $request->password)))
            {
              
                if (auth()->user()->is_admin == '1' && auth()->user()->assign_role == '2') {
                  
                    return redirect()->route('admin.dashboard');
                }
                
                else{
                   
                    return redirect()->route('client.dashboard');
                }
            }else{
    
                return redirect()->route('login')
                    ->with('error','Authentication Failed. Email or Password Is Invalid.');
            }
           }
        }
}
