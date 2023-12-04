<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
     public function show_privacy()
     {
        return view('privacy-policy.index');
     }

     public function termsAndConditions()
     {
         return view('terms-and-conditions.index');
     }
}
