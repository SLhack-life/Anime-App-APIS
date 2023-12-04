<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Category::all();
        return view('categories.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            // 'image' => 'required',
            // 'description' => 'required',
           
         
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        $users = new category;
        $users->name = $request->name;
        $users->description = $request->description;
        $users->status=$request->status;
        if(!empty($request->image)){
            $file_name = $request->file('image');
            $image_Name= time().'.'.$file_name->getClientOriginalName();
            $file_name->move(public_path('uploads/category'), $image_Name);
            $users->image= $image_Name;
        }
      

        $users->save();
        return response()->json(['status' => 200,'message'=>"data insert successfully!"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category=Category::where('id',$id)->first();
        return view('categories.view',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_category(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        
           
         
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        $users =category::where('id',$request->category_id)->first();
        $users->name = $request->name;
        $users->description = $request->description;
        $users->status=$request->status;
        if(!empty($request->image)){
            $file_name = $request->file('image');
            $image_Name= time().'.'.$file_name->getClientOriginalName();
            $file_name->move(public_path('uploads/category'), $image_Name);
            $users->image= $image_Name;
        }
      

        $users->save();
        return response()->json(['status' => 200,'message'=>"data insert successfully!"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function delete_category(Request $request){
    $id=$request->id;
    
        $data=Category::where('id',$id)->first();
        $data->status=0;
        $data->save();
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data]);
   }
   public function edite(Request $request){
    $id=$request->id;

    $data=Category::where('id',$id)->first();
    return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data]);

    
 
   }
//     public function add_product_data(Request $request){
//             $data = $request->all();
          
//             $validated = $request->validate([
//                 'name' => 'required',
//                 'status' => 'required',
//                 'descripition' => 'required',
//                 'profile_image' => 'required',
                
                
//             ]);

//             $users = new Categorys();
//             $users->name = $request->get('name');
//             $users->description = $request->get('descripition');
//             $users->status = $request->get('status');
//             if(!empty($request->profile_image)){
//                 $file_name = $request->file('profile_image');
//                 $image_Name= time().'.'.$file_name->getClientOriginalName();
//                 $file_name->move(public_path('uploads/category'), $image_Name);
//                 $users->image= $image_Name;
//             }
          

//             $users->save();
//             return back();

//  }

}
