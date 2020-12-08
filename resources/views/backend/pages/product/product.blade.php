@extends('backend.master')

@section('content')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Product</h4>
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
                    <h3 class="card-title">Product Table</h3>
                    <button class="btn btn-primary btn-sm" id="add_prd"><i class="fa fa-user-plus"></i></button>

                </div>
                <span id="notifaction"></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0" id="prd_table">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>id</th>
                                        <th>category</th>
                                        <th>product name</th>
                                        <th>Sup id</th>
                                        <th>p code</th>
                                        <th>p garage</th>
                                        <th>p route</th>
                                        <th>p image</th>
                                        <th>buy date</th>
                                        <th>expire date</th>
                                        <th>selling price</th>
                                        <th>buying price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            @include('backend.pages.product.prd_modal')
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


    var table = $('#prd_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('/product') }}",
        columns: [
            {data: 'id', name: 'id'},
             {data: 'cat_name', name: 'cat_name'},
             {data : 'p_name', name: 'p_name'},
             {
                 data: 'sup_id',
                 name: 'sup_id',
             },
             {
                 data: 'p_code',
                 name: 'p_code',
             },
             {data: 'p_garage', name: 'p_garage'},
             {data: 'p_route', name: 'p_route'},
             {data: 'p_image', name: 'p_image',
                    render: function(data){
                        return "<img width='50' height='60' src='{{url('/')}}/'" + data +   " class='img-thumnail'>"
                    }
             },
             {data: 'buy_date', name: 'buy_date'},
             {data: 'expire_date', name: 'expire_date'},
             {data: 'selling_price', name: 'selling_price'},
             {data: 'buying_price', name: 'buying_price'},
             {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });



 // Save
 $('#prd_form').submit(function(e){
            e.preventDefault();

            // saving
            if($('#save_btn').html() == 'Save'){
            $('#save_btn').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{url('/product')}}",
                type: "POST",
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.success){
                        toastr.success(data.success);
                        $('#prd_form').trigger("reset");
                        $('#prd_modal').modal('hide');
                        table.draw();
                    }
                    else{
                        toastr.error(data.error);
                        $('#prd_form').trigger("reset");
                        $('#prd_modal').modal('hide');
                        table.draw();
                      }
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


            $('#add_prd').click(function(){
                //   alert('hi');
                $('#prd_modal').modal('show');
                $('#prd_modal_title').html('Add Product');
                $('#save_btn').html('Save');
                $('#cus_form').trigger("reset");
                $('#cus_photo_holder').attr('src', ' ').css({
                    'height': '0',
                    'width' : '0',
                });
            });

            $('#p_img').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => {
            // console.log(e.target.result);
            $('#p_img_holder').attr('src', e.target.result).css({
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
