<?php 
	require_once('inc/config.php');
	require_once('inc/functions.php');
	require_once('inc/resize.image.class.php');
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	ini_set('display_errors' , 'on');
 
	
 function UploadFile2($FileName, $uploaddir, $TableName, $DBCol1 = null, $DBCol2 = null,  $UpdateID, $conn, $Extention){
 	if($Extention == 'jpg' || $Extention == 'jpeg' || $Extention == 'png'){
 		$newname = bin2hex(random_bytes(5));
	    $image = new Resize_Image;
		$image->new_width = 600;
		$image->new_height = 600;
		$image->image_to_resize = $FileName;
		$image->ratio = true; 
	    $image->new_image_name = $newname;
		$image->save_folder = $uploaddir;
		$process = $image->resize();
		$process['result'] && $image->save_folder;
		
		$image2 = new Resize_Image;
		$image2->new_width = 100;
		$image2->new_height = 100;
		$image2->image_to_resize = $FileName;
		$image2->ratio = true;
		$image2->new_image_name = $newname . $UpdateID;
		$image2->save_folder = $uploaddir;
		$process2 = $image2->resize();
		$process2['result'] && $image2->save_folder;
		mysqli_query($conn, "UPDATE $TableName SET 
		`".$DBCol1."` = '".str_replace('../', '', $process['new_file_path'])."',
		`".$DBCol2."` = '".str_replace('../', '', $process2['new_file_path'])."'
		WHERE `id` = '".$UpdateID."'"); 
		 return true;
		}else{
			return false;
		}
	  }

	function DeleteAction($String, $Action, $conn, $ProductID){
		$String = mysqli_real_escape_string($conn, $String);
		if(isset($String) && !empty($String) && trim($Action) == 'sizes'){
			$String2 = explode(',', $String);
			if(isset($String2) && count($String2) > 0){
				foreach ($String2 as $size) {
					 $SizeData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, size_imglg, size_imgsm FROM product_sizes WHERE id = ".$size." " ));
					 	@unlink('../../'.$SizeData['size_imglg']);
						@unlink('../../'.$SizeData['size_imgsm']);
					mysqli_query($conn, "DELETE FROM product_sizes WHERE id = ".$size." ");
				}
				
			}
		}

		if(isset($String) && !empty($String) && (trim($Action) == 'colors' || trim($Action) == 'innercolors')){
			$String2 = explode(',', $String);
			if(isset($String2) && count($String2) > 0){
				foreach ($String2 as $color) {
					 $ColorData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, color_imglg, color_imgsm FROM product_colors WHERE id = ".$color." " ));
					 	@unlink('../../'.$ColorData['color_imglg']);
						@unlink('../../'.$ColorData['color_imgsm']);
					mysqli_query($conn, "DELETE FROM product_colors WHERE id = ".$color." ");
				}

			}
		
		}
		if(isset($String) && !empty($String) && trim($Action) == 'units'){
			$String2 = explode(',', $String);
			if(isset($String2) && count($String2) > 0){
				foreach ($String2 as $unit) {
					 $UnitData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, unit_imglg, unit_imgsm FROM product_unit WHERE id = ".$unit." " ));
					 	@unlink('../../'.$UnitData['unit_imglg']);
						@unlink('../../'.$UnitData['unit_imgsm']);
					mysqli_query($conn, "DELETE FROM product_unit WHERE id = ".$unit." ");
				}
				
			}
		}
		if(isset($String) && !empty($String) && trim($Action) == 'colorsizes'){
			$String2 = explode(',', $String);
			if(isset($String2) && count($String2) > 0){
				foreach ($String2 as $size) {
					 $ColorQuery = mysqli_query($conn, "SELECT id, color_imglg, color_imgsm FROM product_colors WHERE size_id = ".$size." " );
					 while($Colors = mysqli_fetch_assoc($ColorQuery)){
				 		@unlink('../../'.$Colors['color_imglg']);
						@unlink('../../'.$Colors['color_imgsm']);
						mysqli_query($conn, "DELETE FROM product_colors WHERE id = ".$Colors['id']." ");
					 }  
					mysqli_query($conn, "DELETE FROM product_sizes WHERE id = ".$size." ");
				}
				
			}
		}
		
	}  
	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['action']) && ($_POST['action'] == 'ProductOptions' || (isset($SizeColorData) && $SizeColorData['action'] == 'ProductOptions'))){
		$SubmitAction = mysqli_real_escape_string($conn, CleanString($_POST['SubmitAction']));
		$ProductID = mysqli_real_escape_string($conn, CleanString($_POST['ProductID']));
		$UpdateAction = 'Set';
		DeleteAction(CleanString($_POST['DeleteInnerColors']), 'innercolors', $conn, $ProductID);
		DeleteAction(CleanString($_POST['DeleteUnits']), 'units', $conn, $ProductID);
		DeleteAction(CleanString($_POST['DeleteSizes']), 'sizes', $conn, $ProductID);
		DeleteAction(CleanString($_POST['DeleteSizesOfColor']), 'colorsizes', $conn, $ProductID);
		DeleteAction(CleanString($_POST['DeleteColors']), 'colors', $conn, $ProductID);
		// dd($_POST['DeleteColors']);
		// exit();
		if($SubmitAction == 'sizes'){
			if(isset($_POST['size_name']) && count($_POST['size_name']) > 0 ){
				for ($i = 0; $i < count($_POST['size_name']) ; $i++) {
					$SizeName = mysqli_real_escape_string($conn, CleanString($_POST['size_name'][$i]));
					$SizeQuantity = mysqli_real_escape_string($conn, CleanString($_POST['size_quantity'][$i]));
					$SizePrice = !empty($_POST['size_price'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['size_price'][$i])) : '' ;
					$SizeDiscount = !empty($_POST['size_discount'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['size_discount'][$i])) : 0;
					
					$HiddenID = isset($_POST['sizehiddenid'][$i]) && !empty($_POST['sizehiddenid'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['sizehiddenid'][$i])) : null;
					
					if(empty($SizeName) || empty($SizeQuantity)){
						continue;
					}
					

					if( $HiddenID ){
						 $SizeData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, size_imglg, size_imgsm FROM product_sizes WHERE id = '".$HiddenID."' " ));
						 mysqli_query($conn, "UPDATE product_sizes SET 
								`product_id` = ".$ProductID.",
								`size_name` = '".$SizeName."',
								`size_price` = '".$SizePrice."',
								`size_quantity` = ".$SizeQuantity.",
								`size_discount` = ".$SizeDiscount."
							WHERE id = ".$SizeData['id']." ");
						$InsertID = $SizeData['id']; 
					}else{
						$SizeData = null;
						mysqli_query($conn, "INSERT INTO product_sizes SET 
								`product_id` = ".$ProductID.",
								`size_name` = '".$SizeName."',
								`size_price` = '".$SizePrice."',
								`size_quantity` = ".$SizeQuantity.",
								`size_discount` = ".$SizeDiscount."
							");
						$InsertID = mysqli_insert_id($conn); 
					}

					if(isset($_FILES['size_image']['name'][$i]) && !empty($_FILES['size_image']['name'][$i])){
						$name = basename($_FILES['size_image']['name'][$i]);
         				$extention = pathinfo($name, PATHINFO_EXTENSION);
						$uploaddir = '../../upload/product/product_sizes/';
         				if(UploadFile2($_FILES['size_image']['tmp_name'][$i], $uploaddir, 'product_sizes', 'size_imglg', 'size_imgsm',  $InsertID, $conn, $extention)){
     						if(isset($SizeData) && $SizeData != null){
     							@unlink('../../'.$SizeData['size_imglg']);
     							@unlink('../../'.$SizeData['size_imgsm']);
     						}
         				}
					}
				}
			}
		$SizesCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM product_sizes WHERE product_id = $ProductID"));
		if($SizesCount == 0 || $SizesCount < 1){
			mysqli_query($conn, "UPDATE products SET action = null WHERE id = ".$ProductID." ");
			$UpdateAction = 'Not Set';
		}
		}elseif($SubmitAction == 'sizescolors'){
			if(isset($_POST['sizecolor_name']) && count($_POST['sizecolor_name']) > 0 ){
				for ($i = 0; $i < count($_POST['sizecolor_name']) ; $i++) {
					$SizeName = mysqli_real_escape_string($conn, CleanString($_POST['sizecolor_name'][$i]));
					
					$HiddenID = isset($_POST['sizehiddenid'][$i]) && !empty($_POST['sizehiddenid'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['sizehiddenid'][$i])) : null;

					if(empty($SizeName)){
						continue;
					}
			 


					if( $HiddenID ){
						 $SizeData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, size_imglg, size_imgsm FROM product_sizes WHERE id = '".$HiddenID."' " ));

						 mysqli_query($conn, "UPDATE product_sizes SET 
									`product_id` = ".$ProductID.",
									`size_name` = '".$SizeName."'
								WHERE id = ".$SizeData['id']." ");
					}else{
						$SizeData = null;
						mysqli_query($conn, "INSERT INTO product_sizes SET 
									`product_id` = ".$ProductID.",
									`size_name` = '".$SizeName."'
								");
					}
					
				}
				for ($i = 0; $i < count($_POST['size_color_name']) ; $i++) {
					$ColorName = mysqli_real_escape_string($conn, CleanString($_POST['size_color_name'][$i]));
					$ColorCode = mysqli_real_escape_string($conn, CleanString($_POST['size_color_code'][$i]));
					$ColorPrice = !empty($_POST['size_color_price'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['size_color_price'][$i])) : '' ;
					$ColorQty = mysqli_real_escape_string($conn, CleanString($_POST['size_color_product_qty'][$i]));
					$ColorDiscount = !empty($_POST['size_color_discount'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['size_color_discount'][$i])) : 0;
					$SizeHidden = mysqli_real_escape_string($conn, CleanString($_POST['size_color_name_hidden'][$i]));
					
					$HiddenID = isset($_POST['sizehiddenColorID'][$i]) && !empty($_POST['sizehiddenColorID'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['sizehiddenColorID'][$i])) : null;
					


					if(empty($ColorName) || empty($ColorQty)){
						continue;
					}

					$SizeID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM product_sizes WHERE size_name = '".$SizeHidden."' "));
					if(isset($SizeID) AND count($SizeID) != 0){
						$SizeID = $SizeID['id'];
 
						if( $HiddenID ){
							$ColorData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, color_imglg, color_imgsm FROM product_colors WHERE id = ".$HiddenID."" ));
							 mysqli_query($conn, "UPDATE product_colors SET 
								`product_id` = ".$ProductID.",
								`size_id` = '".$SizeID."',
								`color_name` = '".$ColorName."',
								`color_code` = '".$ColorCode."',
								`color_price` = '".$ColorPrice."',
								`color_quantity` = ".$ColorQty.",
								`color_discount` = ".$ColorDiscount."
							WHERE id = ".$ColorData['id']." " );
							$InsertID = $ColorData['id'];

						}else{
							$ColorData = null;
							mysqli_query($conn, "INSERT INTO product_colors SET 
								`product_id` = ".$ProductID.",
								`size_id` = '".$SizeID."',
								`color_name` = '".$ColorName."',
								`color_code` = '".$ColorCode."',
								`color_price` = '".$ColorPrice."',
								`color_quantity` = ".$ColorQty.",
								`color_discount` = ".$ColorDiscount."
							");
							$InsertID = mysqli_insert_id($conn);
						}




					if(isset($_FILES['size_color_image']['name'][$i]) && !empty($_FILES['size_color_image']['name'][$i])){
						$name = basename($_FILES['size_color_image']['name'][$i]);
         				$extention = pathinfo($name, PATHINFO_EXTENSION);
						$uploaddir = '../../upload/product/product_colors/';
							if(UploadFile2($_FILES['size_color_image']['tmp_name'][$i], $uploaddir, 'product_colors', 'color_imglg', 'color_imgsm',  $InsertID, $conn, $extention)){
	 							if(isset($ColorData) && $ColorData != null){
	     							@unlink('../../'.$ColorData['color_imglg']);
	     							@unlink('../../'.$ColorData['color_imgsm']);
	     						}
							}
						}
					}
				}
			}
		$SizesCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM product_sizes WHERE product_id = $ProductID"));
			if($SizesCount == 0){
				mysqli_query($conn, "UPDATE products SET action = NULL WHERE id = ".$ProductID." ");
				$UpdateAction = 'Not Set';
			}
		}elseif($SubmitAction == 'colors'){
			if(isset($_POST['color_name']) && count($_POST['color_name']) > 0 ){
				for ($i = 0; $i < count($_POST['color_name']) ; $i++) {
					$ColorName = mysqli_real_escape_string($conn, CleanString($_POST['color_name'][$i]));
					$ColorCode = mysqli_real_escape_string($conn, CleanString($_POST['color_code'][$i]));
					$ColorQuantity = mysqli_real_escape_string($conn, CleanString($_POST['color_qty'][$i]));
					$ColorPrice = !empty($_POST['color_price'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['color_price'][$i])) : '' ;
					$ColorDiscount = !empty($_POST['color_discount'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['color_discount'][$i])) : 0;

					$HiddenID = isset($_POST['colorhiddenid'][$i]) && !empty($_POST['colorhiddenid'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['colorhiddenid'][$i])) : null;


					if(empty($ColorName) || empty($ColorQuantity)){
						continue;
					}
					
					if( $HiddenID ){
						$ColorData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, color_imglg, color_imgsm FROM product_colors WHERE id = '".$HiddenID."' " ));
						mysqli_query($conn, "UPDATE product_colors SET 
							`product_id` = ".$ProductID.",
							`color_name` = '".$ColorName."',
							`color_code` = '".$ColorCode."',
							`color_price` = '".$ColorPrice."',
							`color_quantity` = ".$ColorQuantity.",
							`color_discount` = ".$ColorDiscount."
							WHERE id = ".$ColorData['id']."
						");
						$InsertID = $ColorData['id']; 
					}else{
						$ColorData = null;
						mysqli_query($conn, "INSERT INTO product_colors SET 
							`product_id` = ".$ProductID.",
							`color_name` = '".$ColorName."',
							`color_code` = '".$ColorCode."',
							`color_price` = '".$ColorPrice."',
							`color_quantity` = ".$ColorQuantity.",
							`color_discount` = ".$ColorDiscount."
						");
						$InsertID = mysqli_insert_id($conn); 
					}


					if(isset($_FILES['color_image']['name'][$i]) && !empty($_FILES['color_image']['name'][$i])){
						$name = basename($_FILES['color_image']['name'][$i]);
         				$extention = pathinfo($name, PATHINFO_EXTENSION);
						$uploaddir = '../../upload/product/product_colors/';
         				if(UploadFile2($_FILES['color_image']['tmp_name'][$i], $uploaddir, 'product_colors', 'color_imglg', 'color_imgsm',  $InsertID, $conn, $extention)){
     						if(isset($ColorData) && $ColorData != null){
     							@unlink('../../'.$ColorData['color_imglg']);
     							@unlink('../../'.$ColorData['color_imgsm']);
     						}
         				}
					}
				}
			}

			$ColorsCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM product_colors WHERE product_id = $ProductID"));
			if($ColorsCount == 0 || $ColorsCount < 1){
				mysqli_query($conn, "UPDATE products SET action = null WHERE id = ".$ProductID." ");
				$UpdateAction = 'Not Set';
			}
				
		}elseif($SubmitAction == 'units'){
			if(isset($_POST['unit_name']) && count($_POST['unit_name']) > 0 ){
				for ($i = 0; $i < count($_POST['unit_name']) ; $i++) {
					$UnitName = mysqli_real_escape_string($conn, CleanString($_POST['unit_name'][$i]));
					$UnitQuantity = mysqli_real_escape_string($conn, CleanString($_POST['unit_quantity'][$i]));
					$UnitPrice = !empty($_POST['unit_price'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['unit_price'][$i])) : '' ;
					$UnitDiscount = !empty($_POST['unit_discount'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['unit_discount'][$i])) : 0;
					
					$HiddenID = isset($_POST['unithiddenid'][$i]) && !empty($_POST['unithiddenid'][$i]) ? mysqli_real_escape_string($conn, CleanString($_POST['unithiddenid'][$i])) : null;

					if(empty($UnitName) || empty($UnitQuantity)){
						continue;
					}
					if( $HiddenID ){
						$UnitData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, unit_imglg, unit_imgsm FROM product_unit WHERE id = ".$HiddenID."  " ));
			 					mysqli_query($conn, "UPDATE product_unit SET 
									`product_id` = ".$ProductID.",
									`unit_name` = '".$UnitName."',
									`unit_price` = '".$UnitPrice."',
									`unit_quantity` = ".$UnitQuantity.",
									`unit_discount` = ".$UnitDiscount."
									WHERE id = ".$UnitData['id']."
								");
				 
						$InsertID = $UnitData['id']; 
					}else{
						mysqli_query($conn, "INSERT INTO product_unit SET 
										`product_id` = ".$ProductID.",
										`unit_name` = '".$UnitName."',
										`unit_price` = '".$UnitPrice."',
										`unit_quantity` = ".$UnitQuantity.",
										`unit_discount` = ".$UnitDiscount."
									");
					 
						$InsertID = mysqli_insert_id($conn); 
					}


					if(isset($_FILES['unit_image']['name'][$i]) && !empty($_FILES['unit_image']['name'][$i])){
						$name = basename($_FILES['unit_image']['name'][$i]);
         				$extention = pathinfo($name, PATHINFO_EXTENSION);
						$uploaddir = '../../upload/product/product_units/';
         				if(UploadFile2($_FILES['unit_image']['tmp_name'][$i], $uploaddir, 'product_unit', 'unit_imglg', 'unit_imgsm',  $InsertID, $conn, $extention)){
         					if(isset($UnitData) && $UnitData != null){
     							@unlink('../../'.$UnitData['unit_imglg']);
     							@unlink('../../'.$UnitData['unit_imgsm']);
     						}
         				}
					}
				}
			}
		$UnitCount = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM product_unit WHERE product_id = $ProductID"));
			if($UnitCount == 0 || $UnitCount < 1){
				mysqli_query($conn, "UPDATE products SET action = null WHERE id = ".$ProductID." ");
				$UpdateAction = 'Not Set';
			}
		}
		if($UpdateAction == 'Set'){
			mysqli_query($conn, "UPDATE products SET action = '".$SubmitAction."' WHERE id = ".$ProductID." ");
		}
		exit('success');
	}
	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['action']) && $_POST['action'] == 'ProductSubmit'){
		$category = mysqli_real_escape_string($conn, CleanString($_POST['category']));
		$subcategory = mysqli_real_escape_string($conn, CleanString($_POST['subcategory']));
		$subsubcategory = !empty($_POST['subsubcategory']) && isset($_POST['subsubcategory']) ? mysqli_real_escape_string($conn, CleanString($_POST['subsubcategory'])) : 0 ;
		$product_name = mysqli_real_escape_string($conn, CleanString($_POST['product_name']));
		$product_type = mysqli_real_escape_string($conn, CleanString($_POST['producttype']));
		$product_url = mysqli_real_escape_string($conn, CleanString($_POST['product_url']));
		$alttitle = mysqli_real_escape_string($conn, CleanString($_POST['alttitle']));
		$product_skucode = mysqli_real_escape_string($conn, CleanString($_POST['product_skucode']));
		$product_quantity = mysqli_real_escape_string($conn, CleanString($_POST['product_quantity']));
		$product_deals = mysqli_real_escape_string($conn, CleanString($_POST['product_deals']));
		$dealsstart = isset($_POST['dealsstart']) && !empty($_POST['dealsstart']) ? mysqli_real_escape_string($conn, CleanString($_POST['dealsstart'])) : NULL;
		$dealend = isset($_POST['dealend']) && !empty($_POST['dealend']) ? mysqli_real_escape_string($conn, CleanString($_POST['dealend'])) : NULL;
		$brands = isset($_POST['brands']) && !empty($_POST['brands']) ? mysqli_real_escape_string($conn, CleanString($_POST['brands'])) : 0;
		$discount = !empty($_POST['discount']) ? mysqli_real_escape_string($conn, CleanString($_POST['discount'])) : 0;
		$best_seller = mysqli_real_escape_string($conn, CleanString($_POST['best_seller']));
		$product_sortorder = !empty($_POST['product_sortorder']) ? mysqli_real_escape_string($conn, CleanString($_POST['product_sortorder'])) : 0;
		$product_shortdesc = mysqli_real_escape_string($conn, CleanString($_POST['product_shortdesc']));
		$product_longdesc = mysqli_real_escape_string($conn, addslashes($_POST['product_longdesc']));
		$metatitle = mysqli_real_escape_string($conn, CleanString($_POST['metatitle']));
		$metadesc = mysqli_real_escape_string($conn, CleanString($_POST['metadesc']));
		$metakeyword = mysqli_real_escape_string($conn, CleanString($_POST['metakeyword']));
		$product_id = isset($_POST['product_id']) ? mysqli_real_escape_string($conn, CleanString($_POST['product_id'])) : null;
		$price = isset($_POST['price']) ? mysqli_real_escape_string($conn, CleanString($_POST['price'])) : null;
		
		$metatitle = SetEmptyFields($metatitle, $product_name);
		$metadesc = SetEmptyFields($metadesc, $product_name);
		$metakeyword = SetEmptyFields($metakeyword, $product_name);
		$product_url = GenerateSlug($product_url, $product_name);
		sleep(1);

		$ProductData = null;
		if(!empty($category) && !empty($product_name) && !empty($price) && !empty($product_quantity)){
				if(isset($product_id) && !empty($product_id)){
					// Update Record
					 mysqli_query($conn, "UPDATE products SET 
						 	`category_id` = '".$category."',
						 	`subcategory_id` = '".$subcategory."',
						 	`subsubcategory_id` = '".$subsubcategory."',
						 	`brand_id` = '".$brands."',
						 	`proname` = '".$product_name."',
						 	`product_type` = '".$product_type."',
						 	`url_link` = '".$product_url."',
						 	`shortdisc` = '".$product_shortdesc."',
						 	`longdisc` = '".$product_longdesc."',
						 	`price` = '".$price."',
						 	`skucode` = '".$product_skucode."',
						 	`d_price` = '".$discount."',
						 	`deals` = '".$product_deals."',
						 	`deals_s_date` = '".$dealsstart."',
						 	`deals_e_date` = '".$dealend."',
						 	`best_seller` = '".$best_seller."',
						 	`pro_qty` = '".$product_quantity."',
						 	`alttitle` = '".$alttitle."',
						 	`metatitle` = '".$metatitle."',
						 	`metakeyword` = '".$metadesc."',
						 	`metadisc` = '".$metakeyword."',
						 	`sort_order` = '".$product_sortorder."'
				 			WHERE id = ".$product_id."");
					 
					 	$ProductID = $product_id;
			 		 $ProductData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, imglg, imgsm FROM products WHERE id = ".$ProductID.""));
				}else{
					// Insert Record
					 mysqli_query($conn, "INSERT INTO products SET 
						 	`category_id` = '".$category."',
						 	`subcategory_id` = '".$subcategory."',
						 	`subsubcategory_id` = '".$subsubcategory."',
						 	`brand_id` = '".$brands."',
						 	`proname` = '".$product_name."',
						 	`product_type` = '".$product_type."',
						 	`url_link` = '".$product_url."',
						 	`shortdisc` = '".$product_shortdesc."',
						 	`longdisc` = '".$product_longdesc."',
						 	`price` = '".$price."',
						 	`skucode` = '".$product_skucode."',
						 	`d_price` = '".$discount."',
						 	`deals` = '".$product_deals."',
						 	`deals_s_date` = '".$dealsstart."',
						 	`deals_e_date` = '".$dealend."',
						 	`best_seller` = '".$best_seller."',
						 	`pro_qty` = '".$product_quantity."',
						 	`alttitle` = '".$alttitle."',
						 	`metatitle` = '".$metatitle."',
						 	`metakeyword` = '".$metadesc."',
						 	`metadisc` = '".$metakeyword."',
						 	`sort_order` = '".$product_sortorder."'");
					 $ProductID = mysqli_insert_id($conn);
				}

			if(isset($_FILES['productimg']['name']) && !empty($_FILES['productimg']['name'])){
				$name = basename($_FILES['productimg']['name']);
         		$extention = pathinfo($name, PATHINFO_EXTENSION);
				$newname = bin2hex(random_bytes(5));
         		$size = $_FILES['productimg']['size'];
         		$uploaddir = '../../upload/product/';
         		if($size > (2048*2048)){
         			exit("File Upload Size Limit Is 2 MB Only");
         		}elseif($extention == "png" || $extention == "jpg" || $extention == "jpeg"){

         			UploadFile($_FILES['productimg']['tmp_name'], 600, 600, 100, 100, TRUE, $newname, $uploaddir, $ProductID, '../../' . $ProductData['imglg'], '../../' . $ProductData['imgsm'], 'products', 'imglg', 'imgsm', 'id', $ProductID, $conn, $extention);

         		}else{
         			echo json_encode(['msg' => "Please Select The Images Only...!", 'id' => '']);
         			exit();
         		} 
			} 
			$UserActivityData = [
				'userid' => $UserId = $_SESSION['UserData']['id'],
				'changeduserid' => NULL,
				'user_comment' => 'User Has Manage The Sub Category Settings',
			];
			UserLog($conn, $UserActivityData);
			echo json_encode(['msg' => 'success', 'id' => $ProductID]);
			exit();
		}else{
			echo json_encode(['msg' => 'Please Enter The * Required Fields', 'id' => '']);
			exit();
		}
	}


   

header('Location: ' . $SiteUrl . 'admin/dashboard.php');
exit();
