<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SuperSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class sub_SubCategoryController extends Controller
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
        $users = new SuperSubCategory();
        $users->name = $request->name;
        $users->category_id = $request->category;
        $users->subcategory_id = $request->category;
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
        $super_subcategory=SuperSubCategory::select('super_sub_categories.*','subcategories.sub_category')->leftjoin('subcategories','subcategories.id','subcategory_id')->get();
        $subcategory=Subcategory::all();
        $category=Category::all();
        $data=SuperSubCategory::select('super_sub_categories.*','subcategories.sub_category')->leftjoin('subcategories','subcategories.id','subcategory_id')->first();
        return view('sub_subcategory.index',compact('subcategory','category','super_subcategory','data'));
    }
    public function view($id){
        
        $data=SuperSubCategory::select('super_sub_categories.*','subcategories.sub_category')->leftjoin('subcategories','subcategories.id','subcategory_id')->first();
        return view('sub_subcategory.sub_subcategory_view',compact('data'));
    }
    public function edit(Request $request){

        
        $id=$request->id;
        
        $subcategory=Subcategory::all();
        $category=Category::all();
    
        $data=SuperSubCategory::select('super_sub_categories.*','categories.name as cat_name','categories.id as cat_id','subcategories.id as sub_cat_id')
        ->leftjoin('subcategories','subcategories.id', '=', 'super_sub_categories.subcategory_id')
        ->leftjoin('categories','categories.id', '=', 'super_sub_categories.category_id')
        ->where('super_sub_categories.id',$id)->first();
       

       
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data,'category'=>$category,'subcategory'=>$subcategory]);
        

    }
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'sub_subcategory_name' => 'required',
          
            
           
         
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        $users =SuperSubCategory::where('id',$request->sub_subcategory_id)->first();
        $users->subcategory_id = $request->main_sub_category;
        $users->category_id = $request->main_category;
        $users->name = $request->sub_subcategory_name;
        $users->description = $request->sub_subcategory_description;

        $users->status=$request->sub_subcategory_status;
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
    
        $data=SuperSubCategory::where('id',$id)->first();
        $data->status=0;
        $data->save();
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data]);
    }
}
