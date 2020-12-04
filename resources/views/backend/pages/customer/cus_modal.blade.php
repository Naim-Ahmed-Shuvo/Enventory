 <!--  Modal content for the above example -->
 <div class="modal fade bs-example-modal-lg" id="cus_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cus_modal_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form  enctype="multipart/form-data" id="cus_form">
                <input type="hidden" name="cus_id" id="cus_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="name" id="cus_name" aria-describedby="emailHelp" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control" name="email" id="cus_email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control" name="phone" id="cus_phone" aria-describedby="emailHelp" placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <input type="text" class="form-control" name="address" id="cus_address" aria-describedby="emailHelp" placeholder="Enter address">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div  class="form-group">
                                <label for="exampleInputEmail1">Shop Name</label><br>
                                <input type="text" class="form-control" name="shop_name" id="shop_name" aria-describedby="emailHelp" placeholder="Enter Shop name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Photo</label>
                                <input type="file" name="photo" id="cus_photo" class="form-control-file">
                                <span><img src="" id="cus_photo_holder" alt=""></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Account Holder</label>
                                <input type="text" class="form-control" name="acc_holder" id="acc_holder" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Acc Number</label>
                                <input type="text" class="form-control" name="acc_number" id="acc_number" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Bank Brunch</label>
                                <input type="text" class="form-control" name="bank_brunch" id="bank_brunch" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">City</label>
                                <input type="text" class="form-control" name="city" id="cus_city" class="form-control-file">
                            </div>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary mb-3 ml-3" id="cussave_btn"></button>
           </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Modal -->

<div class="modal fade" id="show_cus_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
