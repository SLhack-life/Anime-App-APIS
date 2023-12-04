@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-12">         

            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                <!-- datatables-users -->
                <table class="table" id="table">
                  
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Order id</th>
                                <th>UserName</th>
                                 <th>Total price</th>
                                <th>order Status</th>
                                <th>payment_method</th>

                                <th>Actions</th>
                               <th>View</th>

                            </tr>
                         
                            
                        </thead>
                
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->
    <div class="modal fade" id="edit_order_status" tabindex="-1" aria-hidden="true" aria-labelledby="editUserLabel" >
       <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                    <h3>Edit order status</h3>
                
                    </div>
                    <form id="order_status_form" class="row g-3">
                        <!-- @csrf -->
                        <input type="hidden" name="order_id" id="order_id" value="">
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">Order status</label>
                            <select id="status" name="status" class="form-select" aria-label="Default select example">
                          
                        <option value="1">processed</option>
                        <option value="2">shipped</option>
                        <option value="3">Delivered</option>

                        <option value="4">cancel</option>
                            </select>
                     
                    
                    
                    
            
                        <div class="col-12 text-center mt-4">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" id="order_status_submited">Submit</button>
                            <button type="reset" class="btn btn-label-secondary hide_modal" data-bs-dismiss="modal" aria-label="close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
<!-- </div> -->
<!--/ Edit User Modal -->



<script type="text/javascript">
$(document).ready(function() {

    $.noConflict();
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('orders') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
           
            {data: 'order_id', name: 'order id',orderable: false, searchable: true},
            {data: 'user_name', name: 'UserName',orderable: false, searchable: true},
            {data: 'total_price', name: 'Total price', render: function ( data, type, row ) {
     return row.total_price +'zł';
}},
            {data: 'status', name: 'status', "searchable": false,
        "orderable":false,
        "render": function (data, type, row){
            
                        if (row.status == 0) {
                            return 'Placed';
                        } else if (row.status == 1) {
                            return 'Processed';
                        } else if (row.status ==  2) {
                            return 'Shipped';
                        } else if (row.status ==  3) {
                            return 'Delivered';
                        } else {
                            return 'Canceled';
                        }
           }},
           {data: 'cash', name: 'payment_method'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'view', name: 'view', orderable: false, searchable: false},

             
           
            
            

        ]
    });
    
    
  });

  function changeOrderStatus(id) {
  
    $('#edit_order_status').css({'display':'block','opacity':1});
    var a=$('#order_id').val(id);
    
      
    }
    $('.btn-close').click(function() {
                
                $('#edit_order_status').css({'display':'none','opacity':0})
            });

            $('.hide_modal').click(function() {
                
                $('#edit_order_status').css({'display':'none','opacity':0})
            });
    $('#order_status_submited').click(function() {
        var id = $('#order_id').val();
      var status = $('#status').val();
      
                
            // let form = $('#order_status_form');
      

            // data = new FormData(form[0]);

            
    //   var user_id = $(this).attr('data-id');
      // console.log(status);
    $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
        url: "{{url('update_order_status')}}",
        data:{
            id: id,
                  status: status,
        },
        cache: false,
        success: function(data) {
          
            $('#edit_order_status').css({'display':'none','opacity':0})
            window.location.href="orders";
      
           

        }
    });
});
 
</script>

@endsection
