<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/ui-carousel.js') }}"></script>


<script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
<script src="//code.jquery.com/jquery-1.12.3.js"></script>

<!-- endbuild -->

<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>



<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js1"></script>



<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css1">

<!-- Vendors JS -->
<!-- <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script> -->
<!-- <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script> -->

<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/app-access-roles.js') }}"></script>
<script src="{{ asset('assets/js/modal-add-role.js') }}"></script>




<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->





<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>


<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/charts-apex.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // $('.toggle_btn').click(function() {
    //               alert("asdd");
    // });
    // $('.toggle_btn').click(function() {
    //       alert("asdd");


    // var id = $(this).data('id');
    // // alert(id);
    // //   var user_id = $(this).attr('data-id');
    //   // console.log(status);
    // $.ajax({
    //     type: "POST",
    //     dataType: "json",
    //     url: "{{url('change_status')}}",
    //     data: {

    //         'id': id,
    //         "_token": "{{ csrf_token() }}",
    //     },
    //     success: function(data) {

    //   // if (data == 1) {
    //   //     $('.user-active').text('Active');
    //   // } else {
    //   //     $('.user-active').text('Inactive');
    //   // }
    //           // console.log(data.msg);
    //         //   $('.user-active').text(data.msg);
    //         //  $('.guard_active').text(data.guard);
    //         // //  console.log(data.success)
    //           console.log(data)

    //     }
    // });
    // });
    $('.edit_btn').click(function() {

      var id = $(this).data('id');

      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "{{url('edit_user')}}",
        data: {
          // 'status': status,
          'id': id,
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {


          // if (data == 1) {
          //     $('.user-active').text('Active');
          // } else {
          //     $('.user-active').text('Inactive');
          // }
          // console.log(data.msg);
          //   $('.user-active').text(data.msg);
          //  $('.guard_active').text(data.guard);
          // //  console.log(data.success)
          $('#editUser').css({
            "display": "block",
            "opacity": "1"
          });
          $('#user_id').val(data.id);
          $('#name').val(data.user_name);
          $('#image').val(data.image);


        }
      });
    });
    $('#submit').click(function() {


      // var id = $('#user_id').val();

      let form = $('#codeForm');

      data = new FormData(form[0]);
      alert(data);

      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('user/update')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(data) {


          swal({
            title: 'Awesome !',
            text: 'form submitted successfully !',
            type: 'success'
          });
          $('#editUser').css({
            "display": "none",
            "opacity": "0"
          });

          // if (data == 1) {
          //     $('.user-active').text('Active');
          // } else {
          //     $('.user-active').text('Inactive');
          // }
          // console.log(data.msg);
          //   $('.user-active').text(data.msg);
          //  $('.guard_active').text(data.guard);
          // //  console.log(data.success)
          // $('#editUser').css({"display": "block", "opacity": "1"});
          // $('#user_id').val(data.id);
          // $('#name').val(data.user_name);
          // $('#image').val(data.image);


        }
      });
    });
    $('#product_submit').click(function() {
     


      // var id = $('#user_id').val();

      let form = $('#add_product_form');

      data = new FormData(form[0]);


      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('add/product')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
          
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              // $('#add_product').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            $('.alert-danger').hide();
            $('#open').hide();
            $('#add_product').css('display', 'none');
            window.location = "products";
          }

          // if (data == 1) {
          //     $('.user-active').text('Active');
          // } else {
          //     $('.user-active').text('Inactive');
          // }
          // console.log(data.msg);
          //   $('.user-active').text(data.msg);
          //  $('.guard_active').text(data.guard);
          // //  console.log(data.success)
          // $('#editUser').css({"display": "block", "opacity": "1"});
          // $('#user_id').val(data.id);
          // $('#name').val(data.user_name);
          // $('#image').val(data.image);


        }
      });
    });
    $('#edit_product_submit').click(function() {


      // var id = $('#user_id').val();

      let form = $('#edit_product_form');

      data = new FormData(form[0]);


      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('edit/product')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#edit_product').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            window.location.href = "{{ route('productAll')}}";
          }


          // if (data == 1) {
          //     $('.user-active').text('Active');
          // } else {
          //     $('.user-active').text('Inactive');
          // }
          // console.log(data.msg);
          //   $('.user-active').text(data.msg);
          //  $('.guard_active').text(data.guard);
          // //  console.log(data.success)
          // $('#editUser').css({"display": "block", "opacity": "1"});
          // $('#user_id').val(data.id);
          // $('#name').val(data.user_name);
          // $('#image').val(data.image);


        }
      });
    });
    $('#article_submit').click(function() {
      var ck = CKEDITOR.instances.description.getData();
     

      // var id = $('#user_id').val();

      let form = $('#article_add_Form');
      

      data = new FormData(form[0]);
      data.append('input',ck);


      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('add/article')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#add_article').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            $('.alert-danger').hide();
            $('#open').hide();
            $('#add_article').css('display', 'none');
            window.location = "articles_view";
          }

      

        }
      });
    });
    $('.edit_btn').click(function() {

      var id = $(this).data('id');

      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "{{url('edit_user')}}",
        data: {
          // 'status': status,
          'id': id,
          "_token": "{{ csrf_token() }}",
        },
        success: function(data) {


  
          $('#editUser').css({
            "display": "block",
            "opacity": "1"
          });
          $('#user_id').val(data.id);
          $('#name').val(data.user_name);
          $('#image').val(data.image);


        }
      });
    });
    $('.article_view').click(function() {


      var id = $(this).data('id');

      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('view/article')}}",
        data: {
          id: id
        },

        success: function(data) {


          if (data.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#editUser').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            // console.log(data.data.title);
            $('.alert-danger').hide();
            $('#open').hide();
            $('#view_article').modal('show');
            var url = 'https://goserver.space/flowrolls/public/uploads/articles/' + data.data.image;
            $("#img").attr("src", url);
            $('#title').html(data.data.title);
            $('#article_description').html(data.data.description);


            // window.location="articles_view";
          }

         


        }
      });
    });


    $('.article_edit').click(function() {


      var id = $(this).data('id');
      $('#article_id').val(id);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('edit/article')}}",
        data: {
          id: id,
        },

        success: function(result) {
          CKEDITOR.instances.art_description.setData(result.data.description);

          $('.alert-danger').hide();
          $("#name").val(result.data.title);
          $('#edit_article').modal('show');


        }
      });



    });

    $('.article_delete').click(function() {

      var a=confirm("Do you want to delete this item?");
      if(a){
      var id = $(this).data('id');

      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('delete/article')}}",
        data: {
          id: id,
        },

        success: function(result) {

          window.location = "articles_view";


     






        }
      });
    }



    });


    $('#category_submit').click(function() {



      // var id = $('#user_id').val();

      let form = $('#add_category_form');


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
        url: "{{url('add/category')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#addcategories').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            $('.alert-danger').hide();
            $('#open').hide();
            $('#addcategories').modal('hide');
            window.location.href = "categories";
            showToastr('success', 'Success!', "category added successfully").fadeOut(7000);
          }




        }
      });
    });
    $('#category_edit').click(function() {

      // var id = $('#user_id').val();

      let form = $('#edit_category_form');


      data = new FormData(form[0]);


      //   var user_id = $(this).attr('data-id');
      // console.log(status);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('edit/category')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
          
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#addcategories').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            // window.location.href = "{{ route('index')}}";
            $('#edit_category').modal('hide');
            setInterval('location.reload()', 2000);
            
            
           showToastr('success', 'Success!', "data edit ssssuccessfully").fadeOut(1000);

            
           
          

           
        
          
          }

   

        }
      });
    });


    $('.category_edite').click(function() {
      var id = $(this).data('id');

      $('#category_id').val(id);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('edite/category')}}",
        data: {
          id: id,
        },

        success: function(result) {
          console.log(result.data.name);
          // console.log(result.data.sub_category);
          $('.alert-danger').hide();
          $('#category_id').val(result.data.id);
          $("#cat_name").val(result.data.name);
          $('#description').val(result.data.description);
          $("#cat_status").html('<option value="1" '+(result.data.status==1 ? 'selected' : '')+'>Active</option>'+
          '<option value="0" '+(result.data.status==0 ? 'selected' : '')+'>InActive</option>'
          
          
          );


         
             

        }
      });



    });




    $('#sub_category_submit').click(function() {



      // var id = $('#user_id').val();

      let form = $('#add_subcategory_form');


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
        url: "{{url('add/sub_category')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#add_sub_categories').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            $('.alert-danger').hide();
            $('#open').hide();
            $('#add_sub_categories').modal('hide');
            setInterval('location.reload()', 2000);
      
            window.location.href = "sub_category";
           showToastr('success', 'Success!', "data added ssssuccessfully").fadeOut(1000);

          }

      

        }
      });
    });
    $('.edit_subcategory').click(function() {
      var id = $(this).data('id');

      $('#subcategory_id').val(id);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('edit/subcategory')}}",
        data: {
          id: id,
        },

        success: function(result) {
          // console.log(result.data.sub_category);
         
          

           


          $('.alert-danger').hide();

          $('#edit_sub_categories').modal('show');
          $("#subcategory_name").val(result.data.sub_category);
          $('#subcategory_description').val(result.data.description);
          $("#subcategory_status").html('<option value="1" '+(result.data.status==1 ? 'selected' : '')+'>Active</option>'+
          '<option value="0" '+(result.data.status==0 ? 'selected' : '')+'>InActive</option>'
          
          
          );
          
           
        
          $("#subcategory_description").html(result.data.description);
          // $("#main_category").html('<option value="'+result.data.cat_id +'">'+result.data.sub_category+'</option>')
          $("#name").val(result.title);
          $('#main_category').empty();
          
          for(var k=0;k<result.category.length;k++){
           
            
            $('#main_category').append(
              '<option value="'+result.category[k].id+'"' + (result.category[k].id ===result.data.cat_id ? 'selected' : '') + '>'+result.category[k].name+'</option>'
 
            )
          }






        }
      });



    });
    $('.edit_sub_subcategory').click(function() {
      var id = $(this).data('id');

      $('#sub_subcategory_id').val(id);
      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('edit/sub_subcategory')}}",
        data: {
          id: id,
        },

        success: function(result) {
          console.log(result.data);
          // console.log(result.data.sub_category);
        
          

           


          $('.alert-danger').hide();

          $('#edit_sub_sub_categories').modal('show');
          $("#sub_subcategory_name").val(result.data.name);
          $('#subcategory_description').val(result.data.description);
          $("#sub_subcategory_status").html('<option value="1" '+(result.data.status==1 ? 'selected' : '')+'>Active</option>'+
          '<option value="0" '+(result.data.status==0 ? 'selected' : '')+'>InActive</option>'
          
          
          );
          
           
    
     
          $("#subcategory_description").html(result.data.description);
          // $("#main_category").html('<option value="'+result.data.cat_id +'">'+result.data.sub_category+'</option>')
          $("#name").val(result.title);
          $('#sub_main_category').empty();
          
          for(var k=0;k<result.category.length;k++){
           
          
             console.log(result.data.cat_id);
            
            $('#sub_main_category').append(
              '<option value="'+result.category[k].id+'"' + (result.category[k].id ===result.data.cat_id ? 'selected' : '') + '>'+result.category[k].name+'</option>'
 
            )
          }
          $('#main_sub_category').empty();
          
          for(var k=0;k<result.subcategory.length;k++){
           
          
             console.log(result.data.sub_cat_id);
            
            $('#main_sub_category').append(
              '<option value="'+result.subcategory[k].id+'"' + (result.subcategory[k].id ===result.data.sub_cat_id ? 'selected' : '') + '>'+result.subcategory[k].sub_category+'</option>'
 
            )
          }






        }
      });



    });

    $('#sub_category_update').click(function() {



      // var id = $('#user_id').val();

      let form = $('#edit_subcategory_form');


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
        url: "{{url('update/sub_category')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#add_sub_categories').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            // $('.alert-danger').hide();
            // $('#open').hide();
            // $('#add_sub_categories').modal('hide');
            window.location.href = "sub_category";
            showToastr('success', 'Success!', "data edit successfully") .fadeOut(4000);
            
          }

 ;


        }
      });
    });
    $('#sub_sub_category_update').click(function() {



// var id = $('#user_id').val();

let form = $('#edit_sub_subcategory_form');


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
  url: "{{url('update/sub_sub_category')}}",
  data: data,
  processData: false,
  contentType: false,
  success: function(result) {


    if (result.errors) {
      //$('.alert-danger').html('');

      $.each(result.errors, function(key, value) {
        $('#add_sub_categories').modal('show');
        $('.alert-danger').show();
        $('.alert-danger').append('<li>' + value + '</li>');
      });
    } else {
      // $('.alert-danger').hide();
      // $('#open').hide();
      // $('#add_sub_categories').modal('hide');
      window.location.href = "sub_subcategory";
      showToastr('success', 'Success!', "data edit successfully");
            setTimeout(showToastr, 2000);
    }

 

  }
});
});



    $('#sub_sub_category_submit').click(function() {



// var id = $('#user_id').val();

let form = $('#add_sub_subcategory_form');


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
  url: "{{url('add/sub_sub_category')}}",
  data: data,
  processData: false,
  contentType: false,
  success: function(result) {


    if (result.errors) {
      //$('.alert-danger').html('');

      $.each(result.errors, function(key, value) {
        $('#add_sub_sub_categories').modal('show');
        $('.alert-danger').show();
        $('.alert-danger').append('<li>' + value + '</li>');
      });
    } else {
      $('.alert-danger').hide();
      $('#open').hide();
      $('#add_sub_categories').modal('hide');
      showToastr('success', 'Success!', "data added successfully");
        
      window.location.href = "sub_subcategory";
    }

  


  }
});
});
$('#salary_submit').click(function() {


alert("hii")
// var id = $('#user_id').val();

let form = $('#add_worker_form');


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
  url: "{{url('add_worker')}}",
  data: data,
  processData: false,
  contentType: false,
  success: function(result) {


    if (result.errors) {
      //$('.alert-danger').html('');

      $.each(result.errors, function(key, value) {
        $('#add_sub_sub_categories').modal('show');
        $('.alert-danger').show();
        $('.alert-danger').append('<li>' + value + '</li>');
      });
    } else {
      $('.alert-danger').hide();
      $('#open').hide();
      $('#add_sub_categories').modal('hide');
      showToastr('success', 'Success!', "data added successfully");
        
      window.location.href = "sub_subcategory";
    }

  


  }
});
});


    $('#article_update').click(function() {
      var ck = CKEDITOR.instances.art_description.getData();
      let form = $('#update_article');

      data = new FormData(form[0]);
      data.append('input', ck);

      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('update/article')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              $('#add_article').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {
            $('.alert-danger').hide();
            $('#open').hide();
            $('#add_article').css('display', 'none');
            window.location = "articles_view";
          }

      


        }
      });
    });
    $('.category_delete').click(function() {


      var id = $(this).data('id');
      var a=confirm("Do you want to inactive this category?");
      if(a){
      var id = $(this).data('id');


      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('delete/category')}}",
        data: {
          id: id,
        },

        success: function(result) {

          window.location = "{{ route('index')}}";


      





        }
      });
    }



    });
    $('.delete_subcategory').click(function() {


      var id = $(this).data('id');
      var a=confirm("Do you want to inactive this Subcategory?");
      if(a){

      $.ajax({
        type: "POST",
        dataType: "json",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{url('delete/sub_category')}}",
        data: {
          id: id,
        },

        success: function(result) {

          window.location.href = "sub_category";


        }
      });
    }



    });
    $('.delete_sub_subcategory').click(function() {


var id = $(this).data('id');

$.ajax({
  type: "POST",
  dataType: "json",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: "{{url('delete/sub_sub_category')}}",
  data: {
    id: id,
  },

  success: function(result) {

    window.location.href = "sub_subcategory";







  }
});



});
$('.delete_product').click(function() {
  
  if(confirm("Are you sure you want to delete this?")){

var id = $(this).data('id');

$.ajax({
  type: "POST",
  dataType: "json",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: "{{url('delete/product')}}",
  data: {
    id: id,
  },

  success: function(result) {
    if(result.status==200){
      // window.location = "{{route('productAll')}}";
      // showToastr('success', 'Success!', "data delete successfully");
      //       setTimeout(showToastr(), 2000);
     
      setTimeout(function() {
        window.location = "{{route('productAll')}}";
                        }, 2000);
                        showToastr('success', 'Success!', "data delete successfully")
                            .fadeout(1000);

    }

  
 

    






  }
});
}



});

