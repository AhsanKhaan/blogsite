<?php include 'sidebar-header.php';?>
<div class="col-12">
                    <!-- general form elements -->
                    <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Service Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="servicename">Service  Name</label>
                    <input type="text" class="form-control" id="servicename" placeholder="Service Name">
                  </div>
                   <!-- textarea -->
                   <div class="form-group">
                        <label>Add Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter Service Description ...."></textarea>
                    </div>
                    <div class="row">
                      <div class="col-4">
                        <div class="input-group">
                        <label for="price">
                          Service Price
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

                    <!-- row ends -->
                    </div>
                    <div class="row">
                        <div class="col">
                         <div class="form-group">
                             <label for="Time">From</label>
                             <input type="time" class="form-control" id="Time" placeholder="from">
                         </div>
                        </div>
                        <div class="col">
                        <div class="form-group">
                             <label for="Time_to">To</label>
                             <input type="time" class="form-control" id="Time_to" placeholder="To">
                         </div>
                        </div>
                    </div>

        
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success"> <i class="fa fa-plus nav-icon" style="margin-right:10px;"></i>Add Service</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
           

      </div><!--col ends-->
<?php include 'sidebar-footer.php';?>