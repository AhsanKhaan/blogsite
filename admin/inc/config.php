<?php 
session_start();
$SiteUrl = 'http://localhost/petshop/';
$AssetsUrl = '/';
ini_set('display_errors', 1);
error_reporting(E_ALL);
ini_set('display_errors' , 'on');
$ProductName = 'Pak Animals';
$DevelopedBy = 'BMSAS TECHNOLOGIES';
$SoftwareHouseLink = 'https://bmsastech.com/';
$servername = "localhost";
$username = "root";
$password = "";
$DBName = "petshop";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $DBName);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
  
$SubmitBTNClass = NULL;
$DisabledSubmitBTN = FALSE;
