<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Traits\ValidationErrorTrait;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\wallet;

class StoreController extends Controller
{
    use ValidationErrorTrait;

     public function store_used_points(Request $request){
        
        $data = json_decode($request->getContent(), true);
        $validator = Validator::make($data, [
            'user_id' => 'required',
            'points' =>'required'
            
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        $user=wallet::where('user_id',$request->user_id)->first();

        $user_points=$user->points;
        
        $total_points=$user_points-$request->points;
    
        $user->points=$total_points;
        $user->update();
        return response(['statusCode' => 200, 'message' => 'data feteched successfully!', 'data' => $user]);

     }
}
