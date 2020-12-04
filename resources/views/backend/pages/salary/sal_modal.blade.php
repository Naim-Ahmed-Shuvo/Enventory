 <!--  Modal content for the above example -->
 <div class="modal fade bs-example-modal-lg" id="sal_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sal_modal_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form  enctype="multipart/form-data" id="sal_form">
                <input type="hidden" name="sal_id" id="sal_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Employee</label>
                                @php
                                    $empoyee = DB::table('employees')->get();
                                @endphp
                               <select name="emp_id" id="" class="form-control">
                                   @foreach ($empoyee as $item)
                                     <option value="{{$item->id}}">{{$item->name}}</option>
                                   @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Month</label>
                                <select name="month" id="" class="form-control">
                                        <option value="January">January</option>
                                        <option value="Febuary">Febuary</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Advance Salary</label>
                                <input type="text" class="form-control" name="adv_sal" id="adv_sal" aria-describedby="emailHelp" placeholder="Enter Advance Salary">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary ml-2" id="save_btn"></button>
                    </div>
                </div>
           </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->

<div class="modal fade" id="show_sup_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <label for="">IMage</label>
                    <label for=""><img src="" id="show_img" alt=""></label>

                </div>
                <div class="col-lg-2">
                    <label for="">Name</label>
                    <span><h6 id="show_name"></h6></span>
                </div>
                <div class="col-lg-5">
                    <label for="">Email</label>
                    <span><h6 id="show_email"></h6></span>
                </div>
                <div class="col-lg-4">

                </div>
                <div class="col-lg-4">
                    <label for="">Phone</label>
                    <span><h6 id="show_phone"></h6></span>
                </div>
                <div class="col-lg-4">
                    <label for="">Address</label>
                    <span><h6 id="show_address"></h6></span>
                </div>
            </div>

        </div>

      </div>
    </div>
  </div>
