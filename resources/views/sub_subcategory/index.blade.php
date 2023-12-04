@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-12">

            <div class="abosul_add_btn text-end mb-3 pb-0">
                    <button data-bs-toggle="modal" data-bs-target="#add_sub_sub_categories" class="btn btn-blue">Add </button>
            </div>


            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                <!-- datatables-users -->
                <table class="datatables-users  table border-top table_details position-relative">
                  
                        <thead>
                            <tr>
                              
                                <th>Name</th>
                              
                                <th>Sub Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            @foreach($super_subcategory as $users)
                             <tr>
                               
                                <td valign="top">{{$users->name}}</td>
                                <td valign="top">{{$users->sub_category}}</td>

                               
                                <td valign="top">
                                @if($users->status == 0)
                                    <span class="btn btn-danger btn-sm">InActive</span> 
                                @else
                                    <span class="btn btn-success btn-sm">Active</span> 
                                
                                @endif
                                </td>
                                <td valign="top" class="edit_icons">
                                    <a href="{{url('sub_sub_category_view/' . $users->id )}}"><img src="assets/img/icons/view.png" alt=""></a>
                                    <a  class="ml-5"><img src="assets/img/icons/edit.png" alt="" data-id="{{$users->id}}"data-bs-toggle="modal" data-bs-target="#edit_sub_sub_categories" class="edit_sub_subcategory" ></a>
                                    <a  class="ml-5"><img src="assets/img/icons/delete.png" alt="" data-id="{{$users->id}}" class="delete_sub_subcategory" ></a>

                                </td>
                                
                              </tr>
                             @endforeach
                            
                        </thead>
                
                    </table>
                </div>
            </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->

</div>
<!-- / Content -->
<!-- Edit User Modal -->

<div class="modal fade" id="add_sub_sub_categories" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Add sub SubCategory </h3>
          <ul class="alert-danger"></ul>
          <!-- <p>Updating user details will receive a privacy audit.</p> -->
        </div>
      
        <form id="add_sub_subcategory_form"  class="row g-3">
        

            <div class="col-12 col-md-12">
                <div class="form-group">
                    <div class="prof_upload text-center">

                        


                      

                     

                    </div>
                </div>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserFirstName">Sub Subcategory Name</label>
            <input type="text" id="name" name="name" class="form-control"  required>
          </div>
        
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserStatus">Status</label>
            <select id="modalEditUserStatus" name="status" class="form-select" aria-label="Default select example">
              <option selected=""></option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserStatus">Category</label>
            <select id="modalEditUserStatus" name="category" class="form-select" aria-label="Default select example">
                @foreach($category as $cat)
            
              <option value="{{$cat->id}}">{{$cat->name}}</option>
              @endforeach
            
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserStatus">SubCategory</label>
            <select id="modalEditUserStatus" name="sub_category" class="form-select" aria-label="Default select example">
            <option selected=""></option>
                @foreach($subcategory as $sub)
             
              <option value="{{$sub->id}}">{{$sub->sub_category}}</option>
              @endforeach
            
            </select>
          </div>
          

          <div class="col-12 col-md-12">
            <label class="form-label" for="modalEditUserStatus">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="5" required></textarea>
          </div>

         
       
      
          <div class="col-12 text-center mt-4">
            <button type="button" class="btn btn-primary me-sm-3 me-1" id="sub_sub_category_submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
     
        </form>

        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_sub_sub_categories" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Edit sub Category </h3>
          <ul class="alert-danger"></ul>
          <!-- <p>Updating user details will receive a privacy audit.</p> -->
        </div>
     
        <form id="edit_sub_subcategory_form"  class="row g-3">
       <input type="hidden" name="sub_subcategory_id" id="sub_subcategory_id" value="">
            <div class="col-12 col-md-12">
                <div class="form-group">
                    <div class="prof_upload text-center">

                        

                     

                    </div>
                </div>
          </div>
           
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserFirstName"> Name</label>
            <input type="text" id="sub_subcategory_name" name="sub_subcategory_name" class="form-control" value="" required>
          </div>
        
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserStatus">Status</label>
            <select id="sub_subcategory_status" name="sub_subcategory_status" class="form-select" aria-label="Default select example">
              <!-- <option selected=""></option>
              @if(!empty($data))
              <option value="1" {{($data->status==1)?'selected':''}}>Active</option>
              <option value="0" {{($data->status==0)?'selected':''}}>Inactive</option>
              @else
              <option value="1">Active</option>
              <option value="0">Inactive</option>
              @endif -->
            </select>
          </div>
    
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserStatus">Category</label>
            <select id="sub_main_category" name="main_category" class="form-select" aria-label="Default select example">
                <!-- @foreach($category as $cat)
                 @if(!empty($data))
              <option value="{{$cat->id}}"{{($cat->id==$data->category_id)?'selected':''}} >{{$cat->name}}</option>
                 @else
                 <option value="{{$cat->id}}">{{$cat->name}}</option>
                 @endif
              
              @endforeach -->
            
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserStatus">Sub Category</label>
            <select id="main_sub_category" name="main_sub_category" class="form-select" aria-label="Default select example">
            
            <!-- @foreach($subcategory as $sub)
             
             <option value="{{$sub->id}} {{($sub->id==$data->subcategory_id)?'selected':''}}">{{$sub->sub_category}}</option>
             @endforeach -->
            
            </select>
          </div>

          <div class="col-12 col-md-12">
            <label class="form-label" for="modalEditUserStatus">Description</label>
            <textarea name="sub_subcategory_description" class="form-control" id="subcategory_description" cols="30" rows="5" required>{{$data->description}}</textarea>
          </div>

         
       
      
          <div class="col-12 text-center mt-4">
            <button type="button" class="btn btn-primary me-sm-3 me-1" id="sub_sub_category_update">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
     
        </form>

        
      </div>
    </div>
  </div>
</div>

<!--/ Edit User Modal -->

<script>
        function readEditURL(input) {
            var val = $('.pr_img').val().toLowerCase(),
                regex = new RegExp("(.*?)\.(jpg|jpeg|png|gif|bmp|webp)$");
            if (!(regex.test(val))) {
                $('.pr_img').val('');
                $('.error_image').css('display', 'block');
                return false;
            } else {
                $('.error_image').css('display', 'none');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#setImage').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    </script>

@endsection
