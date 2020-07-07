<?php 
    include './sidebar-header.php';
    ?>

          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="../dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><b>Dr.</b>Elie Smith</h3>

                <p class="text-muted text-center">Surgeon</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Total Services</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>

                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Contact Me</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Education</strong>

                <p class="text-muted">
                  M.B.B.S in Physiotheraphy
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                <p class="text-muted">Sindh, karachi</p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                <p class="text-muted">
                  <span class="tag tag-danger">Consultant</span>
                  <span class="tag tag-success">Physiotheraphy</span>
                  <span class="tag tag-info">Vaccination</span>
                </p>

                <hr>

                  <strong><i class="fa fa-address-card mr-1"></i> Contact</strong>

                  <p class="text-muted">
                    <span ><i class="fa fa-phone" aria-hidden="true"></i><b>0321-1234567</b></span>
                    <br>
                    <span ><i class="fa fa-envelope" aria-hidden="true"></i><b><a href="mailto:example@gmail.com">example@gmail.com</a></b></span>
                    
                  </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#services" data-toggle="tab">Services</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="services">
                  <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th style="width: 170px">Service Name</th>
                      <th>Description</th>
                      <th>Service Price</th>
                      <th style="width: 40px">Timings</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1.</td>
                      <td>PysioTheraphy</td>
                      <td>
                       <p>If your pet is stuck in walking then he might needed physio theraphist we are available </p>
                      </td>
                      <td>
                         <p>$100</p>
                      </td>
                      <td><span class="badge ">9:00AM-5:00PM</span></td>
                    </tr>
                    <tr>
                      <td>2.</td>
                      <td>Fumigation</td>
                      <td>
                          <p>If your pet often itches then your pet might got lice .Then you need to fumigate your pet</p>
                      </td>
                      <td>
                         <p>$300</p>
                      </td>
                      <td><span class="badge ">10:00AM-2:00PM</span></td>
                    </tr>
                    <tr>
                      <td>3.</td>
                      <td>Nail Cutting</td>
                      <td>
                        <p>We provide a service of nail cutting of horses,cows buffalow </p>
                      </td>
                      <td>
                         <p>$250</p>
                      </td>
                      <td><span class="badge ">4:00PM-8:00PM</span></td>
                    </tr>

                  </tbody>
                </table>
                  </div>
                  <!-- /.tab-pane -->
                


                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->

    <?php 
    include './sidebar-footer.php';
    ?>