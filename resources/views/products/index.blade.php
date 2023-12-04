@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">

    <!-- Role cards -->
    <div class="row g-4">
        <div class="col-12">
        <div class="tex_end mb-3 pb-0">
        <a href="{{url('file-import')}}"><button class="btn btn-blue " data-bs-toggle="modal" data-bs-target="#add_product">Import</button></a>

                <button class="btn btn-blue " data-bs-toggle="modal" data-bs-target="#add_product">Add Product</button>
            </div>
            <!-- Role Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                <table class="table" id="table">
                        <thead>
                            <tr>
                                <th>S.no</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Loyality Points</th>
                                <th>Actions</th>
                            </tr>
                        
                         
                        </thead>
                    </table>
                </div>
            </div>
<div class="modal fade" id="add_product" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Add Product Information</h3>
          <ul class="alert-danger"></ul>

        </div>
        <form id="add_product_form" class="row g-3">
 
          <input type="hidden" id="product_id" name="product_id" value="">
          <div class="col-12">
            <label class="form-label" for="modalEditProductName">Product Name</label>
            <input type="text" id="modalEditProductName" name="product_name" id="product_name" class="form-control" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductName">Price</label>
            <input type="text" id="modalEditProductName" name="product_price" id="product_price" class="form-control" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductDescr">Product Description</label>
            <textarea name="product_description" cols="30" rows="3" class="form-control" id="product_description"></textarea>
          </div>    
          <div class="col-12">
            <label class="form-label" for="modalEditProductCategories">Product Categories</label>
            <select id="product_category" name="product_category" class="form-select" aria-label="Default select example">
            <option selected="">select category</option>
            @foreach($category as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
            @endforeach
     
            </select>
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductImage">Product Image</label>
            <input type="file" id="product_image" name="product_image[]" multiple class="form-control" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductImage">Product Image</label>
            <img  width="200" id="preview-image-before-upload" style="display:none">
          </div>
          
          <div class="col-12">
            <label class="form-label" for="modalEditProductstatus">Status</label>
            <select id="product_status" name="product_status" class="form-select" aria-label="Default select example">
              
              <option value="1">active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div class="col-6">
            <label class="form-label" for="modalEditProductstatus">Add Variation</label>
            <input type="checkbox" placeholder="" class="checkbox">           
          </div>
          <div class="append">
          <input type="hidden" class="count_var_name" value="1" name="count_var_name">
          <div class="addmore-section" style="display: none;">
          <div class="col-12 mb-3">
           
            <div class="addmorebtn-part">
              <button type="button" class="add_inputs"><i class="menu-icon tf-icons bx bx-plus" ></i></button>
              <!-- <button type="button" class="minus-red"><i class="menu-icon tf-icons bx bx-minus"></i></button> -->
            </div>
          <label class="form-label" >Product Variation Name</label>
            <input type="text" id="product_var_name" class="form-control var_name" placeholder="Product Variation Name" name="product_var_name_0">
          </div>
          <div class="col-12">
            <label class="form-label" >Product Variation Image</label>
            <input type="file" id="product_var_image" name="product_var_image_0[]" multiple class="form-control" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" >Price</label>
            <input type="text" id="product_var_price" name="product_var_price_0" class="form-control" placeholder="">
          </div>
          </div>
          </div>
        
         
  
                <div class="col-12 text-center mt-4">
                  <button type="button" class="btn btn-primary me-sm-3 me-1" id="product_submit">Submit</button>
                  <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
            <!--/ Role Table -->
        </div>
    </div>
    <!--/ Role cards -->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {

    $.noConflict();
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('productAll') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image', name: 'image'},
           
            {data: 'name', name: 'name'},
            
            {data: 'category_name', name: 'category'},
            
            {data: 'price', name: 'price'},
            {data: 'points', name: 'Loyality Points'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


   
    
  });

  function myfunction(){
    
var olddata=document.getElementById("container").lastChild;
document.getElementById("container").removeChild(olddata);
    $(this).remove()
  }
</script>
<!-- / Content -->
@endsection
