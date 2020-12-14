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
                    <div class="button_group">
                        <a href="{{url('/products/export/')}}" class="btn btn-sm btn-info">Download Xlsx</a>
                        <a id="ImportProduct" class="btn btn-sm btn-info">Import Xlsx</a>
                        <button class="btn btn-primary btn-sm" id="add_prd">Add Product</button>
                    </div>

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
                                       <th>Name</th>
                                       <th>Code</th>
                                       <th>Selling Price</th>
                                       <th>Image</th>
                                       <th>Garage</th>
                                       <th>Route</th>
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
           {data: 'p_name', name: 'p_name'},
           {data: 'p_code', name: 'p_code'},
             {data: 'selling_price', name: 'selling_price'},

             {data: 'p_image', name: 'p_image',
                    render: function(data){
                        return "<img width='50' height='60' src={{url('/')}}/" + data +   " class='img-thumnail'>"
                    }
             },
             {data: 'p_garage', name: 'p_garage'},
             {data: 'p_route', name: 'p_route'},

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
        if($('#save_btn').html() == 'Update'){
            $('#save_btn').html('Sending..');
            var id = $('#p_id').val();
            // alert(id);
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{ url('/product_update') }}"+ '/'+ id ,
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
        $('body').on('click', '.editProduct', function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{url('/product')}}"+ '/' + id+ "/edit",
                success: function(data){
                     $('#prd_modal').modal('show');
                     $('#prd_modal_title').html('Update Product');
                     $('#p_id').val(data.id);
                     $('#prd_name').val(data.p_name);
                     $('#p_code').val(data.p_code);
                     $('#p_garage').val(data.p_garage);
                     $('#p_route').val(data.p_route);
                    $('#p_img_holder').attr('src', "{{url('/')}}/"+data.p_image).css({
                        'height': '40',
                        'widht': '70',
                    });
                    $('#selling_price').val(data.selling_price);
                    $('#buying_price').val(data.buying_price);
                    $('#save_btn').html('Update');
                }
            });
        });

        // Delete
        $('body').on('click', '.deleteProduct', function(){
            var id = $(this).data('id');
           $.ajax({
              url: "{{url('/product')}}"+"/"+ id,
              type: "DELETE",
              success: function(data){
                table.draw();
              }
           });
        });

        // View
        $('body').on('click', '.viewProduct', function(){
           var id = $(this).data('id');
           $.ajax({
               url: "{{url('/product')}}/"+ id,
               type: "GET",
               success: function(data){
                   $('#show_product_modal').modal('show');
                   $('#exampleModalLabel').html(data.name+"'s Details");
                   $('#show_name').html(data.p_name);
                   $('#s_price').html(data.selling_price);
                   $('#b_price').html(data.buying_price);
                   $('#p_cat').html(data.cat_name);
                   $('#sup').html(data.sup_name);
                   $('#buydate').html(data.buy_date);
                   $('#exDate').html(data.expire_date);
                   $('#godaun').html(data.p_garage);
                   $('#route').html(data.p_route);

                   $('#show_img').attr('src', "{{url('/')}}/"+data.p_image).css({
                       'height': '70',
                       'widht': '100',
                       'margin-left': '40'
                   });
               }
           });
        });

        $('#ImportProduct').click(function(e){
             e.preventDefault();
             $('#ImportModal').modal('show');
        });
        $('#ImportProductForm').submit(function(e){
             e.preventDefault();
            var data = new FormData(this);
            $.ajax({
                 data: data,
                 url: "{{url('import')}}",
                 type: "POST",
                 cache:false,
                 contentType: false,
                 processData: false,
                 success: function(){
                    $('#ImportModal').modal('hide');
                 }
            });
        });
    });
 </script>
@endpush
