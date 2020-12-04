@extends('backend.master')

@section('content')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Customer</h4>
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
                    <h3 class="card-title">Customer Table</h3>
                    <button class="btn btn-primary btn-sm" id="add_cus"><i class="fa fa-user-plus"></i></button>

                </div>
                <span id="notifaction"></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0" id="cus_table">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Photo</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            @include('backend.pages.customer.cus_modal')
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


       var table = $('#cus_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('customer') }}",
        columns: [
            //  {data: 'id', name: 'id'},
             {data: 'name', name: 'name'},
             {data: 'email', name: 'email'},
             {data: 'phone', name: 'phone'},
            {
                data: 'photo',
                name: 'photo',
                render: function(data, type, full, meta){
                   return "<img width='50' height='40' src={{url('/')}}/" + data + " class='img-thumbnail' >"
                }
            },
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'city', name: 'city'},

            {data: 'action', name: 'action', orderable: false, searchable: false},


        ]
    });


 // Save
 $('#cus_form').submit(function(e){
            e.preventDefault();

            // saving
            if($('#cussave_btn').html() == 'Save'){
            $('#cussave_btn').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{url('/customer')}}",
                type: "POST",
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    $('#cus_form').trigger("reset");
                    $('#cus_modal').modal('hide');
                    table.draw();
                },

            });
        }

        //  Update
        if($('#cussave_btn').html() == 'Update'){
            $('#cussave_btn').html('Sending..');
            var id = $('#cus_id').val();
            // alert(id);
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{ url('/employee_update') }}"+ '/'+ id ,
                type: "POST",
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                        });

                        Toast.fire({
                        icon: 'success',
                        title: 'Success'
                        });
                    $('#cus_form').trigger("reset");
                    $('#cus_modal').modal('hide');
                    // $('#view_img').attr('src', ' ');
                    table.draw();
                },

            });
        }
    });


            $('#add_cus').click(function(){
                //   alert('hi');
                $('#cus_modal').modal('show');
                $('#cus_modal_title').html('Add Customer');
                $('#cussave_btn').html('Save');
                $('#cus_form').trigger("reset");
                $('#cus_photo_holder').attr('src', ' ').css({
                    'height': '0',
                    'width' : '0',
                });
            });

            $('#cus_photo').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
            // console.log(e.target.result);
            $('#cus_photo_holder').attr('src', e.target.result).css({
                'height': '50',
                'width' : '50',

            });
            }
            reader.readAsDataURL(this.files[0]);
        });
        // Edit
        $('body').on('click', '.editCus', function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{url('/customer')}}"+ '/' + id+ "/edit",
                success: function(data){
                    $('#cus_modal').modal('show');
                    $('#cus_modal_title').text('Edit Employee');
                    $('#cus_id').val(data.id);
                    // $('#p_description').innerHtml(data.details);
                    $('#cus_name').val(data.name);
                    $('#cus_email').val(data.email);
                    $('#cus_phone').val(data.phone);
                    $('#cus_address').val(data.address);
                    $('#shop_name').val(data.shop_name);
                    $('#acc_holder').val(data.account_holder);
                    $('#acc_number').val(data.account_number);
                    $('#bank_name').val(data.bank_name);
                    $('#bank_brunch').val(data.bank_brunch);
                    $('#cus_city').val(data.city);
                    $('#cus_photo_holder').attr('src', "{{url('/')}}/"+data.photo).css({
                        'height': '40',
                        'widht': '50',
                    });
                    $('#cussave_btn').html('Update');
                }
            });
        });

        // Delete
        $('body').on('click', '.deleteCus', function(){
            var id = $(this).data('id');
           $.ajax({
              url: "{{url('/customer')}}"+"/"+ id,
              type: "DELETE",
              success: function(data){
                table.draw();
              }
           });
        });

        // View
        $('body').on('click', '.viewCus', function(){
           var id = $(this).data('id');
           $.ajax({
               url: "{{url('/customer')}}/"+ id,
               type: "GET",
               success: function(data){
                   $('#show_cus_modal').modal('show');
                   $('#exampleModalLabel').html(data.name+"'s Details");
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
