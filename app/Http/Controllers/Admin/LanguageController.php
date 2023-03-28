<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request)
    {
        
        $locale = $request->input('locale');
       
        App::setLocale($locale);
        setlocale(LC_TIME, $locale.'.UTF-8');

        Session::put('locale', $locale);       
        return redirect()->back();
      

    }
}
