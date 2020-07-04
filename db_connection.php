<?php
$host="usa";
$user="pakanimals_ahsan";
$password="Wordpress@123";
$data_base="pakanimals_petshop";

$mysqli = new mysqli($host,$user,$password,$data_base);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>