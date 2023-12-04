@extends('include.master')
@section('content')
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row g-4">
   
            <div class="col-12">

            <div class="tex_end mb-3 pb-0">
                <button class="btn btn-blue " data-bs-toggle="modal" data-bs-target="#add_article">Add Article</button>
            </div>
          
                <!-- Role Table -->
                <div class="card">
                    
              
                    <div class="card-datatable table-responsive pb-0">
                   
                        <table class="datatables-users  table common_table articles_table" valign="top">
                            <thead>
        
                                <tr>
                                    <th>S.no</th>
                                    <th>Image</th>
                                    <th class="red">Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count=1;
                                ?>
                                @foreach($article as $art)
                                 <tr>
                                    <td valign="top">{{$count++}}</td>
                                    @if(!empty($art->image))
                                    <td valign="top" class="img-article"><img src="{{url('uploads/articles/'.$art->image)}}"></td>
                                    @else
                                    <td valign="top"  class="img-article"><img src=""></td>


                                    @endif


                                    
                                    <td valign="top">{{$art->title}}</td>
                                
                                    <td>
                                        <p class="mb-0 break_line">
                                        <?php
                                        $explode = array_slice(explode(' ', $art->description ), 0, 30);
                                        $implode = implode(" ",$explode); 
                                        ?> 
                                       {!! $implode !!}
                                        </p>
                                    </td>
                                
                                    <td valign="top" class="edit_icons">
                                            <a  ><img src="assets/img/icons/view.png" alt=""     data-bs-toggle="modal" data-id="{{$art->id}}" data-bs-target="#view_article" class="article_view"></a>
                                            <a  class="ml-2"><img src="assets/img/icons/edit.png" alt="" data-bs-toggle="modal" data-id="{{$art->id}}"data-bs-target="#edit_article" class="article_edit"></a>
                                            <a  class="ml-2"><img src="assets/img/icons/delete.png" alt="" data-id="{{$art->id}}" class="article_delete"></a>
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


    <!-- Edit popup -->
    <div class="modal fade" id="edit_article" tabindex="-1" aria-hidden="true" aria-labelledby="editUserLabel" >
       <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                    <h3>Edit Articles </h3>
                    <ul class="alert-danger"></ul>

                
                    </div>
                    
                    <form id="update_article" class="row g-3">
                        <!-- @csrf -->
                        <input type="hidden" name="article_id" id="article_id" value="">
                       
                    
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">Title</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">Description</label>
                            <textarea name="art_description" class="ckeditor form-control" id="art_description" cols="30" rows="2"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductImage">Upload Image</label>
                            <input type="file" id="image" name="image" class="form-control" placeholder="">
                        </div>
                       
                        <div class="col-12 text-center mt-4">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" id="article_update">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- View popup --> 
     <div class="modal fade" id="view_article" tabindex="-1" aria-hidden="true" aria-labelledby="viewUserLabel" >
       <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>View Articles Information</h3>
                    </div>   
                    <div >
                    <div class="img_article-popup">
                            <img  id="img" alt="">
                            </div>
                            <h2 class="text-center blog-title-pop" id="title"></h2>
                            <p class="text-center" id="article_description"></p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_article" tabindex="-1" aria-hidden="true" aria-labelledby="editUserLabel" >
       <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                    <h3>add Articles Information</h3>
                    <ul class="alert-danger"></ul>
                
                    </div>
                    <form id="article_add_Form" class="row g-3">
                        <!-- @csrf -->
                        <input type="hidden" name="user_id" id="user_id" value="">
                       
                    
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductName">Description</label>
                            <textarea  id="description" name="description" cols="30" rows="2" class="ckeditor form-control"></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="modalEditProductImage">Upload Image</label>
                            <input type="file" id="image" name="image" class="form-control" placeholder="">
                        </div>
                       
                        <div class="col-12 text-center mt-4">
                            <button type="button" class="btn btn-primary me-sm-3 me-1" id="article_submit">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="close">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    // $(document).ready(function() {
    //    $('.ckeditor').ckeditor();
    // });

    CKEDITOR.replace( 'description' ); 
</script>
@endsection