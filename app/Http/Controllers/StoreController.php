<?php

namespace App\Http\Controllers;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Traits\ValidationErrorTrait;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Validator;

class StoreController extends Controller
{
    use ValidationErrorTrait;

   public function stores_list(Request $request){
    $data=User::where('role',2)->get();
    if ($request->ajax()) {
            
        //    $products=Product::all();
            
           
            // foreach ($products as $product) {
            //     $product->category_name = Category::where('id', $product->category_id)->pluck('')
            // }
            // dd($data);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = "<a data-id='$row->id' data-bs-target='#edit_store' data-bs-toggle='modal' class='edit btn btn-primary btn-sm' onclick='edit_store($row->id)'>edit</a>";
     
                            return $btn;
                    })
                    ->addColumn('delete', function($row){
   
                        $btn = "<a data-id='$row->id' data-bs-target='#edit_store' data-bs-toggle='modal' class='edit btn btn-primary btn-sm' onclick='edit_store($row->id)'>delete</a>";
  
                         return $btn;
                 })
                    ->rawColumns(['action','delete'])
                    ->make(true);
        }
      
       return view('stores.index');
   }
   public function add_store(Request $request){
    $validator = Validator::make($request->all(),[
        'store_name' => 'required',
         'store_email'=>'required|unique:users,email',
         'store_password' => 'required',   
    ]);
    if ($validator->fails())
    {
      return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
    }
    $users = new User();
    $users->email = $request->get('store_email');
    // $users->user_name = $request->get('store_email');
    $users->store_name = $request->get('store_name');
    $users->password = bcrypt($request->get('store_password'));
    $users->role =2;
    $users->is_verified =1;

   
    // $users->is_store=1;
    // $users->email= $request->get('store_email');
    
    $users->save();
    return redirect()->route('stores_list');

   }

   public function  edit_store(Request $request){
    $id=$request->id;

    $data=User::where('id',$id)->first();
    if(!empty($data)){
        return response()->json(['status' => 200,'message'=>"data fetched successfully!",'data'=>$data]);
    }
    return response()->json(['status' => 200,'data'=>$data]);
  
   }

   public function update_store(Request $request){
    $validator = Validator::make($request->all(),[
        'store_name' => 'required',
         'email'=>'required',
        
    ]);
    if ($validator->fails())
    {
      return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
    }
    $users =User::find($request->store_id);
    $users->email = $request->get('email');
    // $users->user_name = $request->get('store_email');
    $users->store_name = $request->get('store_name');
    $users->password = bcrypt($request->get('store_password'));
    $users->is_store=1;
    $users->save();
    
    return response()->json(['status' => 200, 'data'=>$users]);
   }
}
