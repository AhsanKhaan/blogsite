<?php include 'sidebar-header.php';?>
      <div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="productname">Product Name</label>
                    <input type="text" class="form-control" id="productname" placeholder="Product Name">
                  </div>
                  <div class="form-group">
                    <label for="slug-url">URL Link</label>
                    <input type="text" class="form-control" id="slug-url" placeholder="slug-url">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Image</label>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Choose File</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="image-description">Image Description</label>
                    <input type="text" class="form-control" id="image-description" placeholder="Image Description">
                  </div>
                  <div class="form-group">
                    <label for="Alt_text">Alt Text</label>
                    <input type="text" class="form-control" id="Alt_text" placeholder="Alternate Text">
                  </div>

                   <!-- textarea -->
                   <div class="form-group">
                        <label>Add Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Product Description ...."></textarea>
                    </div>
                    <div class="row">
                      <div class="col-3">
                        <div class="input-group">
                        <label for="price">
                          Price
                        </label>
                          <div style="margin-left:20px;" class="input-group-prepend">
                          <span class="input-group-text">PKR</span>
                        </div>
                        <input id="price"type="text" class="form-control">
                          <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                          </div>
                        </div> 
                      </div>
                      <!-- col ends -->

                    <div class="col-3 align-right form-group">
                        <label>Quantity</label>
                        <input  style="border:solid 3px #CED4DA;border-radius:10px; margin-left:5px;" class="input-text-group" type="number" value="1" min="0" max="20" step="1"/>
                    </div>
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        
                        <select class="form-control">
                        <option>Select Category</option>
                          <option>Pet</option>
                          <option>Wild</option>
                          <option>Reptiles</option>
                          <option>Birds</option>
                          <option>Aqua Animals</option>
                        </select>
                      </div>
                      <!-- col-sm-ends -->
                    </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary"> <i class="fa fa-plus nav-icon" style="margin-right:10px;"></i>Add Product</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
           

      </div><!--col ends-->
<?php include 'sidebar-footer.php';?>
