@extends('backend.master')

@section('content')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Employee</h4>
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
                    <h3 class="card-title">Employee Table</h3>
                    <button class="btn btn-primary btn-sm" id="add_user"><i class="fa fa-user-plus"></i></button>

                </div>
                <span id="notifaction"></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0" id="em_table">
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

                            @include('backend.pages.employee.em_modal')
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


       var table = $('#em_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('employee') }}",
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

      $('#add_user').click(function(){
         $('#em_modal').modal('show');
         $('#em_modal_title').html('Add Employee');
         $('#save_btn').html('Save');
         $('#em_form').trigger("reset");
         $('#photo_holder').attr('src', ' ').css({
            'height': '0',
            'width' : '0',
         });
      });

      $('#em_photo').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => {
        // console.log(e.target.result);
        $('#photo_holder').attr('src', e.target.result).css({
            'height': '50',
            'width' : '50',

        });
        }

        reader.readAsDataURL(this.files[0]);
        });

        // Save
        $('#em_form').submit(function(e){
            e.preventDefault();

            // saving
            if($('#save_btn').html() == 'Save'){
            $('#save_btn').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{url('/employee')}}",
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
                    $('#em_form').trigger("reset");
                    $('#em_modal').modal('hide');
                    table.draw();
                },

            });
        }

        //  Update
        if($('#save_btn').html() == 'Update'){
            $('#save_btn').html('Sending..');
            var id = $('#em_id').val();
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
                    $('#em_form').trigger("reset");
                    $('#em_modal').modal('hide');
                    // $('#view_img').attr('src', ' ');
                    table.draw();
                },

            });
        }
    });

        // Edit
        $('body').on('click', '.editEmployee', function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{url('/employee')}}"+ '/' + id+ "/edit",
                success: function(data){
                    $('#em_modal').modal('show');
                    $('#em_modal_title').text('Edit Employee');
                    $('#em_id').val(data.id);
                    // $('#p_description').innerHtml(data.details);
                    $('#em_name').val(data.name);
                    $('#em_email').val(data.email);
                    $('#em_phone').val(data.phone);
                    $('#em_address').val(data.address);
                    $('#em_salary').val(data.salary);
                    $('#em_vacation').val(data.vacation);
                    $('#em_city').val(data.city);
                    $('#photo_holder').attr('src', "{{url('/')}}/"+data.photo).css({
                        'height': '40',
                        'widht': '50',
                    });
                    $('#save_btn').html('Update');
                }
            });
        });

        // Delete
        $('body').on('click', '.deleteEmployee', function(){
            var id = $(this).data('id');
           $.ajax({
              url: "{{url('/employee')}}"+"/"+ id,
              type: "DELETE",
              success: function(data){
                table.draw();
              }
           });
        });

        // View
        $('body').on('click', '.viewEmployee', function(){
           var id = $(this).data('id');
           $.ajax({
               url: "{{url('/employee')}}/"+ id,
               type: "GET",
               success: function(data){
                   $('#show_em_modal').modal('show');
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
