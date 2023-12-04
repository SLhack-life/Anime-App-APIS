<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

use App\Traits\ValidationErrorTrait;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ArticleController extends Controller
{
    use ValidationErrorTrait;
    public function get_articles(){
    
        $data=Article::all();
        $recent_articles=Article::orderBy('id', 'DESC')->take(5)->get();
        
        return response()->json(['statusCode' => 200, 'message' => 'articles feteched successfully','data'=>$data,'recent_articles'=>$recent_articles]);
    }
    public function article_detail(Request $request)
{
    $data = $request->all();
    $validator = Validator::make($data, [

        'id' => 'required',

    ]);

    if ($validator->fails()) {
        $messages = implode(",", $this->errorMessages($validator->errors()));
        return response(['statusCode' => 400, 'message' => $messages]);
    }
    $users =  Article::Where('id',$request->id)->first();
      
    if(empty($users)){
        return response(['statusCode' => 400, 'message' => 'address not found.']);
    }


    return response(['statusCode' => 200, 'message' => 'article fetched  Successfully.', 'data' => $users]);
}
}
