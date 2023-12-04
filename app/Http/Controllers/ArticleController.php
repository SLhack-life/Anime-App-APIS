<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    public function show(){
        $article=Article::all();
        return view('Articles.article',compact('article'));
    }

    public function add_article_data(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'image' => 'required',
           
           
         
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
       
        $users = new Article;
        $users->title = $request->title;
        $users->description =$request->input;
        if(!empty($request->image)){
            $file_name = $request->file('image');
            $image_Name= time().'.'.$file_name->getClientOriginalName();
            $file_name->move(public_path('uploads/articles'), $image_Name);
            $users->image= $image_Name;
        }
      

        $users->save();
        return response()->json(['status' => 200,'message'=>"data insert successfully!"]);

}
    public function view_article(Request $request){
     
        $id=$request->id;
    
        $data=Article::where('id',$id)->first(); 
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data]);
    }
    public function edit_article(Request $request){
     
        $id=$request->id;
    
        $data=Article::where('id',$id)->first();
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data]);
    }
    public function update_article(Request $request){
    //  dd($request);
 
        $validator = Validator::make($request->all(),[
            'name' => 'required',
           
           
         
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        
        $users =Article::where('id',$request->article_id)->first();
        $users->title = $request->name;
        $users->description = ($request->input);
        if(!empty($request->image)){
            $file_name = $request->file('image');
            $image_Name= time().'.'.$file_name->getClientOriginalName();
            $file_name->move(public_path('uploads/articles'), $image_Name);
            $users->image= $image_Name;
        }
      

        $users->save();
        return response()->json(['status' => 200,'message'=>"data insert successfully!"]);
    }
    public function delete_article(Request $request){
     
        $id=$request->id;
    
        $data=Article::where('id',$id)->first();
        $data->delete();
        return response()->json(['status' => 200,'message'=>"data edit successfully!",'data'=>$data]);
    }
}
