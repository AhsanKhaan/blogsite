<?php 
  include('inc/config.php');
  $PageTitle = ' Login | ';
  include('header.php');
if(isset($_SESSION['UserData'])){
    echo '<script>window.location = "'.$SiteUrl.'admin/dashboard.php" </script>';
    exit();
}

?>
<style type="text/css">
  .login-box, .register-box {width: 360px;margin: 100px auto 10px auto;}
</style>
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:;"><b><?php echo $ProductName; ?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form id="loginform">
        <div class="input-group mb-3 email-group">
          <input type="text" class="form-control" placeholder="Email" id="email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 password-group">
          <input type="password" class="form-control" placeholder="Password" id="password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In 
              &nbsp; <svg style="display: none;" class="spinner" width="30" height="30" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
   <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
</svg>
</button>
            
          </div>


          <!-- /.col -->
        </div>
      </form>
 
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<?php 
  include('footer.php');
?>
<script src="<?php echo $SiteUrl; ?>admin/js/login.js"></script>