<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;
use App\Traits\ValidationErrorTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    use ValidationErrorTrait;
    public function addAddress(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [

            'name' => 'required',
            'phone_number' => 'required',
            'title' => 'required',
            'pincode' => 'required',
            'city' => 'required',
            'location' => 'required',
           

        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        $users = new Address();
        $users->name = $request->get('name');
        $users->phone_number = $request->get('phone_number');
        $users->user_id = Auth::id();
        $users->pincode = $request->get('pincode');
        $users->city = $request->get('city');
        $users->title = $request->get('title');
        $users->location = $request->get('location');
        $users->country_code=$request->get('country_code');
        $users->save();
        $user = Address::where('id', $users->id)->first();
        return response(['statusCode' => 200, 'message' => 'data inserted Successfully.', 'data' => $user]);
}
public function get_address(){
    $id=Auth::id();
    $data=Address::where('user_id',$id)->where('status',0)->get();
    return response()->json(['statusCode' => 200, 'message' => 'address feteched successfully','data'=>$data]);
}
public function editAddress(Request $request)
{
    $data = $request->all();
    $validator = Validator::make($data, [

        'id' => 'required',

    ]);

    if ($validator->fails()) {
        $messages = implode(",", $this->errorMessages($validator->errors()));
        return response(['statusCode' => 400, 'message' => $messages]);
    }
    
    $users =  Address::where('id',$request->id)->first();
    if(empty($users)){
        return response(['statusCode' => 400, 'message' => 'address not found.']);
    }
    $users->name = $request->get('name');
    $users->phone_number = $request->get('phone_number');
    $users->user_id = Auth::id();
    $users->pincode = $request->get('pincode');
    $users->city = $request->get('city');
    $users->title = $request->get('title');
    $users->location = $request->get('location');
    $users->save();
    $user = Address::where('id', $request->id)->first();
    return response(['statusCode' => 200, 'message' => 'data updated Successfully.', 'data' => $user]);
}
public function deleteAddress(Request $request)
{
    $data = $request->all();
    $validator = Validator::make($data, [

        'id' => 'required',

    ]);

    if ($validator->fails()) {
        $messages = implode(",", $this->errorMessages($validator->errors()));
        return response(['statusCode' => 400, 'message' => $messages]);
    }
    $users =  Address::find($request->id);
      
    if(empty($users)){
        return response(['statusCode' => 400, 'message' => 'address not found.']);
    }
    $users->status=1;
    $users->update();

    return response(['statusCode' => 200, 'message' => 'data updated Successfully.', 'data' => $users]);
}
}