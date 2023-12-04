@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-12"> 
            <!-- Role Table -->
            <div class="card mb-4">
                
                <div class="order_summary p-3">
                    <h3> Order Summary</h3>
                    
                    <div class="order_summary_inner">
                    
                        <div class="order-title d-flex justify-content-between">
                            <p>Order ID :<b>{{$data->order_id}}</b></p>
                            <p>{{$data->created_at->format('Y-m-d')}}</p>
                        </div>
                        <ul class="p-0 list-unstyled mb-0">
                            <li class="d-flex justify-content-between">
                                <p>Payment</p>
                                <span>{{$data->total_price}}zt</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                
                                <p>Products</p>
                                <span>{{ $products }}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                @if($data->status==0)
                                <p>Placed</p>
                                @endif
                                @if($data->status==1)
                                <p>Processed</p>
                                @endif
                                @if($data->status==2)
                                <p>Shipped</p>
                                @endif
                                @if($data->status==3)
                                <p>Delivered</p>
                                @endif
                                @if($data->status==4)
                                <p>Cancel</p>
                                @endif
                                <span>Status</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
            </div>


             <!-- Role Table -->
             <div class="card  mb-4">
                <div class="card-datatable table-responsive pb-0">
                <h3 class="p-3"> Price Details</h3>      
                <!-- datatables-users -->
                <table class="table product_table" id="table">
                        <thead>
                            <tr>
                                <th>Product Images</th>
                                <th>Name</th>
                                <th>Price</th>                     
                            </tr>   
                        </thead>
                        <tbody>
                          
                            @foreach($dat_arr as $arr)
                                 
                              
                           
                                 
                                
                            <tr>
                                <td class="w-50"><img src="{{$arr['product_detail']->image }}" alt=""></td>
                                <td>{{$arr->product_detail['name']}}</td>
                                <td>{{$arr['product_detail']->points}} x {{$arr->quantity}}</td>
                            </tr>
                        
                            @endforeach
                    
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        
            <div class="card">
                <div class="shipping_details p-3">
                    <h3> Shipping details</h3>              
                        <ul class="p-0 list-unstyled mb-0">
                            <li class="d-flex justify-content-between">
                                <p>Name</p>                          
                                <span>{{$address_detail->name}}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <p>Address</p>
                            
                                <span>{{$address_detail->location}},{{$address_detail->city}} , {{$address_detail->country}} 41-907</span>
                              
                            </li>
                            <li class="d-flex justify-content-between">
                                <p>Phone No.</p>
                                <span>{{$address_detail->phone_number}}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <p>Payment Method</p>
                                <span>Online</span>
                            </li>
                        </ul>
                </div>
                
            </div>
          
         

        </div>
    </div>

</div>

    
<!-- </div> -->
@endsection
