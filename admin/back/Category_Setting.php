<?php 
	require_once('../inc/config.php');
	require_once('../inc/functions.php');
	require_once('../inc/resize.image.class.php');

	

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) AND $_POST['action'] != 'DeleteSingleRecord' && $_POST['action'] != 'DeleteBulkRecord'){
		if($_POST['action'] == 'Status'){
			// Change Status
			$cat_id = mysqli_real_escape_string($conn, CleanString($_POST['cat_id']));
			$value = mysqli_real_escape_string($conn, CleanString($_POST['value']));
			mysqli_query($conn, "UPDATE category SET 
		 	`category_status` = ".$value."
		 	 WHERE category_id = ".$cat_id."");
		}else{
			// Change Display Home Status
			$cat_id = mysqli_real_escape_string($conn, CleanString($_POST['cat_id']));
			$value = mysqli_real_escape_string($conn, CleanString($_POST['value']));
			mysqli_query($conn, "UPDATE category SET 
		 	`category_displayhome` = ".$value."
		 	 WHERE category_id = ".$cat_id."");
		}
		exit('success');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) && $_POST['action'] == 'DeleteSingleRecord'){
		 $cat_id = mysqli_real_escape_string($conn, CleanString($_POST['catid']));
		 $SubCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subcategory WHERE category_id = ".$cat_id.""));
		 // $ProductsCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE category_id = ".$cat_id.""));
		 
		 if($SubCatCount > 0){
		 	exit("Please Delete The Assign Subcategory First");
		 }

		 // if($ProductsCatCount > 0){
		 // 	exit("Please Delete The Assign Product First");
		 // }

		 mysqli_query($conn, "UPDATE category SET `del_status` = 1 WHERE category_id = ".$cat_id."");
		 exit('success');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) && $_POST['action'] == 'DeleteBulkRecord'){
		 $Count = null;
		 foreach($_POST['catids'] as $catid){
		 	 $SubCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subcategory WHERE category_id = ".$catid.""));
		 	 if($SubCatCount > 0){
			 	$Count = 'set';
			 	$msg = "Please Delete The Assign Subcategory First";
			 	continue;
			 }
			 // $ProductsCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE category_id = ".$cat_id.""));
			 // if($ProductsCatCount > 0){
			 // 	$Count = 'set';
			 // $msg = "Please Delete The Assign Product First";
			 // continue;
			 // }
		 	mysqli_query($conn, "UPDATE category SET `del_status` = 1 WHERE category_id = ".$catid."");
		 }
		 $Count != 'set' ? exit('success') : exit($msg);
	}	


	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST)){
		sleep(1);
		$cat_name = mysqli_real_escape_string($conn, CleanString($_POST['cat_name']));
		$cat_slug = GenerateSlug(mysqli_real_escape_string($conn, CleanString($_POST['cat_slug'])), $cat_name);
		$cat_salecaption = mysqli_real_escape_string($conn, CleanString($_POST['cat_salecaption']));
		$cat_status = isset($_POST['cat_status']) ? mysqli_real_escape_string($conn, CleanString($_POST['cat_status'])) : 0;
		$cat_displayhome = isset($_POST['cat_displayhome']) ? mysqli_real_escape_string($conn, CleanString($_POST['cat_displayhome'])) : 0;

		$cat_price = !empty($_POST['cat_price']) ? mysqli_real_escape_string($conn, CleanString($_POST['cat_price'])) : 0;
		
		$cat_sortorder = !empty(trim($_POST['cat_sortorder'])) ? mysqli_real_escape_string($conn, CleanString($_POST['cat_sortorder'])) : 0 ;
		$cat_shortdesc = mysqli_real_escape_string($conn, CleanString($_POST['cat_shortdesc']));
		$cat_longdesc = mysqli_real_escape_string($conn, addslashes($_POST['cat_longdesc']));
		$metatitle = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metatitle'])), $cat_name);
		$metadesc = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metadesc'])), $cat_name);
		$metakeyword = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metakeyword'])), $cat_name);
		$cat_id = isset($_POST['cat_id']) ? mysqli_real_escape_string($conn, CleanString($_POST['cat_id'])) : null;
		
		
		$CategeryData = null;
		if(!empty($cat_name)){
				if(isset($cat_id) && !empty($cat_id)){
					// Update Record
					 mysqli_query($conn, "UPDATE category SET 
					 	`category_name` = '".$cat_name."',
					 	`category_slug` = '".$cat_slug."',
					 	`category_shortdesc` = '".$cat_shortdesc."',
					 	`category_longdesc` = '".$cat_longdesc."',
					 	`category_sort` = ".$cat_sortorder.",
					 	`price` = ".$cat_price.",
					 	`category_status` = ".$cat_status.",
					 	`category_displayhome` = ".$cat_displayhome.",
					 	`category_salecaption` = '".$cat_salecaption."',
					 	`title` = '".$metatitle."',
					 	`keyword` = '".$metakeyword."',
					 	`description` = '".$metadesc."'
					 	 WHERE category_id = ".$cat_id."");
					 	$Catgory_ID = $cat_id;
			 		 $CategeryData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM category WHERE category_id = ".$Catgory_ID.""));
				}else{
					// Insert Record
					 mysqli_query($conn, "INSERT INTO category SET 
					 	`category_name` = '".$cat_name."',
					 	`category_slug` = '".$cat_slug."',
					 	`category_shortdesc` = '".$cat_shortdesc."',
					 	`category_longdesc` = '".$cat_longdesc."',
					 	`category_sort` = ".$cat_sortorder.",
					 	`price` = ".$cat_price.",
					 	`category_status` = ".$cat_status.",
					 	`category_displayhome` = ".$cat_displayhome.",
					 	`category_salecaption` = '".$cat_salecaption."',
					 	`title` = '".$metatitle."',
					 	`keyword` = '".$metakeyword."',
					 	`description` = '".$metadesc."'");
					 $Catgory_ID = mysqli_insert_id($conn);
				}

			if(isset($_FILES['cat_image']['name']) && !empty($_FILES['cat_image']['name'])){
				$name = basename($_FILES['cat_image']['name']);
         		$extention = pathinfo($name, PATHINFO_EXTENSION);
				$newname = bin2hex(random_bytes(5));
         		$size = $_FILES['cat_image']['size'];
         		$uploaddir = '../../upload/category/';
         		if($size > (2048*2048)){
         			exit("File Upload Size Limit Is 2 MB Only");
         		}elseif($extention == "png" || $extention == "jpg" || $extention == "jpeg"){
         			
         			UploadFile($_FILES['cat_image']['tmp_name'], 1000, 500, 500, 500, TRUE, $newname, $uploaddir, $Catgory_ID, '../../' . $CategeryData['category_imglg'], '../../' . $CategeryData['category_imgsm'], 'category', 'category_imglg', 'category_imgsm', 'category_id', $Catgory_ID, $conn, $extention);
         			
         		}else{
         			exit("Please Select The Images Only...!");
         		} 
			} 
			exit('success');
		}else{
			exit('Please Enter The Category Name');
		}

	}

	header('Location: ' . $SiteUrl . 'admin/index.php');
	exit();
