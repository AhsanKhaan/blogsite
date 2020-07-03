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
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                   <!-- textarea -->
                   <div class="form-group">
                        <label>Add Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Product Description ...."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" value="1" min="0" max="20" step="1"/>

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
