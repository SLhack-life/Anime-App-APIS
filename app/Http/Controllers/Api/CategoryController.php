<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function get_categories(){
        $data=Category::where('status',1)->get();
        return response()->json(['statusCode' => 200, 'message' => 'categories  feteched successfully','data'=>$data]);
}
}
