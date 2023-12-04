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
                        <div class=" d-flex align-items-center flex-column">Order id:
                          {{$data->order_id}}
                            <!-- <img class="img-fluid rounded my-4" src=" "height="110" width="110" alt="User avatar"> -->
                            <div class="user-info text-center">
                            <h5 class="mb-2"></h5>
                            <span class="badge bg-label-secondary"></span>
                            </div>
                        </div>
                    </div>

                    <h5 class="pb-2 border-bottom mb-4"></h5>
                    <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                        <span class="fw-bold me-2"></span>
                        <span>Product</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2"></span>
                        <span>One</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2"></span>
                       
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2"></span>
                         @if($data->status==0)
                        <span class="badge bg-label-success"> Order Placed</span>
                        @endif
                     
                  
                        </li>
                      
                       
                    </ul>
                    <div class="d-flex justify-content-center pt-3">
                        <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                    </div>
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
          <h3>Edit Product Information</h3>
          <ul class="alert-danger"></ul>

        </div>
        <form id="editUserForm" class="row g-3">
 
          <input type="hidden" id="product_id" name="product_id" value="">
          <div class="col-12">
            <label class="form-label" for="modalEditProductName">Product Name</label>
            <input type="text" id="modalEditProductName" name="product_name" id="product_name" class="form-control" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductDescr">Product Description</label>
            <textarea name="product_description" cols="30" rows="3" class="form-control" id="product_description"></textarea>
          </div>    
          <div class="col-12">
            <label class="form-label" for="modalEditProductCategories">Product Categories</label>
            <select id="product_category" name="product_category" class="form-select" aria-label="Default select example">
            
              <option selected=""></option>
             
              <option value=""></option>
            

     
            </select>
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductImage">Product Image</label>
            <input type="file" id="product_image" name="product_image" class="form-control" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductstatus">Status</label>
            <select id="product_status" name="product_status" class="form-select" aria-label="Default select example">
              
              <option value="1">active</option>
              <option value="0">Inactive</option>
            </select>
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
            <button type="button" class="btn btn-primary me-sm-3 me-1" id="product_submit">Submit</button>
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
