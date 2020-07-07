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
                <div class="row">
                  <div class="col">
                  <div class="form-group">
                    <label for="productname">Product Name</label>
                    <input type="text" class="form-control" id="productname" placeholder="Product Name">
                  </div>
                  </div>
                  <!-- end col 1 -->
                  <div class="col">
                  <div class="form-group">
                    <label for="slug-url">URL Link</label>
                    <input type="text" class="form-control" id="slug-url" placeholder="slug-url">
                  </div>                  
                  </div>
                  <!-- end col 2 -->
                </div>
                <!-- end row 1 -->
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="exampleInputFile">Upload Large Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile">
                          <label class="custom-file-label" for="customFile">Choose File</label>
                        </div>
                      </div>
                      <!-- end form group -->
                    </div>
                    <!-- end col1 -->
                      <div class="col">
                      <div class="form-group">
                        <label for="exampleInputFile">Upload Small Image</label>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile2">
                          <label class="custom-file-label" for="customFile2">Choose File</label>
                        </div>
                      </div>
                      <!-- end form group -->
                      </div>
                    <!-- end col2 -->
                  </div>
                  <!-- end row 2 -->
                  <div class="row">
                    <div class="col">
                     <div class="form-group">
                       <label for="Alt_text">Alt Text</label>
                       <input type="text" class="form-control" id="Alt_text" placeholder="Alternate Text">
                     </div>                      
                    </div>
                    <!-- end col1 -->
                    <div class="col">
                      <div class="form-group">
                       <label for="Alt_title">Alt Title</label>
                       <input type="text" class="form-control" id="Alt_title" placeholder="Alternate Title">
                     </div>
                    </div>
                    <!-- end col2 -->
                  </div>
                  <!-- end row 3 -->
                  <div class="row">
                    <div class="col">
                     <div class="form-group">
                       <label for="meta_keywords">Meta Keywords</label>
                       <input type="text" class="form-control" id="meta_keywords" placeholder="Meta Keywords">
                     </div>                      
                    </div>
                    <!-- end col1 -->
                    <div class="col">
                      <div class="form-group">
                       <label for="meta_title">Meta Title</label>
                       <input type="text" class="form-control" id="meta_title" placeholder="Meta Title">
                     </div>
                    </div>
                    <!-- end col2 -->
                  </div>
                  <!-- end row 4 -->                  
                  <div class="row">
                    <div class="col">
                       <!-- textarea -->
                        <div class="form-group">
                          <label>Add Description</label>
                          <textarea class="form-control" rows="3" placeholder="Enter Product Description ...."></textarea>
                         </div>
                    </div>
                      <!-- ends col1 -->
                    <div class="col">
                       <!-- textarea -->
                       <div class="form-group">
                          <label>Meta  Description</label>
                          <textarea class="form-control" rows="3" placeholder="Enter Meta Description ...."></textarea>
                       </div> 
                    </div>
                    <!-- end col2 -->
                  </div>
                  <!-- end row 4 -->
                    <div class="row">
                      <div class="col">
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

                    <div class="col align-right form-group">
                        <label>Quantity</label>
                        <input  style="border:solid 3px #CED4DA;border-radius:10px; margin-left:5px;" class="input-text-group" type="number" value="1" min="0" max="20" step="1"/>
                    </div>

                    </div>
                    <!-- row ends -->
                    <h3>
                    Deals Date
                    </h3>
                    <div class="row">
                        <div class="col">
                         <div class="form-group">
                             <label for="Time">From</label>
                             <input type="date" class="form-control" id="Time" placeholder="from">
                         </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                             <label for="Time_to">To</label>
                             <input type="date" class="form-control" id="Time_to" placeholder="To">
                         </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-6">
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
                      <!-- form group ends -->
    
                      </div>
                      <div class="col-4"></div>
                      <div class="col-2 ">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-plus nav-icon" style="margin-right:10px;"></i>Add Product</button>
                      </div>
                    </div>
                </div>
                <!-- /.card-body -->


              </form>
            </div>
            <!-- /.card -->
           

      </div><!--col ends-->
<?php include 'sidebar-footer.php';?>
