 <!--  Modal content for the above example -->
 <div class="modal fade bs-example-modal-lg" id="prd_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prd_modal_title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form  enctype="multipart/form-data" id="prd_form">
                <input type="hidden" name="p_id" id="p_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" name="prd_name" id="prd_name" aria-describedby="emailHelp" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <?php
                                       $categories = DB::table('categories')->get();
                                 ?>
                                <label for="exampleInputEmail1">Catgory</label>
                                <select name="cat_id" class="form-control" id="">
                                    @foreach ($categories as $item)
                                      <option value="{{$item->id}}">{{$item->cat_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Sup Id</label>
                                <input type="text" class="form-control" name="sup_id" id="sup_id" aria-describedby="emailHelp" placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Code</label>
                                <input type="text" class="form-control" name="p_code" id="p_code" aria-describedby="emailHelp" placeholder="Enter address">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div  class="form-group">
                                <label for="exampleInputEmail1">Product Garage</label><br>
                                <input type="text" name="p_garage"  id="p_garage" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div  class="form-group">
                                <label for="exampleInputEmail1">Product Route</label><br>
                                <input type="text" name="p_route"  id="p_route" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Photo</label>
                                <input type="file" name="p_img" id="p_img" class="form-control-file">
                                <span><img src="" id="p_img_holder" alt=""></span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Buy Date</label>
                                <input type="date" class="form-control" name="buy_date" id="buy_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Expire Date</label>
                                <input type="date" class="form-control" name="ex_date" id="ex_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Selling Price</label>
                                <input type="text" class="form-control" name="selling_price" id="selling_price" class="form-control-file">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="exampleFormControlFile1">Buying Price</label>
                                <input type="text" class="form-control" name="buying_price" id="buying_price" class="form-control-file">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary ml-2 mb-2" id="save_btn"></button>
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
