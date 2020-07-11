<?php 
if(!isset($_SESSION['UserData'])){
	echo '<script>window.location = "'.$SiteUrl.'admin/login.php" </script>';
    exit();
}
?>