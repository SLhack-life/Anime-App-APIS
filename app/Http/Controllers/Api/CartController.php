<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ValidationErrorTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    use ValidationErrorTrait;


    public function addTOCart(Request $request) 
    {
        $json_data = json_decode($request->getContent(), true);
        $validator = Validator::make($json_data, [
            'product_id' => 'required',
            'type' =>'required',            
        ]);

        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        
        $product_in_cart_exist = Cart::where([['product_id',$request->product_id],['user_id', Auth::id()],['is_ordered',0]])->first();

        $product_exist = Product::where('id',$request->product_id)->first();
        if(empty($product_exist)){
            return response(['statusCode' => 400, 'message' => "product not exist"]);
        }
        if($product_in_cart_exist) {         
            if($request->type == 0 && $product_in_cart_exist->quantity >= 1) {                                        
                $quantity = $product_in_cart_exist->quantity;            
                $quantity = $quantity+1;                
                $final_price = $product_in_cart_exist->price*$quantity;
                $product_in_cart_exist->price = $final_price;
                $product_in_cart_exist->quantity = $quantity;
                $product_in_cart_exist->update();
                return response(['statusCode' => 200, 'message' => "quantity increased successfully!",'data'=>$product_in_cart_exist]);
            } elseif ($request->type==1 && $product_in_cart_exist->quantity > 1) {
                // $data=Cart::where('product_id',$request->product_id)->first();
                $quantity = $product_in_cart_exist->quantity;
                $quantity = $quantity-1;
                $product_in_cart_exist->quantity = $quantity;
                $product_in_cart_exist->update();
                return response(['statusCode' => 200, 'message' => "quantity decreased successfully!",'data'=>$product_in_cart_exist]);
            }  elseif ($request->type==1 && $product_in_cart_exist->quantity == 1) {
                $product_in_cart_exist->delete();
                return response(['statusCode' => 200, 'message' => "product in cart deleted successfull",'data'=>$product_in_cart_exist]);
            }       
        } else{
            $product_price=Product::where('id',$request->product_id)->first();
            $data=new Cart;
            $data->quantity=1;
            $data->user_id=Auth::id();
            $data->product_id=$request->product_id;
            $data->price=$product_price->price*$data->quantity;
            $data->save();
            $datas=Product::with('image_detail')->where('id',$request->product_id)->get();
            return response(['statusCode' => 200, 'message' => "product in cart added successfully",'data'=>$datas]);
        }
    }


    public function getCart(){
        $id=Auth::id();
        $cart=Cart::where('user_id',$id)->where('is_ordered',0)->with('product_detail.image_detail')->get();

        return response(['statusCode' => 200, 'message' => "products in cart feteched successfully",'data'=>$cart]);
    }
}
