@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-12">
        <div class="tex_end mb-3 pb-0">
                <button class="btn btn-blue " data-bs-toggle="modal" data-bs-target="#add_store">Add store</button>
            </div>
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Name</th>
                                <th>email</th>
                             
                                <th>Actions</th>
                            </tr>
                        
                         
                        </thead>
                    </table>
                </div>
            </div>
      <div class="modal fade" id="add_store" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3>add store</h3>
                <ul class="alert-danger"></ul>

              </div>
              <form id="add_store_form" class="row g-3">
                  @csrf
      
                <input type="hidden" id="product_id" name="product_id" value="">
                <div class="col-12">
                  <label class="form-label" for="modalEditProductName">Store Name</label>
                  <input type="text" id="modalEditProductName" name="store_name" id="product_name" class="form-control" placeholder="">
                </div>
                <div class="col-12">
                  <label class="form-label" for="modalEditProductName">email</label>
                  <input type="text" id="modalEditProductName" name="store_email" id="product_price" class="form-control" placeholder="">
                </div>
                <div class="col-12">
                  <label class="form-label" for="modalEditProductDescr">password</label>
                  <input type="text" id="modalEditProductName" name="store_password" id="product_price" class="form-control" placeholder="">
                </div>    
              
                
              
              
                <!-- <div class="col-12 col-md-6">
                  <label class="form-label" for="modalEditUserCountry">Country</label>
                  <select id="modalEditUserCountry" name="modalEditUserCountry" class="select2 form-select" data-allow-clear="true">
                    <option value="">Select</option>
                    <option value="Australia">Australia</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="Belarus">Belarus</option>
                    <option value="Brazil">Brazil</option>
                    <option value="Canada">Canada</option>
                    <option value="China">China</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                    <option value="India">India</option>
                    <option value="Indonesia">Indonesia</option>
                    <option value="Israel">Israel</option>
                    <option value="Italy">Italy</option>
                    <option value="Japan">Japan</option>
                    <option value="Korea">Korea, Republic of</option>
                    <option value="Mexico">Mexico</option>
                    <option value="Philippines">Philippines</option>
                    <option value="Russia">Russian Federation</option>
                    <option value="South Africa">South Africa</option>
                    <option value="Thailand">Thailand</option>
                    <option value="Turkey">Turkey</option>
                    <option value="Ukraine">Ukraine</option>
                    <option value="United Arab Emirates">United Arab Emirates</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="United States">United States</option>
                  </select>
                </div> -->
        
                <div class="col-12 text-center mt-4">
                  <button type="button" class="btn btn-primary me-sm-3 me-1" id="submit_store">Submit</button>
                  <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  <div class="modal fade" id="edit_store" tabindex="-1" aria-hidden="true" aria-labelledby="editUserLabel" >
       <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                      <ul class="alert-danger"></ul>
                      <h3>Edit store</h3>
                
                    </div>
                    <form id="edit_store_form" class="row g-3">
                        <!-- @csrf -->
                        <input type="hidden" name="store_id" id="store_id" value="">
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">email</label>
                            <input type="text" name="email" id="store_email" class="form-control"  value="" placeholder="">
                     
                            <label class="form-label" for="modalEditProductName">name</label>
                            <input type="text" name="store_name" id="store_name" class="form-control"  value="" placeholder="">
                     
                    
                    
            
                        <div class="col-12 text-center mt-4">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" id="update_store">Submit</button>
                            <button type="reset" class="btn btn-label-secondary hide_modal" data-bs-dismiss="modal" aria-label="close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

    $.noConflict();
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('stores_list') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'store_name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'actions', orderable: false, searchable: false},
           ]
    });
    
  });
  function edit_store(id) {
    var ide = id;
  

    
    $.ajax({
                type: "POST",
                dataType: "json",
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{url('edit/store')}}",
                data:{
                  id:ide,
                },
            
                success: function(result) {

                  console.log(result.data.user_name)
                  	
                  		$('.alert-danger').hide();
                  
                  	
                      $('#store_id').val(result.data.id)
                      $("#store_name").val(result.data.store_name);
                      $("#store_email").val(result.data.email);
                      // $("#name").val(result.title);

                  	

            


                }
            });
    
  }

  $('#submit_store').click(function() {



// var id = $('#user_id').val();

let form = $('#add_store_form');


data = new FormData(form[0]);
console.log(data);

//   var user_id = $(this).attr('data-id');
// console.log(status);
$.ajax({
  type: "POST",
  dataType: "json",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: "{{url('add/store')}}",
  data: data,
  processData: false,
  contentType: false,
  success: function(result) {

    
    if (result.errors) {
      //$('.alert-danger').html('');

      $.each(result.errors, function(key, value) {
        // jQuery('#edit_store').modal('show');
        $('.alert-danger').show();
        $('.alert-danger').append('<li style="list-style-type:none">' + value + '</li>');
      
      });
    } else {

      $('.alert-danger').hide();

      jQuery('#edit_store').modal('hide');
      window.location.href = "{{ route('stores_list')}}";
    }




  }
});
});
</script>
<!-- / Content -->
@endsection
