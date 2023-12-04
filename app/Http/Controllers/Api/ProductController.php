<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Traits\ValidationErrorTrait;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ValidationErrorTrait;
    public function getProducts(Request  $request)
    {
      
        $limit = $request->limit ? $request->limit : 15;
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $offset = ($page - 1) * $limit;
        // $data=Product::leftJoin('images', 'products.id', '=', 'images.product_id')->distinct()->take(5)->get();
        $data = Product::with('image_detail')->with('variant_product.variant_image_detail')->orderBy('id', 'DESC')->offset($offset)->limit($limit)->get();
        foreach ($data as $dat) {

            $product = Product::where('id', $dat->id)->first();
            $points = $product->price * 10;
            $product->points = $points;
            $product->update();
        }
        // $articles = Article::orderBy('id', 'DESC')->take(5)->get();

        return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
    }
    public function productDetail(Request $request)
    {

        $json_data = json_decode($request->getContent(), true);
        $validator = Validator::make($json_data, [
            'id' => 'required',

        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        $product = Product::where('id', $request->id)->first();
        if (empty($product)) {
            return response(['statusCode' => 400, 'message' => "product not found!!"]);
        }
        $product = Product::where('id', $request->id)->with('image_detail')->with('category_detail')->with('variant_product.variant_image_detail')->get();

        // $image=Image::where('product_id',$request->id)->get();
        // $category=Category::where('product_id',$request->id)->get();
        // $data=array_merge($product,$image,$category);
        if (empty($product)) {
            return response(['statusCode' => 400, 'message' => "product not found"]);
        }
        return response()->json(['statusCode' => 200, 'message' => 'product detail feteched successfully', 'data' => $product]);
    }
    public function new_product()
    {
        // $data=Product::leftJoin('images', 'products.id', '=', 'images.product_id')->distinct()->take(5)->get();
        $data = Product::orderBy('id', 'DESC')->take(3)->get();


        return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
    }

    //get products by 
    public function get_product(Request $request)
    {
        $json_data = json_decode($request->getContent(), true);
        $validator = Validator::make($json_data, [
            'category_id' => 'required',


        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }

        $first_array = array();
        $limit = $request->limit ? $request->limit : 15;
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $offset = ($page - 1) * $limit;
        if ($request->category_id) {
            $main_category_products = Product::where('category_id', $request->category_id)
                ->with('image_detail');
            // if ($request->limit) {
            //     $main_category_products = $main_category_products->take($request->limit);
            // }
            $main_category_products = $main_category_products->offset($offset)->limit($limit)->get();
            

            foreach ($main_category_products as $product) {
                $save_points = Product::where('id', $product->id)->first();
                $points = $save_points->price * 10;
                $save_points->points = $points;
                $save_points->update();
            }
            $first_array = $main_category_products->toArray();
        }

        $second_array = array();
        if ($request->sub_category_id) {
            $sub_category_products = Product::where('category_id', $request->sub_category_id)
                ->with('image_detail');
            // if ($request->limit) {
            //     $sub_category_products = $sub_category_products->take($request->limit);
            // }
            $sub_category_products = $sub_category_products->offset($offset)->limit($limit)->get();

            foreach ($sub_category_products as $sub_product) {
                $update_data = Product::where('id', $sub_product->id)->first();
                $sub_points = $update_data->price * 10;
                $update_data->points = $sub_points;
                $product->update();
            }
            $second_array = $sub_category_products->toArray();
        }

        $data = array_merge($first_array,  $second_array);
        if (empty($data)) {
            return response()->json(['statusCode' => 400, 'message' => 'product not found', 'data' => []]);
        }
        return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
    }

    public function filter_product(Request $request){

        $limit = $request->limit ? $request->limit : 15;
        $page = $request->page && $request->page > 0 ? $request->page : 1;
        $offset = ($page - 1) * $limit;



        $data = json_decode($request->getContent(), true);
        if($request->category && empty($request->max_points) && empty($request->start_price)){
            $category[]=explode(",",$request->category);
            $data=Product::whereIn('category_id',$category)
            ->with('image_detail')->offset($offset)->limit($limit)->get();
            return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
        }
        if($request->category && $request->max_points){
            
            $category=explode(",",$request->category);
          
            $data=Product::whereIn('category_id', $category)->where('points', '<=', $request->max_points)
            ->with('image_detail')->offset($offset)->limit($limit)->get();
            return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
        }
        if($request->category && ($request->start_price && $request->end_price)){
            $category=explode(",",$request->category);
           
            $data=Product::whereIN('category_id', $category)->where('price', '>=', $request->start_price)->where('price', '<=', $request->end_price)
            ->with('image_detail')->offset($offset)->limit($limit)->get();
            return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);

        }

        if($request->max_points && empty($request->category) && empty($request->start_price)){
            $data=Product::where('points', '<=', $request->max_points)
            ->with('image_detail')->offset($offset)->limit($limit)->get();
            return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
        }
        if(!empty($request->start_price) && !empty($request->end_price)){
            $data=Product::where('price', '>=', $request->start_price)->where('price', '<=', $request->end_price)
            ->with('image_detail')->offset($offset)->limit($limit)->get();
            return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
        }
        if($request->max_points &&  ($request->start_price && $request->end_price)){
            $data=Product::where('points', '<=', $request->max_points)->where('price', '>=', $request->start_price)
            ->where('price', '<=', $request->end_price)
            ->with('image_detail')->offset($offset)->limit($limit)->get();
            return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);


        }


        if($request->max_points &&  ($request->start_price && $request->end_price) && $request->category){
            $category=explode(",",$request->category);;
            $data=Product::whereIN('category_id', $category)->where('points', '<=', $request->max_points)->where('price', '>=', $request->start_price)
            ->where('price', '<=', $request->end_price)
            ->with('image_detail')->get();
            return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);


        }

       


    }

     public function search_product(Request $request){

            $json_data = json_decode($request->getContent(), true);
        $validator = Validator::make($json_data, [
            'product' => 'required',


        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        $data=Product::where('name', 'LIKE', '%'. $request->product. '%')->get();
        return response()->json(['statusCode' => 200, 'message' => 'products feteched successfully', 'data' => $data]);
    }
}
