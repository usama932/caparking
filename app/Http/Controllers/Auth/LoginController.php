<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
      
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',

        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.dashboard');
            }
            elseif(auth()->user()->is_admin == 0  && auth()->user()->assign_role == 2){

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
