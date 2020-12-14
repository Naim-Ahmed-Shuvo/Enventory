 <!--  Modal content for the above example -->
 <div class="modal fade bs-example-modal-lg" id="attendenceModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="attendenceMoalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form  enctype="multipart/form-data" id="em_form">
                <input type="hidden" name="em_id" id="em_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" class="form-control" name="date" id="attendenceDate" >
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Year</label>
                                <input type="text" class="form-control" name="year" id="attendenceYear">
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-sm btn-primary ml-2" id="save_btn"></button>
                    </div>
                </div>
           </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->

<div class="modal fade" id="show_em_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
