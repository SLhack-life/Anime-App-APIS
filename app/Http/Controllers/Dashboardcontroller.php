<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Dashboardcontroller extends Controller
{
    //
    public function dashboard(Request $request)
    {
        $total_users=User::where('role',1)->where('is_store',0)->count();
        $users_active=User::where('status',1)->where('role',1)->where('is_store',0)->count();
        $users_inactive=User::where('status',0)->where('role',1)->count();
        // $total_orders=Order::all()->count();
        // $completed_order=Order::where('status',3)->count();
        // $rejected_order=Order::where('status',6)->count();
        $users_total = User::select('id', 'created_at')
        ->where('role', 1)
        ->where('is_store', 0)
        ->get()
        ->groupBy(function ($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

    $usermcount = [];
    $userArr = [];

    foreach ($users_total as $key => $value) {
        $usermcount[(int)$key] = count($value);
    }

    for ($i = 1; $i <= 12; $i++) {
        if (!empty($usermcount[$i])) {
            $userArr[$i] = $usermcount[$i];
        } else {
            $userArr[$i] = 0;
        }
    }

    $jan_arr = $userArr[1];
    $feb_arr = $userArr[2];
    $mar_arr = $userArr[3];
    $apr_arr = $userArr[4];
    $may_arr = $userArr[5];
    $june_arr = $userArr[6];
    $july_arr = $userArr[7];
    $aug_arr = $userArr[8];
    $sept_arr = $userArr[9];
    $oct_arr = $userArr[10];
    $nov_arr = $userArr[11];
    $dec_arr = $userArr[12];
    
       
        return view('dashboard.dashboard',compact('users_active','users_inactive','total_users','jan_arr',
        'feb_arr','mar_arr','apr_arr','may_arr','june_arr','july_arr','aug_arr'
        ,'sept_arr','oct_arr','nov_arr','dec_arr'
    ));
    }
}
