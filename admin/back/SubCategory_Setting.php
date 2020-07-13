<?php 
	require_once('../inc/config.php');
	require_once('../inc/functions.php');
	require_once('../inc/resize.image.class.php');

	

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) AND $_POST['action'] != 'DeleteSingleRecord' && $_POST['action'] != 'DeleteBulkRecord'){
		if($_POST['action'] == 'Status'){
			// Change Status
			$subcat_id = mysqli_real_escape_string($conn, CleanString($_POST['subcat_id']));
			$value = mysqli_real_escape_string($conn, CleanString($_POST['value']));
			mysqli_query($conn, "UPDATE subcategory SET 
		 	`subcategory_status` = ".$value."
		 	 WHERE subcategory_id = ".$subcat_id."");
		}
		exit('success');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) && $_POST['action'] == 'DeleteSingleRecord'){
		 $subcat_id = mysqli_real_escape_string($conn, CleanString($_POST['subcatid']));
		 $SubSubCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subsubcategory WHERE subcategory_id = ".$subcat_id.""));
		 // $ProductsCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE subcategory_id = ".$subcat_id.""));
		 
		 if($SubSubCatCount > 0){
		 	exit("Please Delete The Assign SubSubcategory First");
		 }

		 // if($ProductsCatCount > 0){
		 // 	exit("Please Delete The Assign Product First");
		 // }

		 mysqli_query($conn, "UPDATE subcategory SET `del_status` = 1 WHERE subcategory_id = ".$subcat_id."");
		 exit('success');
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST) AND isset($_POST['action']) && $_POST['action'] == 'DeleteBulkRecord'){
		 $Count = null;
		 $msg = null;
		 foreach($_POST['subcatids'] as $subcatid){
		 	 $SubSubCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM subsubcategory WHERE subcategory_id = ".$subcatid.""));
			 // $ProductsCatCount = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM product WHERE subcategory_id = ".$subcatid.""));
			 
			 if($SubSubCatCount > 0){
		 	 	 $Count = 'set';
				 $msg = "Please Delete The Assign SubSubcategory First";
			 	 continue;
			 }

			 // if($ProductsCatCount > 0){
	 	 	 // $Count = 'set';
			 // $msg = "Please Delete The Assign Product First";
		 	 // continue;
			 // }
		 	mysqli_query($conn, "UPDATE subcategory SET `del_status` = 1 WHERE subcategory_id = ".$subcatid."");
		 }
		 $Count != 'set' ? exit('success') : exit($msg);
	}	

	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST)){
		sleep(1);
		$cat_id = mysqli_real_escape_string($conn, CleanString($_POST['category-chosen']));
		$subcat_name = mysqli_real_escape_string($conn, CleanString($_POST['subcat_name']));
		$subcat_slug = GenerateSlug(mysqli_real_escape_string($conn, CleanString($_POST['subcat_slug'])), $subcat_name);
		$subcat_salecaption = mysqli_real_escape_string($conn, CleanString($_POST['subcat_salecaption']));
		$subcat_status = isset($_POST['subcat_status']) ? mysqli_real_escape_string($conn, CleanString($_POST['subcat_status'])) : 0;
		$subcat_sortorder = !empty(trim($_POST['subcat_sortorder'])) ? mysqli_real_escape_string($conn, CleanString($_POST['subcat_sortorder'])) : 0 ;
		$subcat_shortdesc = mysqli_real_escape_string($conn, CleanString($_POST['subcat_shortdesc']));
		$subcat_longdesc = mysqli_real_escape_string($conn, addslashes($_POST['subcat_longdesc']));
		$metatitle = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metatitle'])), $subcat_name);
		$metadesc = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metadesc'])), $subcat_name);
		$metakeyword = SetEmptyFields(mysqli_real_escape_string($conn, CleanString($_POST['metakeyword'])), $subcat_name);
		$csrf = mysqli_real_escape_string($conn, CleanString($_POST['csrf']));
		$subcat_id = isset($_POST['subcat_id']) ? mysqli_real_escape_string($conn, CleanString($_POST['subcat_id'])) : null;
		
		// Check CSRF
		$_SESSION['csrf'] === $csrf ? true : exit('CSRF Token Mismatch');
		$SubcategeryData = null;
		if(!empty($subcat_name)){
				if(isset($subcat_id) && !empty($subcat_id)){
					// Update Record
					 mysqli_query($conn, "UPDATE subcategory SET 
					 	`category_id` = '".$cat_id."',
					 	`subcategory_name` = '".$subcat_name."',
					 	`subcategory_slug` = '".$subcat_slug."',
					 	`subcategory_shortdesc` = '".$subcat_shortdesc."',
					 	`subcategory_longdesc` = '".$subcat_longdesc."',
					 	`subcategory_sort` = ".$subcat_sortorder.",
					 	`subcategory_status` = ".$subcat_status.",
					 	`subcategory_salecaption` = '".$subcat_salecaption."',
					 	`title` = '".$metatitle."',
					 	`keyword` = '".$metakeyword."',
					 	`description` = '".$metadesc."'
					 	WHERE subcategory_id = ".$subcat_id."");
					 	$Subcatgory_ID = $subcat_id;
			 		 $SubcategeryData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM subcategory WHERE subcategory_id = ".$Subcatgory_ID.""));
				}else{
					// Insert Record
					 mysqli_query($conn, "INSERT INTO subcategory SET 
					 	`category_id` = '".$cat_id."',
					 	`subcategory_name` = '".$subcat_name."',
					 	`subcategory_slug` = '".$subcat_slug."',
					 	`subcategory_shortdesc` = '".$subcat_shortdesc."',
					 	`subcategory_longdesc` = '".$subcat_longdesc."',
					 	`subcategory_sort` = ".$subcat_sortorder.",
					 	`subcategory_status` = ".$subcat_status.",
					 	`subcategory_salecaption` = '".$subcat_salecaption."',
					 	`title` = '".$metatitle."',
					 	`keyword` = '".$metakeyword."',
					 	`description` = '".$metadesc."'");
					 $Subcatgory_ID = mysqli_insert_id($conn);
				}

			if(isset($_FILES['subcat_image']['name']) && !empty($_FILES['subcat_image']['name'])){
				$name = basename($_FILES['subcat_image']['name']);
         		$extention = pathinfo($name, PATHINFO_EXTENSION);
				$newname = bin2hex(random_bytes(5));
         		$size = $_FILES['subcat_image']['size'];
         		$uploaddir = '../../upload/subcategory/';
         		if($size > (2048*2048)){
         			exit("File Upload Size Limit Is 2 MB Only");
         		}elseif($extention == "png" || $extention == "jpg" || $extention == "jpeg"){
         			
         			UploadFile($_FILES['subcat_image']['tmp_name'], 1000, 500, 500, 500, TRUE, $newname, $uploaddir, $Subcatgory_ID, '../../' . $SubcategeryData['subcategory_imglg'], '../../' . $SubcategeryData['subcategory_imgsm'], 'subcategory', 'subcategory_imglg', 'subcategory_imgsm', 'subcategory_id', $Subcatgory_ID, $conn, $extention);

         		}else{
         			exit("Please Select The Images Only...!");
         		} 
			} 
			$UserActivityData = [
				'userid' => $UserId = $_SESSION['UserData']['id'],
				'changeduserid' => NULL,
				'user_comment' => 'User Has Manage The Sub Category Settings',
			];
			UserLog($conn, $UserActivityData);
			exit('success');
		}else{
			exit('Please Enter The Category Name');
		}

	}else{
		header('Location: ' . $SiteUrl . 'admin/index.php');
		exit();
	}