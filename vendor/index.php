<?php 

include '../db_connection.php';
//table for vendors
$query="CREATE TABLE IF NOT EXISTS vendors( ID int(6) UNSIGNED AUTO_INCREMENT, username varchar(100) NOT NULL, email varchar(100) NOT NULL, password varchar(100) NOT NULL, PRIMARY KEY (ID) )
";
if($mysqli->query($query)===TRUE){
  //do nothing
  
}else{
  echo "Error creating table: " . $mysqli->error;
  exit();
}
    session_start();
  //for vendor
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $_SESSION['user_status']='vendor';
    if ( ! empty($_POST['username'])&& !empty($_POST['password'])){
      $username=$_POST['username'];
      $_SESSION['username']=$_POST['username'];
      $password=$_POST['password'];
      $query = "SELECT * FROM vendors WHERE username='".$username."' AND password='".$password."'";
      
      if ($result = $mysqli -> query($query)) {
        while ($row = $result -> fetch_row()) {
  
          header("location:../dashboard.php");
        }
        $result -> free_result();
      }
      
      $mysqli -> close();
    }
   
    
  }//if post method ends
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="../css/style.css" rel="stylesheet">
</head>
<body class="hold-transition login-page bg">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b class="black">PAK</b class="black">Animals</a>

  </div>
  <!-- /.login-logo -->
  <div class="card opacity">
    <div class="card-body login-card-body">
      <p class="login-box-msg black">Sign in to start your session</p>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="username or email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-outline-success btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

 

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>
