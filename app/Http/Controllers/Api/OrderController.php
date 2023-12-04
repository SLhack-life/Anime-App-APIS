<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Traits\ValidationErrorTrait;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\wallet;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;
use App\Models\Point;

class OrderController extends Controller
{
    use ValidationErrorTrait;
    public function placedOrder(Request $request){
        $json_data = json_decode($request->getContent(), true);
        $validator = Validator::make($json_data, [
           
            'cart_id' =>'required',
            'total_price' =>'required',
            "baseliner_order_id"=>'required',
            'delivery' =>'required',
            'tax' =>'required',
            'shipment'=>'required'
            
        ]);
        if ($validator->fails()) {
            $messages = implode(",", $this->errorMessages($validator->errors()));
            return response(['statusCode' => 400, 'message' => $messages]);
        }
        // $myArray = explode(',', $request->cart_id);
        // foreach($myArray as $arr){
       $data=new Order;
       $data->user_id=Auth::id();
      $data->baseliner_order_id=$request->baseliner_order_id;
       $data->cart_id=$request->cart_id;
       $data->order_id= mt_rand();
       $data->total_price=$request->total_price;
       $data->delivery=$request->delivery;
       $data->tax=$request->tax;
       $data->points_used=$request->points_used;
       $data->points_to_be_used=!empty($request->points_used)?$request->points_used:0;
    
       $data->status=0;
       if($request->shipment=="0" || $request->shipment==0){
         
         
          $data->address_id=$request->address_id;
          $data->shipment="courier";

       }
       else if($request->shipment=="1" || $request->shipment==1){
        
          
          $data->address_name=$request->address_name;
          $data->shipment="InPost";

       }
       if($request->is_paid==0 || $request->is_paid=="0"){
        $data->is_paid="TPay";

       }
       else{
        $data->is_paid="COD";
       }
       $data->save();
       $order_id=array(
        "order_id" =>$data->order_id,
        "id" =>$data->id
    );
       $user=Order::where('id',$data->id)->first();
       $myarray=explode(',',$request->cart_id);
       $points=0;
       foreach($myarray as $arr){
    
       $cart=Cart::where('id',$arr)->first();
       
    //    $quantity=$cart->quantity;
       
       $product=Product::where('id',$cart->product_id)->first();
      
      
       
        
       $cart->is_ordered=1;
       $cart->update();
       }
    //    $pointss=$request->total_price*10;
    // //    $user=User::where('id',Auth::id())->first();
    // $user=wallet::where('user_id',Auth::id())->first();

   
    // if(!empty($user)){
 
    //    $already_points=$user->points;
    // //    if(!empty($already_points)){
    // //     // $user->points=$pointss+$already_points;
    // //     $user->update();
    // //    }
    // //    else{
    // //    $user->points=$pointss;
    // //    $user->update();
    // //    }
    // //   $user_points=$user->points;
    //    if($request->points_used==1){

    //     $user->points=0;
    //     $user->points=$pointss+$user->points;
    
    //     $user->update();
       
    //     // if($already_points%1000!=0){
    //     //     $round_points=$already_points%1000;
            
    //     //     dd($round_points);
    //     //     $user->points=($round_points)+ $pointss;
            
    //     //     $user->update();

    //     // }
    //     // else{
            
    //     //     $user->points=0;
    //     //     $user->points=$pointss+$user->points;
        
    //     //     $user->update();
    //     // }

    //    } else {
    //     $user->points=$pointss+$user->points;

    //     $user->update();

    //    }
    // }
    
        return response(['statusCode' => 200, 'message' => 'order placed Successfully.','data'=>$order_id]);


}


