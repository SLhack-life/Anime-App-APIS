@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y category_view">
    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-xl-8 col-lg-8 col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class=" d-flex align-items-center flex-column">
                            
                            <!-- @if($data->image!=null||$data->image!="null")
                            <img class="img-fluid rounded my-4" src="{{asset('uploads/sub_category/' .$data->image)}}" height="110" width="110" alt="User avatar">
                            @endif -->
                            <div class="user-info text-center">
                            <h5 class="mb-2">{{$data->name}}</h5>
                            
                            </div>
                        </div>
                    </div>

                    <h5 class="pb-2 border-bottom mb-4">Details</h5>
                    <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                        <span class="fw-bold me-2">Sub Category Name:</span>
                        <span>{{$data->sub_category}}</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">SubCategory Description:</span>
                        <span>{{$data->description}} </span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">Status:</span>
                        @if($data->status==1)
                        <span class="badge bg-label-success">Active</span>
                        @else
                        <span class="badge bg-label-danger">InActive</span>
                       @endif
                        </li>

                    </ul>
                    <!-- <div class="d-flex justify-content-center pt-3">
                        <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                    </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Role cards -->

</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Edit Category Information</h3>
        </div>
        <form id="editUserForm" class="row g-3" onsubmit="return false">
          <div class="col-12">
            <label class="form-label" for="modalEditCategoryName">Category Name</label>
            <input type="text" id="modalEditCategoryName" name="modalEditCategoryName" class="form-control" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditCategorydescr">Category Description</label>
            <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditcategoryImage">Category Image</label>
            <input type="file" id="modalEditcategoryImage" name="modalEditcategoryImage" class="form-control" >
          </div>
          
          <div class="col-12">
            <label class="form-label" for="modalEditCategoryStatus"> Category Status</label>
            <select id="modalEditCategoryStatus" name="modalEditCategoryStatus" class="form-select" aria-label="Default select example">
              <option selected="">Status</option>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
          <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ Edit User Modal -->
<!-- / Content -->
@endsection
