@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-12">

            <div class="abosul_add_btn text-end mb-3 pb-0">
                    <button data-bs-toggle="modal" data-bs-target="#addcategories" class="btn btn-blue">Add </button>
            </div>


            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                <!-- datatables-users -->
                <table class="datatables-users  table border-top table_details position-relative">
                  
                        <thead>
                            <tr>
                            <th>S.NO</th>
                                <th>Name</th>
                                <th>sallary</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                           
                            
                        </thead>
                        <tbody>
                                <?php
                                $count=1;
                                ?>
                                @foreach($workers as $worker)
                                 <tr>
                                    <td valign="top">{{$count++}}</td>
                                
                                   
                                   
                                    


                               


                                    
                                    <td valign="top">{{$worker->name}}</td>
                                
                                    <td valign="top">{{$worker->sallary}}</td>
                                    @if($worker->status==0)
                                    <td valign="top">InActive<td>
                                   
                                    @else
                                    <td valign="top">Active<td>
                                    @endif
                                    <td valign="top" class="edit_icons">
                                            <a  ><img src="assets/img/icons/view.png" alt=""     data-bs-toggle="modal" data-id="{{$worker->id}}" data-bs-target="#view_article" class="article_view"></a>
                                            <a  class="ml-2"><img src="assets/img/icons/edit.png" alt="" data-bs-toggle="modal" data-id="{{$worker->id}}"data-bs-target="#edit_article" class="article_edit"></a>
                                            <a  class="ml-2"><img src="assets/img/icons/delete.png" alt="" data-id="{{$worker->id}}" class="article_delete"></a>
                                    </td>
                                 
                                </tr>
                              
                                @endforeach
                            </tbody>
                
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
<div class="modal fade" id="addcategories" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Add Worker </h3>
          

          <!-- <p>Updating user details will receive a privacy audit.</p> -->
        </div>
        <ul class="alert-danger"></ul>
        <form action="{{url('add_worker')}}"  class="row g-3" method="POST">
        @csrf

            <div class="col-12 col-md-12">
                <div class="form-group">
                    <div class="prof_upload text-center">

                           


                        

                     

                    </div>
                </div>
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserFirstName"> Name</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="John" required>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserFirstName"> sallary</label>
            <input type="text" id="name" name="sallary" class="form-control" placeholder="John" required>
          </div>
        
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalEditUserStatus">Status</label>
            <select id="modalEditUserStatus" name="status" class="form-select" aria-label="Default select example">
              <option selected=""></option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <!-- <div class="col-12 col-md-12">
            <label class="form-label" for="modalEditUserStatus">Description</label>
            <textarea name="description" class="form-control" id="description" cols="30" rows="5" required></textarea>
          </div> -->

         
       
      
          <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
     
        </form>

        
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_category" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Edit Category Information</h3>
          <ul class="alert-danger"></ul>
        </div>
        <form id="edit_category_form" class="row g-3">
          <input type="hidden" name="category_id" id="category_id" value="">
          <div class="col-12">
            <label class="form-label" for="modalEditCategoryName">Category Name</label>
            <input type="text" id="cat_name" name="name" class="form-control" value="" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditCategorydescr">Description</label>
            <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
          </div>
        
          
          <div class="col-12">
            <label class="form-label" for="modalEditCategoryStatus"> Category Status</label>
            <select name="status" id="cat_status" class="form-select" aria-label="Default select example">
          
            </select>
          </div>
          <div class="col-12 text-center mt-4">
            <button type="button" class="btn btn-primary me-sm-3 me-1" id="category_edit">Submit</button>
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
