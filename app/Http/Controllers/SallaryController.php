<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sallary;

use Illuminate\Support\Facades\Validator;

class SallaryController extends Controller
{
    //
    public function show_sallary(){
        $workers=Sallary::all();
        return view('sallary.index',compact('workers'));
    }

    public function add_worker(Request $request){
      
       
    
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'sallary' => 'required',

              
                // 'description' => 'required',
               
             
            ]);
            if ($validator->fails())
            {
              return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
            }
            $users = new sallary();
            $users->name = $request->name;
            $users->sallary = $request->sallary;

          
    
    
            $users->status=1;;
        
          
    
            $users->save();
            return redirect('sallary_manage');
        
    }
}
