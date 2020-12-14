@extends('backend.master')

@section('content')

 <!-- start page title -->
 <div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Attendence</h4>
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


                </div>
                <span id="notifaction"></span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table mb-0 text-center"  id="em_table">
                                <thead>
                                    <tr>
                                        {{-- <th>Id</th> --}}
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Attendence</th>

                                    </tr>
                                </thead>
                                <form id="attendenceForm" method="POST" action="{{url('/take_attendence')}}">
                                    @csrf
                                    <tbody >
                                        @php
                                            $employees = DB::table('employees')->get();
                                        @endphp

                                        @foreach ($employees as $employee)
                                             <input type="hidden" name="employee_id[]" id="employee_id" value="{{$employee->id}}">
                                            <tr>
                                                <td>{{$employee->name}}</td>
                                                <td><img src="{{url($employee->photo)}}" height="30" width="50" alt=""></td>

                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="attendence[{{$employee->id}}]" value="present" >
                                                        <label class="form-check-label" for="exampleRadios1">
                                                        Present
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="attendence[{{$employee->id}}]" value="absent" >
                                                        <label class="form-check-label" for="exampleRadios1">
                                                        Absent
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                                    <button class="btn btn-primary btn-sm" type="submit">Take Attendence</button>
                                </form>
                            {{-- @include('backend.pages.attendence.attendence_modal') --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('js')

@endpush
