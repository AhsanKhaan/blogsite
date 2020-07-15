<?php 
	require_once('../inc/config.php');
	require_once('../inc/functions.php');
	require_once('../inc/resize.image.class.php');

	

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) AND $_POST['action'] != 'DeleteSingleRecord' && $_POST['action'] != 'DeleteBulkRecord'){
		if($_POST['action'] == 'Status'){
			// Change Status
			$vendor_id = mysqli_real_escape_string($conn, CleanString($_POST['vendor_id']));
			$value = mysqli_real_escape_string($conn, CleanString($_POST['value']));
			mysqli_query($conn, "UPDATE vendor SET 
		 	`vendor_status` = ".$value."
		 	 WHERE vendor_id = ".$vendor_id."");
		}else{
			// Change Display Home Status
			$vendor_id = mysqli_real_escape_string($conn, CleanString($_POST['vendor_id']));
			$value = mysqli_real_escape_string($conn, CleanString($_POST['value']));
			mysqli_query($conn, "UPDATE vendor SET 
		 	`vendor_displayhome` = ".$value."
		 	 WHERE vendor_id = ".$vendor_id."");
		}
		exit('success');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) && $_POST['action'] == 'DeleteSingleRecord'){
		 $vendor_id = mysqli_real_escape_string($conn, CleanString($_POST['catid']));
		 $SubCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM vendor WHERE vendor_id = ".$vendor_id.""));
		 // $ProductsCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE vendor_id = ".$vendor_id.""));
		 
		 if($SubCatCount > 0){
		 	exit("Please Delete The Assign vendor First");
		 }

		 // if($ProductsCatCount > 0){
		 // 	exit("Please Delete The Assign Product First");
		 // }

		 mysqli_query($conn, "UPDATE vendor SET `del_status` = 1 WHERE vendor_id = ".$vendor_id."");
		 exit('success');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) && $_POST['action'] == 'DeleteBulkRecord'){
		 $Count = null;
		 foreach($_POST['catids'] as $catid){
		 	 $SubCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM vendor WHERE vendor_id = ".$catid.""));
		 	 if($SubCatCount > 0){
			 	$Count = 'set';
			 	$msg = "Please Delete The Assign vendor First";
			 	continue;
			 }
			 // $ProductsCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE vendor_id = ".$vendor_id.""));
			 // if($ProductsCatCount > 0){
			 // 	$Count = 'set';
			 // $msg = "Please Delete The Assign Product First";
			 // continue;
			 // }
		 	mysqli_query($conn, "UPDATE vendor SET `del_status` = 1 WHERE vendor_id = ".$catid."");
		 }
		 $Count != 'set' ? exit('success') : exit($msg);
	}	


	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST)){

		sleep(1);
		$vendor_name = mysqli_real_escape_string($conn, CleanString($_POST['vendor_name']));
		$vendor_slug = GenerateSlug(mysqli_real_escape_string($conn, CleanString($_POST['vendor_slug'])), $vendor_name);
		$vendor_email = mysqli_real_escape_string($conn, CleanString($_POST['vendor_email']));
		$vendor_status = isset($_POST['vendor_status']) && !empty($_POST['vendor_status']) ? mysqli_real_escape_string($conn, CleanString($_POST['vendor_status'])) : 0;
		$vendor_displayhome = isset($_POST['vendor_displayhome']) ? mysqli_real_escape_string($conn, CleanString($_POST['vendor_displayhome'])) : 0;

		$vendor_phone = !empty($_POST['vendor_phone']) ? mysqli_real_escape_string($conn, CleanString($_POST['vendor_phone'])) : 0;
		
		// $vendor_sortorder = !empty(trim($_POST['vendor_sortorder'])) ? mysqli_real_escape_string($conn, CleanString($_POST['vendor_sortorder'])) : 0 ;
		$vendor_address = mysqli_real_escape_string($conn, CleanString($_POST['vendor_address']));
		$vendor_shortdesc = mysqli_real_escape_string($conn, CleanString($_POST['vendor_shortdesc']));
		$vendor_longdesc = mysqli_real_escape_string($conn, addslashes($_POST['vendor_longdesc']));
		$metatitle = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metatitle'])), $vendor_name);
		$metadesc = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metadesc'])), $vendor_name);
		$metakeyword = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metakeyword'])), $vendor_name);
		$vendor_id = isset($_POST['vendor_id']) ? mysqli_real_escape_string($conn, CleanString($_POST['vendor_id'])) : null;
	 
		$VendorData = null;
		if(!empty($vendor_name)){
				if(isset($vendor_id) && !empty($vendor_id)){
					// Update Record
					 mysqli_query($conn, "UPDATE vendor SET 
					 	`vendor_name` = '".$vendor_name."',
					 	`vendor_slug` = '".$vendor_slug."',
					 	`vendor_shortdisc` = '".$vendor_shortdesc."',
					 	`vendor_longdisc` = '".$vendor_longdesc."',
					 	`vendor_address` = '".$vendor_address."',
					 	`vendor_phone` = ".$vendor_phone.",
					 	`vendor_status` = ".$vendor_status.",
					 	`vendor_email` = '".$vendor_email."',
					 	`metatitle` = '".$metatitle."',
					 	`metakeyword` = '".$metakeyword."',
					 	`metadesc` = '".$metadesc."'
					 	 WHERE id = ".$vendor_id."");
 
					 	$Catgory_ID = $vendor_id;
			 		 $VendorData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM vendor WHERE id = ".$Catgory_ID.""));
				}else{
					// Insert Record
					 mysqli_query($conn, "INSERT INTO vendor SET 
					 	`vendor_name` = '".$vendor_name."',
					 	`vendor_slug` = '".$vendor_slug."',
					 	`vendor_shortdisc` = '".$vendor_shortdesc."',
					 	`vendor_longdisc` = '".$vendor_longdesc."',
					 	`vendor_address` = '".$vendor_address."',
					 	`vendor_phone` = ".$vendor_phone.",
					 	`vendor_status` = ".$vendor_status.",
					 	`vendor_email` = '".$vendor_email."',
					 	`metatitle` = '".$metatitle."',
						`metakeyword` = '".$metakeyword."',
						`del_status` = 0, 
					 	`metadesc` = '".$metadesc."'");
					 $Catgory_ID = mysqli_insert_id($conn);
				}

			if(isset($_FILES['vendor_image']['name']) && !empty($_FILES['vendor_image']['name'])){
				$name = basename($_FILES['vendor_image']['name']);
         		$extention = pathinfo($name, PATHINFO_EXTENSION);
				$newname = bin2hex(random_bytes(5));
         		$size = $_FILES['vendor_image']['size'];
         		$uploaddir = '../../upload/vendor/';
         		if($size > (2048*2048)){
         			exit("File Upload Size Limit Is 2 MB Only");
         		}elseif($extention == "png" || $extention == "jpg" || $extention == "jpeg"){
         			
UploadFile($_FILES['vendor_image']['tmp_name'], 1000, 500, 500, 500, TRUE, $newname, $uploaddir, $Catgory_ID, '../../' . $VendorData['vendor_imglg'], '../../' . $VendorData['vendor_imgsm'], 'vendor', 'vendor_imglg', 'vendor_imgsm', 'id', $Catgory_ID, $conn, $extention);

         		}else{
         			exit("Please Select The Images Only...!");
         		} 
			} 
			exit('success');
		}else{
			exit('Please Enter The vendor Name');
		}

	}

	header('Location: ' . $SiteUrl . 'admin/index.php');
	exit();
