 <!--  Modal content for the above example -->
 <div class="modal fade bs-example-modal-lg" id="em_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="em_modal_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form  enctype="multipart/form-data" id="em_form">
                <input type="hidden" name="em_id" id="em_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" id="em_name" aria-describedby="emailHelp" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" id="em_email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" name="phone" id="em_phone" aria-describedby="emailHelp" placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" name="address" id="em_address" aria-describedby="emailHelp" placeholder="Enter address">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div  class="form-group">
                                <label for="exampleInputEmail1">Experience</label><br>
                                <input type="radio" name="experience" value="yes" id=""> <span>Yes</span><br>
                                <input type="radio" name="experience" value="na" id=""> <span>Na</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Photo</label>
                                <input type="file" name="photo" id="em_photo" class="form-control-file">
                                <span><img src="" id="photo_holder" alt=""></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Salary</label>
                                <input type="text" class="form-control" name="salary" id="em_salary" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Vacation</label>
                                <input type="text" class="form-control" name="vacation" id="em_vacation" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">City</label>
                                <input type="text" class="form-control" name="city" id="em_city" class="form-control-file">
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