$('.delete_var_image').click(function() {


var id = $(this).data('id');

$.ajax({
  type: "POST",
  dataType: "json",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: "{{url('delete/product_var_imgs')}}",
  data: {
    id: id,
  },

  success: function(result) {
    if(result.status==200){
      
      showToastr('success', 'Success!', "image delete successfully");
            setTimeout(window.location.reload(), 2000);
     
      $('#edit_product').model('show');
    }







  }
});



});

$('.del_imgs').click(function() {


var id = $(this).data('id');

$.ajax({
  type: "POST",
  dataType: "json",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: "{{url('delete/product_imgs')}}",
  data: {
    id: id,
  },

  success: function(result) {
    if(result.status==200){
      window.location.reload();
      showToastr('success', 'Success!', "data delete successfully");
            setTimeout(showToastr, 2000);
     
      $('#edit_product').model('show');
    }







  }
});



});
$('.edit_var_prod').click(function() {


var id = $(this).data('id');
$('#product_var_id').val(id);

$.ajax({
  type: "POST",
  dataType: "json",
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  url: "{{url('show/product_var_info')}}",
  data: {
    id: id,
  },

  success: function(result) {
    if(result.status==200){
      alert(result.data.var_name);
      $('#edit_var_product').model('show');
      $('#product_varing_name').val(result.data.var_name);

      
      
    }







  }
});



});


    $('#update_store').click(function() {



      // var id = $('#user_id').val();

      let form = $('#edit_store_form');


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
        url: "{{url('update/store')}}",
        data: data,
        processData: false,
        contentType: false,
        success: function(result) {


          if (result.errors) {
            //$('.alert-danger').html('');

            $.each(result.errors, function(key, value) {
              jQuery('#edit_store').modal('show');
              $('.alert-danger').show();
              $('.alert-danger').append('<li>' + value + '</li>');
            });
          } else {

            $('.alert-danger').hide();

            jQuery('#edit_store').modal('hide');
            window.location.href = "{{ route('stores_list')}}";
          }




        }
      });
    });


    $('#main_product_image').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
            //   $('#preview-image-before-upload').css({'display':'block','background-color':'red'}); 
                
              $('#preview-image-edit-upload').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
      });

      $(function() {
// Multiple images preview with JavaScript
            var previewImages = function(input, imgPreviewPlaceholder) {
            if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
            var reader = new FileReader();
            reader.onload = function(event) {
            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
            }
            reader.readAsDataURL(input.files[i]);
            }
            }
            };
            $('#product_image').on('change', function() {
              
            previewImages(this, 'div.images-preview-div');
            });
            });


            $('.checkbox').click(function() {
      if ($(".checkbox").is(":checked"))
        {
            //show the hidden div
            $(".addmore-section").css("display","block");
        }
        else
        {
            //otherwise, hide it
            $(".addmore-section").css("display","none");
        }
      
    //   if(this.checked) {
    //   $('.addmore-section').css('display','block');

    //     //Do stuff
    // }
});
$('.add_inputs').click(function() {
  var len=$('.var_name').length;
  $('#count_var_name').val(len);
  
  
  var html='<div class="addmore-section">'+
          '<div class="col-12 mb-3">'+
            '<div class="addmorebtn-part">'+
              
              // '<button type="button" class="minus-red" onclick="myfunction()"><i class="menu-icon tf-icons bx bx-minus"></i></button>'+
            '</div>'+
          '<label class="form-label" >Product Variation Name</label>'+

            '<input type="text" class="form-control var_name" name="product_var_name_'+len+'" id="product_var_name[]" placeholder="Product Variation Name">'+
          '</div>'+
          '<div class="col-12">'+
            '<label class="form-label" >Product Variation Image</label>'+
            '<input type="file" id="product_var_image" name="product_var_image_'+len+'[]"multiple class="form-control" placeholder="">'+
          '</div>'+
          '<div class="col-12">'+
            '<label class="form-label" >Product price</label>'+
            '<input type="text" id="product_var_price" name="product_var_price_'+len+'" class="form-control" placeholder="">'+
          '</div>'+
          '</div>';
          $('.append').append(html);
          var gen=$('.var_name').length;
  $('.count_var_name').val(gen);
    
});



      

 
   
   $('#product_image').change(function(){
    $('#preview-image-before-upload').css('display', 'block');      
    let reader = new FileReader();
 
    reader.onload = (e) => { 
 
      $('#preview-image-before-upload').attr('src', e.target.result); 
    }
 
    reader.readAsDataURL(this.files[0]); 
   
   });
   

 





  });
  function showToastr(type, title, message) {
    let body;
    toastr.options = {
      "closeButton": false,
               "debug": false,
               "newestOnTop": false,
               "progressBar": true,
               "positionClass": "toast-top-right",
               "preventDuplicates": true,
               "onclick": null,
               "showDuration": "3000",
               "hideDuration": "2000",
               "timeOut": "2000",
               "extendedTimeOut": "1000",
               "showEasing": "swing",
               "hideEasing": "linear",
               "showMethod": "fadeIn",
               "hideMethod": "fadeOut"
    };
    switch(type){
        case "info": body = "<span> <i class='fa fa-spinner fa-pulse'></i></span>";
            break;
        default: body = '';
    }
    const content = message + body;
    toastr[type](content, title)
}

</script>