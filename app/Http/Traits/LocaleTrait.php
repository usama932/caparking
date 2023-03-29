<?php
namespace App\Http\Traits;

trait LocaleTrait {
    public function index($locale) {
        if(!empty(Session::get('locale'))) 
        {
           $locale =  app()->setLocale(Session::get('locale'));
        }
                
        else{
            $locale = app()->setLocale('en');
        }
        return $locale;
    }
}