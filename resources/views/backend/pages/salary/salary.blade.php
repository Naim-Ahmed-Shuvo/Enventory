@extends('backend.master')

@section('content')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Salary</h4>
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
                    <h3 class="card-title">Salary Table</h3>
                    <button class="btn btn-primary btn-sm" id="add_sal"><i class="fa fa-user-plus"></i></button>

                </div>
                <span id="notifaction"></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0" id="sal_table">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Emp Name</th>
                                        <th>MOnth</th>
                                        <th>Status</th>
                                        <th>Adv salary</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            @include('backend.pages.salary.sal_modal')
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


       var table = $('#sal_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('salary') }}",
        columns: [
            {data: 'emp_name', name: 'emp_name'},
             {data: 'month', name: 'month'},
             {data: 'status', name: 'status'},
             {data: 'adv_salary', name: 'adv_salary'},
             {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

      $('#add_sal').click(function(){
         $('#sal_modal').modal('show');
         $('#sal_modal_title').html('Add Salary');
         $('#save_btn').html('Save');

      });

        // Save
        $('#sal_form').submit(function(e){
            e.preventDefault();

            // saving
            if($('#save_btn').html() == 'Save'){
            $('#save_btn').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{url('/salary')}}",
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
                    $('#sal_form').trigger("reset");
                    $('#sal_modal').modal('hide');
                    table.draw();
                },

            });
        }

        //  Update
        if($('#save_btn').html() == 'Update'){
            $('#save_btn').html('Sending..');
            var id = $('#sup_id').val();
            // alert(id);
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{ url('/sup_update') }}"+ '/'+ id ,
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
                    $('#sup_form').trigger("reset");
                    $('#sup_modal').modal('hide');
                    // $('#view_img').attr('src', ' ');
                    table.draw();
                },

            });
        }
    });

        // Edit
        $('body').on('click', '.editSup', function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{url('/suppliers')}}"+ '/' + id+ "/edit",
                success: function(data){
                    $('#sup_modal').modal('show');
                    $('#sup_modal_title').text('Edit Employee');
                    $('#sup_id').val(data.id);
                    // $('#p_description').innerHtml(data.details);
                    $('#sup_name').val(data.name);
                    $('#sup_email').val(data.email);
                    $('#sup_phone').val(data.phone);
                    $('#sup_address').val(data.address);
                    $('#sup_shop').val(data.shop);
                    $('#sup_acc_holder').val(data.acc_holder);
                    $('#sup_acc_number').val(data.acc_number);
                    $('#sup_bank_name').val(data.bank_name);
                    $('#sup_branch_name').val(data.brunch_name);

                    $('#sup_city').val(data.city);
                    $('#sup_photo_holder').attr('src', "{{url('/')}}/"+data.photo).css({
                        'height': '40',
                        'widht': '50',
                    });
                    $('#save_btn').html('Update');
                }
            });
        });

        // Delete
        $('body').on('click', '.deleteSup', function(){
            var id = $(this).data('id');
           $.ajax({
              url: "{{url('/suppliers')}}"+"/"+ id,
              type: "DELETE",
              success: function(data){
                table.draw();
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
