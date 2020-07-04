<?php
$host="local";
$user="root";
$password="";
$data_base="petshop";

$mysqli = new mysqli($host,$user,$password,$data_base);

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
?>