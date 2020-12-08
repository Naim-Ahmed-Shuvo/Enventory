@extends('backend.master')

@section('content')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        {{-- <div class="alert alert-warning" id="warning" role="alert">
            A simple warning alert—check it out!
          </div> --}}
        <div class="page-title-box">
            <h4 class="page-title">Category</h4>
            <div class="page-title-right">
                <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Moltran</a></li>
                    <li class="breadcrumb-item"><a href="#">Elements</a></li>
                    <li class="breadcrumb-item active">Modals</li>
                </ol>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end page title -->


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="header-content d-flex justify-content-between">
                    <h3 class="card-title">Category Table</h3>
                    <button class="btn btn-primary btn-sm" id="add_cat"><i class="fa fa-user-plus"></i></button>

                </div>
                <span id="notifaction"></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0 text-center" id="cat_table">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            @include('backend.pages.category.cat_modal')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script>
     $(document).ready(function(){

        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
       });


       var table = $('#cat_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/category') }}",
        columns: [
            {data: 'id', name: 'id'},
             {data: 'cat_name', name: 'cat_name'},
             {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

      $('#add_cat').click(function(){
         $('#cat_modal').modal('show');
         $('#cat_modal_title').html('Add Category');
         $('#save_btn').html('Save');

      });

        // Save
        $('#cat_form').submit(function(e){
            e.preventDefault();

            // saving
            if($('#save_btn').html() == 'Save'){
            $('#save_btn').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{url('/category')}}",
                type: "POST",
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){
                      if(data.success){
                        toastr.success(data.success);
                        $('#cat_form').trigger("reset");
                        $('#cat_modal').modal('hide');
                        table.draw();
                      } else{
                        toastr.error(data.error);
                        $('#sal_form').trigger("reset");
                        $('#sal_modal').modal('hide');
                        table.draw();
                      }
                },
            });
        }

        //  Update
        if($('#save_btn').html() == 'Update'){
            $('#save_btn').html('Sending..');
            var id = $('#cat_id').val();
            // alert(id);
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{ url('/cat_update') }}"+ '/'+ id ,
                type: "POST",
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){

                    if(data.success){
                        toastr.success(data.success);
                        $('#cat_form').trigger("reset");
                        $('#cat_modal').modal('hide');
                        table.draw();
                      } else{
                        toastr.error(data.error);
                        $('#sal_form').trigger("reset");
                        $('#sal_modal').modal('hide');
                        table.draw();
                      }

                },

            });
        }
    });

        // Edit
        $('body').on('click', '.editCat', function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{url('/category')}}"+ '/' + id+ "/edit",
                success: function(data){
                    $('#cat_modal').modal('show');
                    $('#cat_id').val(data.id);
                    $('#cat_name').val(data.cat_name);
                    $('#save_btn').html('Update');
                }
            });
        });

        // Delete
        $('body').on('click', '.deleteCat', function(){
            var id = $(this).data('id');
           $.ajax({
              url: "{{url('/category')}}"+"/"+ id,
              type: "DELETE",
              success: function(data){
                if(data.success){
                        toastr.success(data.success);

                        table.draw();
                      } else{
                        toastr.error(data.error);

                        table.draw();
                      }

              }
           });
        });

        // View
        $('body').on('click', '.viewSup', function(){
           var id = $(this).data('id');
           $.ajax({
               url: "{{url('/suppliers')}}/"+ id,
               type: "GET",
               success: function(data){
                   $('#show_sup_modal').modal('show');
                   $('#show_name').html(data.name);
                   $('#show_email').html(data.email);
                   $('#show_phone').html(data.phone);
                   $('#show_address').html(data.address);
                   $('#show_img').attr('src', "{{url('/')}}/"+data.photo).css({
                       'height': '70',
                       'widht': '80',
                       'margin-left': '40'
                   });
               }
           });
        });
    });
 </script>
@endpush
