<?php 

	function CleanString($string){
		$string = trim($string);
		$string = addslashes($string);
		$string = htmlspecialchars($string);
		// $string = filter_var($string, FILTER_SANITIZE_STRING);
		return $string;
	}

	function dd($array){
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}

	function GenerateCSRF(){
		$_SESSION['csrf'] = bin2hex(random_bytes(10));
		return $_SESSION['csrf'];
	}

	function UserLog($connection, $array){
		$userid = $array['userid'];
		$changeduserid = $array['changeduserid'];
		$user_comment = $array['user_comment'];
		if(empty(trim($changeduserid)) || $changeduserid == null){
			mysqli_query($connection, "INSERT INTO userlog SET 
				`logbyuserid` = ".$userid.",
				`user_comment` = '".$user_comment."'
			");
		}else{
			mysqli_query($connection, "INSERT INTO userlog SET 
				`logbyuserid` = ".$userid.",
				`logforuserid` = ".$changeduserid.",
				`user_comment` = '".$user_comment."'
			");
		
		}
	}

	function SetEmptyFields($Field1, $Feilds2){
		if(trim($Field1) == '' || trim($Field1) == null){
			return $Feilds2;
		}else{
			return $Field1;
		}
	}

  function GenerateSlug($Field, $Field2){
  	if(isset($Field) && !empty($Field)){
  		return strtolower(preg_replace('/[^a-zA-Z]/', '-', $Field));
  	}else{
  		return strtolower(preg_replace('/[^a-zA-Z]/', '-', $Field2));
  	}
  }

  function UploadFile($FileName, $width1, $height1, $height2 = null, $width2 = null, $SecondImage = null, $newname, $uploaddir, $MergeID = null, $UnlinkCol1, $UnlinkCol2 = null, $TableName, $DBCol1 = null, $DBCol2 = null, $UpdateIDCol, $UpdateID, $conn, $extention = null){
  $image = new Resize_Image;
	$image->new_width = $width1;
	$image->new_height = $height1;
	$image->image_to_resize = $FileName;
	$image->ratio = true; 
  $image->new_image_name = $newname;
	$image->save_folder = $uploaddir;
	$process = $image->resize();
	$process['result'] && $image->save_folder;
	if($SecondImage){
		$image2 = new Resize_Image;
		$image2->new_width = $width2;
		$image2->new_height = $height2;
		$image2->image_to_resize = $FileName;
		$image2->ratio = true;
		$image2->new_image_name = $newname . $MergeID;
		$image2->save_folder = $uploaddir;
		$process2 = $image2->resize();
		$process2['result'] && $image2->save_folder;
		@unlink($UnlinkCol2);
		mysqli_query($conn, "UPDATE $TableName SET 
		`".$DBCol1."` = '".str_replace('../', '', $process['new_file_path'])."',
		`".$DBCol2."` = '".str_replace('../', '', $process2['new_file_path'])."'
		WHERE $UpdateIDCol = '".$UpdateID."'"); 
	}else{
		mysqli_query($conn, "UPDATE $TableName SET 
		`".$DBCol1."` = '".str_replace('../', '', $process['new_file_path'])."'
		WHERE $UpdateIDCol = '".$UpdateID."'"); 
	}
	@unlink($UnlinkCol1);
	 
  }

  function ReplaceFunction($pattern, $string){
  	$string = preg_replace($pattern, '', $string);
  	return $string;
  }

  function GetThemeData($ThemeID, $conn){
  	return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM themes WHERE id = $ThemeID"));
  }

  function GetThemeFile($FolderName, $action = null, $front = null){
  	if($action == null && $front == null){
  		return file_get_contents('../themes/' . $FolderName . '/themeconfig.json');
  	}elseif($action == null && $front == true){
  		return file_get_contents('themes/' . $FolderName . '/themeconfig.json');
  	}else{
  		return file_get_contents('../../themes/' . $FolderName . '/themeconfig.json');
  	}
  }

function SetThemeFile($FolderName, $action = null, $front = null, $data){
  	if($action == null && $front == null){
  		return file_put_contents('../themes/' . $FolderName . '/themeconfig.json', $data);
  	}elseif($action == null && $front == true){
  		return file_put_contents('themes/' . $FolderName . '/themeconfig.json', $data);
  	}else{
  		return file_put_contents('../../themes/' . $FolderName . '/themeconfig.json', $data);
  	}
  }

  function GetHeaderMenus($conn, $themeid){
     $MainMenu = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM theme_main_menus WHERE theme_id = ".$themeid." AND header = 'active'"));
     if(isset($MainMenu)){
    	 $MenusHeaderQuery = mysqli_query($conn, "SELECT * FROM theme_menus WHERE theme_id =  $themeid AND menu_id = ".$MainMenu['id']." AND status = 1");
    	 if(mysqli_num_rows($MenusHeaderQuery) > 0){
    	 	return $MenusHeaderQuery;
    	 }else{
    	 	return false;
    	 }
     }else{
      return false;
     }
  }

  function GetMobileMenu($conn, $themeid){
  	 $MenusHeaderQuery = mysqli_query($conn, "SELECT * FROM theme_menus WHERE theme_id =  $themeid AND menu_location = 'mobile'");
  	 if(mysqli_num_rows($MenusHeaderQuery) > 0){
  	 	return $MenusHeaderQuery;
  	 }else{
  	 	return false;
  	 }
  }

  function GetColors($conn, $themeid){
  	$ColorsQuery = mysqli_query($conn, "SELECT * FROM theme_colors WHERE theme_id =  $themeid");
  	if(mysqli_num_rows($ColorsQuery) > 0){
  	 	return $ColorsQuery;
  	}else{
  	 	return false;
  	}
  }

   function GetFooterMenu($conn, $themeid){
  	 $MenusHeaderQuery = mysqli_query($conn, "SELECT * FROM theme_menus WHERE theme_id =  $themeid AND menu_location = 'footer' AND status = 1");
  	 if(mysqli_num_rows($MenusHeaderQuery) > 0){
  	 	return $MenusHeaderQuery;
  	 }else{
  	 	return false;
  	 }
  }

function GetCategoryMenus($conn){
	 $CategoryQuery = mysqli_query($conn, "SELECT category_id, category_name, category_slug, category_sort FROM category WHERE category_status = 1");
	 if(mysqli_num_rows($CategoryQuery) > 0){
	 	return $CategoryQuery;
	 }else{
	 	return false;
	 }
}

function smart_wordwrap($string, $width = 75, $break = "<br/>") {
    // split on problem words over the line length
    $pattern = sprintf('/([^ ]{%d,})/', $width);
    $output = '';
    $words = preg_split($pattern, $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

    foreach ($words as $word) {
        if (false !== strpos($word, ' ')) {
            // normal behaviour, rebuild the string
            $output .= $word;
        } else {
            // work out how many characters would be on the current line
            $wrapped = explode($break, wordwrap($output, $width, $break));
            $count = $width - (strlen(end($wrapped)) % $width);

            // fill the current line and add a break
            $output .= substr($word, 0, $count) . $break;

            // wrap any remaining characters from the problem word
            $output .= wordwrap(substr($word, $count), $width, $break, true);
        }
    }

    // wrap the final output
    return wordwrap($output, $width, $break);
}

function GetSliders($conn, $themeid){
	 $MenusHeaderQuery = mysqli_query($conn, "SELECT * FROM slider WHERE theme_id =  $themeid AND status = 1");
	 if(mysqli_num_rows($MenusHeaderQuery) > 0){
	 	return $MenusHeaderQuery;
	 }else{
	 	return false;
	 }
}


function TypeLength($length = null){
  if($length == null){
    return 'maxlength="250"';
  }else{
    return 'maxlength="'.$length.'"';
  }
}
 


function CheckDuplicationCombine($array1, $type){
    $count = 0;
    $MatchingArray = [];
    foreach($array1 as $key => $value){
        for($i = 0; $i < count($array1); $i++){
            if($type == 'fixed'){
                 if($array1[$i]['quantity'] == $value['quantity'] && $array1[$i]['size_title'] != $value['size_title']){
                    $IndexArray[] = $i;
                    $MatchingArray[$count]['quantity'] = $array1[$i]['quantity'];  
                    $MatchingArray[$count]['size_title'] = $array1[$i]['size_title'] . ', ' . $value['size_title'];  
                } 
            }elseif($type == 'customsizeproduct'){
                if($array1[$i]['customsizewith'] == $value['customsizewith'] && $array1[$i]['customsizeheight'] == $value['customsizeheight'] && $array1[$i]['size_title'] != $value['size_title']){
                    $IndexArray[] = $i;
                    $MatchingArray[$count]['customsizewith'] = $array1[$i]['customsizewith'];  
                    $MatchingArray[$count]['customsizeheight'] = $array1[$i]['customsizeheight'];  
                    $MatchingArray[$count]['size_title'] = $array1[$i]['size_title'] . ', ' . $value['size_title'];  
                } 
            }elseif($type == "rangemultiplication" || $type == "rangenotmultiplication"){
                if($array1[$i]['qfrom'] == $value['qfrom'] && $array1[$i]['qto'] == $value['qto'] && $array1[$i]['size_title'] != $value['size_title']){
                    $IndexArray[] = $i;
                    $MatchingArray[$count]['qfrom'] = $array1[$i]['qfrom'];  
                    $MatchingArray[$count]['qto'] = $array1[$i]['qto'];  
                    $MatchingArray[$count]['size_title'] = $array1[$i]['size_title'] . ', ' . $value['size_title'];  
                } 
            }
        } 
        $count++;
    }
    foreach ($MatchingArray as $key => $value) {
      for ($i = 0; $i < count($MatchingArray) ; $i++) {
        if($type == 'fixed'){
             if($array1[$i]['quantity'] == $value['quantity']){
                $IndexArray2[] = $i;
            } 
        }elseif($type == 'customsizeproduct'){
            if($array1[$i]['customsizewith'] == $value['customsizewith'] && $array1[$i]['customsizeheight'] == $value['customsizeheight']){
                $IndexArray2[] = $i;
            } 
        }elseif($type == "rangemultiplication" || $type == "rangenotmultiplication"){
            if($array1[$i]['qfrom'] == $value['qfrom'] && $array1[$i]['qto'] == $value['qto']){
                $IndexArray2[] = $i;
            } 
        }

      }
    }

      for($s = 0; $s < count($IndexArray); $s++ ){
        unset($array1[$IndexArray[$s]]);    
      }

     for($s = 0; $s < count($IndexArray2); $s++ ){
        unset($MatchingArray[$IndexArray2[$s]]);    
     }
      foreach ($MatchingArray as $value) {
        array_push($array1, $value);
     }
     return $array1;
}
?>	
