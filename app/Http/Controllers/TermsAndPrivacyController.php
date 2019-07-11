<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TermsAndPrivacyController extends Controller
{

   public function privacy()
    {
        return view('privacy');
    }

   public function tos()
    {
        return view('termsofservice');
    }    

}
