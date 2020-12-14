@extends('backend.master')

@section('content')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Expense</h4>
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
                    <h3 class="card-title">Expense Table</h3>
                    @php
                        echo date('d')
                    @endphp
                    <div class="buttons">
                        <button class="btn btn-primary btn-sm" id="add_expense">Add Expense</button>
                        <button class="btn btn-info btn-sm" id="current_expense">Today</button>
                        <button class="btn btn-success btn-sm" id="ThisMonthExpense">This Month</button>
                    </div>
                </div>
                <span id="notifaction"></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0" id="expense_table">
                                <thead>
                                    <tr>
                                        <th>Amount</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Date</th>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                            @include('backend.pages.expense.expense_modal')
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


       var table = $('#expense_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('expense') }}",
        columns: [
            //  {data: 'id', name: 'id'},
             {data: 'amount', name: 'amount'},
             {data: 'year', name: 'year'},
             {data: 'month', name: 'month'},
             {data: 'date', name: 'date'},
             {data: 'details', name: 'details'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

      $('#add_expense').click(function(){
         $('#expense_modal').modal('show');
         $('#expese_modal_title').html('Add Expense');
         $('#save_btn').html('Save');
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
        $('#expense_form').submit(function(e){
            e.preventDefault();

            // saving
            if($('#save_btn').html() == 'Save'){
            $('#save_btn').html('Sending..');
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{url('/expense')}}",
                type: "POST",
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){
                    if(data.success){
                        toastr.success(data.success);
                        $('#expense_form').trigger("reset");
                        $('#expense_modal').modal('hide');
                        table.draw();
                    }
                    else{
                        toastr.error(data.error);
                        $('#expense_form').trigger("reset");
                        $('#expense_modal').modal('hide');
                        table.draw();
                      }
                },

            });
        }

        //  Update
        if($('#save_btn').html() == 'Update'){
            $('#save_btn').html('Sending..');
            var id = $('#expense_id').val();
            // alert(id);
            var formData = new FormData(this);
            $.ajax({
                data: formData,
                url: "{{ url('/expense_update') }}"+ '/'+ id ,
                type: "POST",
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){

                    if(data.success){
                        toastr.success(data.success);
                        $('#expense_form').trigger("reset");
                        $('#expense_modal').modal('hide');
                        table.draw();
                    }
                    else{
                        toastr.error(data.error);
                        $('#expense_form').trigger("reset");
                        $('#expense_modal').modal('hide');
                        table.draw();
                      }
                },

            });
        }
    });

        // Edit
        $('body').on('click', '.editExpense', function(){
            var id = $(this).data('id');
            $.ajax({
                url:"{{url('/expense')}}"+ '/' + id+ "/edit",
                success: function(data){
                   $('#expense_modal').modal('show');
                   $('#expense_id').val(data.id);
                   $('#ExpenseMonth').val(data.month);
                   $('#ExpenseMonth').val(data.month);
                   $('#ExpenseDate').val(data.date);
                   $('#ExpenseAmount').val(data.amount);
                   $('#ExpenseDetails').val(data.details);
                    $('#save_btn').html('Update');
                }
            });
        });

        // Delete
        $('body').on('click', '.deleteExpense', function(){
            var id = $(this).data('id');
           $.ajax({
              url: "{{url('/expense')}}"+"/"+ id,
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

        // Today Expense
        $('#current_expense').click(function(){
          $.get('today_expense', function(data){
              $('#TodayExpenseModal').modal('show');
              for(var i=0;  i < data.length; i++){
                var tr = '<tr> <td>'+data[i].amount+'</td> <td>'+data[i].details+'</td> <td>'+data[i].month+'</td> <td>'+data[i].year+'</td></tr>';
                $('#TodayExpenseTable tbody').append(tr);
              }

          });
        });

        // This month expense
        $('#ThisMonthExpense').click(function(){
           $.get('this_month_expense', function(data){
               $('#CurrentMonthModal').modal('show');
               for(var i=0;  i < data.length; i++){
                var tr = '<tr> <td>'+data[i].amount+'</td> <td>'+data[i].details+'</td> <td>'+data[i].month+'</td> <td>'+data[i].year+'</td></tr>';
                $('#TodayExpenseTable tbody').append(tr);
              }
           });
        });
    });
 </script>
@endpush