            public function get_points(Request $request){
             $orders=Order::where('user_id',Auth::id())->get();
             if(count($orders)>0){
                foreach($orders as $order){
                    $arr= Carbon::parse($order->created_at);
                  
                   
                  
                    $date=Carbon::now();
                
                    
                
                    $diff = $arr->diffInDays($date);
                     
                    if($diff==2 || $diff>2){
    
                        $pointss=$order->total_price*10;
        
                         $user=wallet::where('user_id',Auth::id())->first();
                 
    
       
                            if(!empty($user)){
                             if($order->cron_job_status==0){
                                $points_table=new Point();
                                $points_table->points_status="collected";
                                $points_table->order_id=$order->id;
                                $points_table->user_id=$order->user_id;
                                $points_table->points=$pointss;
                                $points_table->save();
                        
                                  $already_points=$user->points;
                                  
                            
                                     if($order->points_used==1){
    
                                            $user->points=0;
                                            $user->points=$pointss+$user->points;
                                            $points_table=new Point();
                                            $points_table->points_status="used";
                                            $points_table->order_id=$order->id;
                                            $points_table->user_id=$order->user_id;
                                            $points_table->points=$order->points_to_be_used;
                                            $points_table->save();
                                            $user->update();
                            
                              
    
                                       } else {
                                            
                                            $user->points=$pointss+$user->points;
                                            
                                          
                                            $user->update();
    
                                        }
                                    }
                            }
    
                    }
                    $order_data=Order::where('id',$order->id)->first();
                   
                    $order_data->cron_job_status=1;
                    $order_data->update();
    
                
                 }

             }
             


                
            }
public function get_order(){
    $user_id=Auth::id();
    $order=Order::where('user_id',$user_id)->orderBy('id', 'DESC')->get();
    $products=array();
    foreach($order as $ord){
        $myarray=explode(",",$ord->cart_id);
        $products[]=count($myarray);
    } 
    return response(['statusCode' => 200, 'message' => 'orders fetched Successfully.', 'data' => $order,'quantity'=>$products]);
    
}
public function get_order_detail(Request $request){
    $json_data = json_decode($request->getContent(), true);
    $validator = Validator::make($json_data, [
        'order_id' => 'required',        
    ]);
    if ($validator->fails()) {
        $messages = implode(",", $this->errorMessages($validator->errors()));
        return response(['statusCode' => 400, 'message' => $messages]);
    }
    $data=Order::where('id',$request->order_id)->first();
    $id=$data->address_id;
    $address_detail=Address::where('id',$id)->first();
    if(empty($data)){
        return response(['statusCode' => 400, 'message' => "order not found"]);
    }
    
    $cart_arr=explode(',',$data->cart_id);
    $dat_arr = array();
    $image = array();
    foreach($cart_arr as $arr){
        
        

        $dat_arr[] = Cart::where('id',$arr)->with('product_detail.image_detail')->first();
            // foreach ($dat_arr as $value) {
            //     // dd($value->product_id);
            //     $image[] = Image::where('id', $value->product_id)->get();
                
            // }
          
        // dd($cart);
        // if(!empty($cart)){
         
        // }
        // $id=$cart->product_id;

    
          
        // $product=Product::where('id', $id)->with('image_detail')->get();
        // $data[$count]=$product;
        // $data['quantity']=$cart->quantity;
        // $count++;
      
    }
    // return response(['data'=> $dat_arr]);
    if(empty($data)){
        return response(['statusCode' => 400, 'message' => "orders not found!"]);
    }
    // $dat_arr['address_detail']=$address_detail;
    // $final_array=array_merge($dat_arr,$address_detail);
    return  response(['statusCode' => 200, 'message' => "orders fetchd successfully!",'address_detail'=>$address_detail, 'data'=>$dat_arr]);

    
}
public function cancel_order(Request $request){
    $json_data = json_decode($request->getContent(), true);
    $validator = Validator::make($json_data, [
        'id' => 'required',
        
        'reason' =>'required',
       
        
    ]);
    if ($validator->fails()) {
        $messages = implode(",", $this->errorMessages($validator->errors()));
        return response(['statusCode' => 400, 'message' => $messages]);
    }
    $data=Order::where('id',$request->id)->first();
    if(empty($data)){
        return response(['statusCode' => 400, 'message' => "orders not found!"]);
    }
    $data->status=4;
    $data->reason=$request->reason;
    $data->description=$request->description;
    $data->update();
    $pointss=$data->total_price*10;
    //    $user=User::where('id',Auth::id())->first();
    $user=wallet::where('user_id',Auth::id())->first();
    if(!empty($user)){
 
        $already_points=$user->points;
     //   
     //   $user_points=$user->points;
       
         $user->points=$pointss+$already_points;
 
         $user->update();
 
        }
     
    return response(['statusCode' => 200, 'message' => "order cancelled successfully!"]);
   
}
public function return_order(Request $request){
    $json_data = json_decode($request->getContent(), true);
    $validator = Validator::make($json_data, [
        'order_id' => 'required',
        
    
        
    ]);
    if ($validator->fails()) {
        $messages = implode(",", $this->errorMessages($validator->errors()));
        return response(['statusCode' => 400, 'message' => $messages]);
    }
    $data=Order::where('id',$request->order_id)->first();
    if(empty($data)){
        return response(['statusCode' => 400, 'message' => "orders not found!"]);
    }
    $data->status=5;

    $data->update();
    return response(['statusCode' => 200, 'message' => "order return successfully!"]);
   
}
public function get_collected_data(){
    $collected_points_data=Point::where('user_id',Auth::id())->where('points_status','collected')->get();
    $collected_points_admin=Point::where('user_id',Auth::id())->where('order_id','points by admin')->get();
    foreach( $collected_points_data as $collected){
     $orders=Order::where('user_id',Auth::id())->get();
    $products = array();
    foreach($orders as $order){
        $coll_data=Point::where('order_id',$order->id)->where('points_status','collected')->first();
        $order->total_points = $order->total_price*10;      
        $cart_ids=explode(',',$order->cart_id);
        foreach($cart_ids as $cart_id){           
            $products[]= Cart::select('products.*')->where('is_ordered',1)
                ->where('carts.id',$cart_id)->leftjoin('products', 'products.id', '=', 'carts.product_id')
                ->with('image_detail')->first(); 
                $order->product = $products;  
                $order->points=  $coll_data->points;  
         }
         unset($products);
    }
}
    return  response(['statusCode' => 200, 'message' => "orders fetchd successfully!",'data'=>$orders,'collected_data'=>$collected_points_admin]);
}
public function points_used(Request $request){
  
    $id=Auth::id();
    $used_points_data=Point::where('user_id',Auth::id())->where('points_status','used')->get();
    foreach( $used_points_data as $collected){
    $orders = Order::where('points_used',1)->where('user_id',$id)->get();
   
    $products = array();
    foreach($orders as $key => $order){
        $count = 0;
        $cart_ids = explode(',',$order->cart_id);
        foreach($cart_ids as $cart_id){      
            $products[] = Cart::select('products.*')->where('is_ordered',1)
                ->where('carts.id',$cart_id)
                ->leftjoin('products', 'products.id', '=', 'carts.product_id')
                ->with('image_detail')
                ->first();
                $order->product = $products;
        }
    
        unset($products);
       
    }
}

    return  response(['statusCode' => 200, 'message' => "orders fetchd successfully!",'data'=>$orders]);
}

}
