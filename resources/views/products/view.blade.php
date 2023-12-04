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
                    <div id="swiper-gallery">
                        <div class="swiper-container gallery-top">
                          <div class="swiper-wrapper">
                          @if($product!=null)
                          @if (str_contains($product->image_detail[0]->image, 'https'))
                          <div class="swiper-slide" style="background-image:url('{{$product->image_detail[0]->image}}')"></div>
                          @else
                            <div class="swiper-slide" style="background-image:url('{{ asset('uploads/product-images/'.$product->image_detail[0]->image) }}')"></div>
                          @endif
                          @endif
                          </div>
                          <!-- Add Arrows -->
                          <div class="swiper-button-next swiper-button-white"></div>
                          <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                          <div class="swiper-wrapper">
                            @if(count($product->image_detail)>0)
                            @foreach($product->image_detail as $img)
                            @if (str_contains($img, 'https')) {
                            <div class="swiper-slide" style="background-image:url('{{ $img->image }}')"></div>
                            @else
                            <div class="swiper-slide" style="background-image:url('{{asset('uploads/product-images/'.$img->image) }}')"></div>
                            @endif
                            @endforeach
                            
                          @endif
                          </div>
                        </div>
                      </div>
                    </div>

                    <h5 class="pb-2 border-bottom mb-4">{{$product->short_description}}</h5>
                    <div class="info-container">
                    <ul class="list-unstyled">
                        <li class="mb-3">
                        <span class="fw-bold me-2">{{$product->name}}</span>
                        <span>Product</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">Product Category:</span>
                        <span>{{$product->category_name}}</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">Loyality points:</span>
                        <span>{{$product->points}}</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">{{$product->long_description}}</span>
                       
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">Product Status</span>
                        @if($product->status==1)
                        <span class="badge bg-label-success">Active</span>
                        @else
                        <span class="badge bg-label-success">Active</span>
                        @endif
                        </li>
                      
                       
                    </ul>
                    @if($variant!="empty")
                    <div class="d-flex justify-content-center pt-5">
                      <h4>Variant</h4>
                    </div>
                    @foreach($variant as $var)
                    <ul class="list-unstyled mt-5">                     
                        <li class="mb-3">
                        <span class="fw-bold me-2 mt-4">Variant name</span>
                        <span>{{$var->var_name}}</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">variant price:</span>
                        <span>{{$var->var_price}}</span>
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">variant image:</span>
                        @foreach($var->variant_image_detail as $vari_images)
                        <div class="variant_img">
                        <img src="{{asset('uploads/product-images/'.$vari_images->image)}}" width="100">
                        </div>
                        @endforeach
                        </li>                                                     
                    </ul>
                  @endforeach
                    @endif
                    <div class="d-flex justify-content-center pt-3">
                        <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#edit_product" data-bs-toggle="modal">Edit</a>
                        <a  class="btn btn-primary me-3 delete_product" data-id="{{$product->id}}">Delete</a>

                    </div>
                    </div>
                </div>
            </div>
  
        </div>
    </div>
    <!--/ Role cards -->

</div>

<!-- Edit User Modal -->
<div class="modal fade" id="edit_product" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Edit Product Information</h3>
          <ul class="alert-danger"></ul>

        </div>
        <form id="edit_product_form" class="row g-3">
         <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}">
         
          <div class="col-6">
            <label class="form-label" for="modalEditProductName">Product Name</label>
            <input type="text" id="modalEditProductName" name="product_name" id="product_name" class="form-control"  value="{{$product->name}}" placeholder="">
          </div>
          <div class="col-6">
            <label class="form-label" for="modalEditProductName">Product price</label>
            <input type="text" id="modalEditProductName" name="product_price" id="product_price" class="form-control"  value="{{$product->price}}" placeholder="">
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductDescr">Product Description</label>
            <textarea name="product_description" cols="30" rows="3" class="form-control" id="product_description" >{{$product->long_description}}</textarea>
          </div>    
          <div class="col-12">
            <label class="form-label" for="modalEditProductCategories">Product Categories</label>
            <select id="product_category" name="product_category" class="form-select" aria-label="Default select example">
           
            @foreach($category as $cat)
              <option value="{{$cat->id}}" {{$product->category_id==$cat->id?'selected':' '}}>{{$cat->name}}</option>
            @endforeach

     
            </select>
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductImage">Product Main Image</label>
            <input type="file" id="main_product_image" name="main_product_image" class="form-control" placeholder="">
            <div id="preview-img">
              @if(str_contains($product->image,'https'))
              <img id="preview-image-edit-upload" src="{{$product->image}}" width="100">
              @else

               <img id="preview-image-edit-upload" src="{{asset('uploads/product-images/'.$product->image)}}" width="100">
              @endif
            </div>
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductImage">Product  Images</label>
            <input type="file"  name="product_image[]" multiple class="form-control" placeholder="" >
            <div class="images-preview-div">
              @foreach($product->image_detail as $imgs)
              @if(str_contains($imgs,'https'))
              <img src="{{$imgs->image}}" width="200">
               <button type="button" data-id="{{$imgs->id}}" class="btn btn-primary del_imgs" >Close</button>
              @else
              <img src="{{asset('uploads/product-images/'.$imgs->image)}}" width="100">

               <button type="button" data-id="{{$imgs->id}}" class="btn btn-primary del_imgs" >Close</button>
              @endif
              @endforeach

            </div>
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductstatus">Status</label>
            <select id="product_status" name="product_status" class="form-select" aria-label="Default select example">
              
              <option value="0" {{$product->status==0?'selected':' '}}>active</option>
              <option value="1" {{$product->status==1?'selected':' '}}>Inactive</option>
            </select>
          </div>
        
        
         
          @if($variant!="empty")
                    <div class="d-flex justify-content-center pt-5">
                      <h4>Variant</h4>
                      <input type="hidden" name="total_var" value="{{count($variant)}}">
                    </div>
                    <?php $county=0; ?>
                    @foreach($variant as $var)
                    <ul class="list-unstyled mt-5">                     
                        <li class="mb-3">
                        <span class="fw-bold me-2 mt-4">Variant name</span>
                        <!-- <span>{{$var->var_name}}</span> -->
                        <input type="hidden" value="{{$var->id}}" name="var_id_{{$county}}">

                        <input type="text" value="{{$var->var_name}}" name="var_name_{{$county}}">
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">variant price:</span>
                        <input type="text" value="{{$var->var_price}}" name="var_price_{{$county}}">

                        <!-- <span>{{$var->var_price}}</span> -->
                        </li>
                        <!-- <button type="button" data-id="{{$var->id}}" class="btn btn-primary edit_var_prod" data-bs-toggle="modal" data-bs-target="#edit_var_product">Edit</button> -->
                        <li class="mb-3">
                        <span class="fw-bold me-2">variant Image:</span>
                        <?php $count=0; ?>
                        @foreach($var->variant_image_detail as $vari_image)
                        @if($count==0)
                        <input type="file" value="{{$vari_images->image}}" class="form-control" name="variant_imgs_{{$county}}[]" multiple>
                        @endif
                        <?php $count++; ?>
                        @endforeach

                        <!-- <span>{{$var->var_price}}</span> -->
                        </li>
                        <li class="mb-3">
                        <span class="fw-bold me-2">variant image:</span>
                        @foreach($var->variant_image_detail as $vari_images)
                        <div class="variant_img">
                        <img src="{{asset('uploads/product-images/'.$vari_images->image)}}" width="100">
                        <button type="button" class="btn btn-primary delete_var_image" data-id="{{$vari_images->id}}">Delete</button>
                        </div>
                        @endforeach
                        </li>                                                     
                    </ul>
                    <?php $county++; ?>
                  @endforeach
                    @endif
                    
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
            <button type="button" class="btn btn-primary me-sm-3 me-1" id="edit_product_submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit_var_product" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-edit-user">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3>Edit Product variant Information</h3>
          <ul class="alert-danger"></ul>

        </div>
        <form id="edit_var_product_form" class="row g-3">
 
          <input type="hidden" id="product_var_id" name="product_var_id" value="">
          <div class="col-12">
            <label class="form-label" for="modalEditProductName">Product Name</label>
            <input type="text"  name="product_var_name" id="product_varing_name" class="form-control product_varing_name" >
          </div>
          <div class="col-12">
            <label class="form-label" for="modalEditProductName">Price</label>
            <input type="text" id="modalEditProductName" name="product_var_price" id="product_price" class="form-control" placeholder="">
          </div>
           
          
          <div class="col-12">
            <label class="form-label" for="modalEditProductImage">Product Image</label>
            <input type="file" id="product_image" name="product_image[]" multiple class="form-control" placeholder="">
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
<!--/ Edit User Modal -->
<!-- / Content -->


@endsection
