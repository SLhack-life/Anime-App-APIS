<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function show(Request $request){
        $data=array();
        if ($request->ajax()) {
            
            
            $orders = Order::select('orders.*','users.user_name')->leftjoin('users', 'users.id', '=', 'orders.user_id')->orderBy('id', 'DESC')->get();
            // echo'<pre>'; print_r($orders); dd();
            // foreach($orders as $ord){
            //     $user=User::where('id',$ord->id)->first();

            //     $data[]=$user->name;
            // }
            // foreach ($products as $product) {
            //     $product->category_name = Category::where('id', $product->category_id)->pluck('')
            // }
            
            return Datatables::of($orders)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = "<span class='order_status edit btn btn-primary btn-sm'  data-id='$row->id' onclick='changeOrderStatus($row->id)'>Update</span>";
     
                            return $btn;
                    })
                    ->addColumn('cash', function ($row) {
                        return 'Online';
                    })
                    ->addColumn('view', function($row){
   
                        $btn = "<a href='order_view/$row->id' class='order_status edit btn btn-primary btn-sm' >view</span>";
  
                         return $btn;
                 })
                    
                   
                    ->rawColumns(['action','cash','view'])
                    ->make(true);
                    
        }
    
        return view('orders.index');
    }
    public function view_order($id){
       $data=Order::where('id',$id)->first();
       return view('orders.view',compact('data'));
    }
    public function update_status(Request $request){
    
       
        $validator = Validator::make($request->all(),[
            'status' => 'required',
           
        ]);
        if ($validator->fails())
        {
          return response()->json(['status' => 400, 'errors'=>$validator->errors()]);
        }
        $id=$request->id;
        $status=$request->status;
    
        $order=Order::where('id',$id)->first();
    
        $users=User::where('id',$order->user_id)->first();

       
    
        $order->status=$status;
        $order->save();
        $user=User::where('role',0)->first();
        
        if($order->status==1){
        $notify_type = 1;
        $sender_id = $user->id;
        $receiver_id =  $id;
        $msg =$users->user_name.",Your order will processes successfully";
        }
       if($order->status==2){
                $notify_type = 1;
                $sender_id = $user->id;
                $receiver_id =  $id;
                $msg =$users->user_name.",Your order will shipped successfully";
        }if($order->status==3){
                    $notify_type = 1;
                    $sender_id = $user->id;
                    $receiver_id =  $id;
                    $msg =$users->user_name.",Your order will delivered successfully";
        }
        if($order->status==4){
            $notify_type = 1;
            $sender_id = $user->id;
            $receiver_id =  $id;
            $msg =$users->user_name.",Your order  cancel successfully";
         }
         if($order->status==5){
            $notify_type = 1;
            $sender_id = $user->id;
            $receiver_id =  $id;
            $msg =$users->user_name.",Your order  return  successfully";
         }

         $this->notification($users->device_token, $users->device_type, $notify_type, $msg, $sender_id,  $receiver_id);
        return response()->json(['status' => 200,'message'=>"data insert successfully!"]);

    }
    public function show_complete_orders(Request $request){
        if ($request->ajax()) {
            $orders = Order::select('orders.*','users.user_name')->leftjoin('users', 'users.id', '=', 'orders.user_id')->where('orders.status',3)->get();
        return Datatables::of($orders)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = "<span class='order_status edit btn btn-primary btn-sm'  data-id='$row->id' onclick='changeOrderStatus($row->id)'>view</span>";
     
                            return $btn;
                    })
                     ->addColumn('cash', function ($row) {
                        return 'cash on delivery';
                    })
                   
                   
                    ->rawColumns(['action','cash'])
                    ->make(true);
                    
        }
    
        return view('orders.complete_order');


   
    }
    public function view_complete($id){
        $products=array();
      


        $data=Order::where('id',$id)->first();
        
        $id=$data->address_id;
    
    
     $address_detail=Address::where('id',$id)->first();
    
     if(empty($data)){
         return response(['statusCode' => 400, 'message' => "order not found"]);
     }
     
     $cart_arr=explode(',',$data->cart_id);
     $products = count($cart_arr);
   
     $dat_arr = array();
 
     foreach($cart_arr as $arr){
 
         $dat_arr[] = Cart::where('id',$arr)->with('product_detail')->with('image_detail')->first();
        
         
       
     }
    
     
    //  dd($dat_arr);
        return view('orders.complete_view',compact('dat_arr','data', 'products','address_detail'));
    }

    public function notification($token, $device_type, $notify_type, $title, $sender_id,  $receiver_id)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $key = 'AAAA79AJkZk:APA91bHKBQLscnqMz_iZLyJDwfsZNThai58CbIoahQrXPhTEGsITpQFyqH_SOfv6E2SK2VKdJoiKy7G9NbKgifZPrXgJtRZRkt0OOGgSq_6k1LGfuHBDYHjjuUFLEdGv4gEGvSbT8ftz';
        if ($device_type == 0) {
            $data = array(
                'notify_type' => $notify_type,
                'title' => "Jst-The-TIp",
                "subject" => $title,
                "type"  =>  "Song Request",
                "sender_id" => $sender_id,
                "receiver_id" => $receiver_id,
            );

            $fields = array(
                'to' => $token,
                'data' => $data
            );
        } else {
            $data = array(
                'notify_type' => $notify_type,
                'title' => "Jst-The-TIp",
                "subject" => $title,
                "type"  =>  "Song Request",
                "sender_id" => $sender_id,
                "receiver_id" => $receiver_id,
            );

            $notification = array(
                'title' => "Jst-The-TIp",
                "body" => $title,
                'sound' => 'Default',
                'badge' => 1,
                'image' => 'Notification Image'
            );

            $fields = array(
                'to' => $token,
                'notification' => $notification,
                'data' => $data
            );
        }

        $headers = array(
            'Authorization: key=' . $key,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields, true));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }


}
