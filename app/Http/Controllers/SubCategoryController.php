<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public function store(Request $request)
    {
    
        $validator = Validator::make($request->all(),[
            'name' => 'required',
          
            // 'description' => 'required',
           
         
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        $users = new Subcategory;
        $users->sub_category = $request->name;
        $users->category_id = $request->category;
        $users->description = $request->description;


        $users->status=$request->status;
        if(!empty($request->image)){
            $file_name = $request->file('image');
            $image_Name= time().'.'.$file_name->getClientOriginalName();
            $file_name->move(public_path('uploads/sub_category'), $image_Name);
            $users->image= $image_Name;
        }
      

        $users->save();
        return response()->json(['status' => 200,'message'=>"data insert successfully!"]);
    }
    public function show(){
        $datas=Subcategory::select('subcategories.*','categories.name')
        ->leftjoin('categories','categories.id','category_id')->first();
        
        $data=Subcategory::select('subcategories.*','categories.name')
        ->leftjoin('categories','categories.id','category_id')->get();
        $category=Category::all();

        return view('subcategories.index',compact('data','category','datas'));
    }
    public function view($id){
        
        $data=Subcategory::find($id);
        return view('subcategories.sub_categories_view',compact('data'));
    }
    public function edit(Request $request){
        $id=$request->id;
    
        $data=Subcategory::select('subcategories.*','categories.name','categories.id as cat_id')->leftjoin('categories','categories.id', '=', 'subcategories.category_id')->where('subcategories.id',$id)->first();
        $category=Category::all();

       
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data,'category'=>$category]);
        

    }
    public function update(Request $request)
    {
    
        $validator = Validator::make($request->all(),[
            'subcategory_name' => 'required',
          
        
           
         
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        $users =Subcategory::where('id',$request->subcategory_id)->first();
        if(!empty($request->subcategory_name)){
        $users->sub_category = $request->subcategory_name;
        }
        if(!empty($request->main_category)){
        $users->category_id = $request->main_category;
        }
        if(!empty($request->subcategory_description)){
        $users->description = $request->subcategory_description;
        }


        $users->status=$request->subcategory_status;
        if(!empty($request->image)){
            $file_name = $request->file('image');
            $image_Name= time().'.'.$file_name->getClientOriginalName();
            $file_name->move(public_path('uploads/sub_category'), $image_Name);
            $users->image= $image_Name;
        }
      

        $users->save();
        return response()->json(['status' => 200,'message'=>"data update successfully!"]);
    }
    public function delete(Request $request){
        $id=$request->id;
    
        $data=Subcategory::where('id',$id)->first();
        $data->status=0;
        $data->save();
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data]);
    }
}
