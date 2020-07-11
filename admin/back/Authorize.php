<?php 
	require_once('../inc/config.php');
	require_once('../inc/functions.php');

	// Check Login Section 
	if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST)){
		sleep(1);
		$email = mysqli_real_escape_string($conn, CleanString($_POST['email']));
		$password = mysqli_real_escape_string($conn, CleanString($_POST['password']));
		
		if(!empty($email) && !empty($password)){
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				exit('Please Enter The Valid Email.');
			}else{
				// Get User Data From DB
				$UserData = mysqli_fetch_assoc(mysqli_query($conn, 'SELECT * FROM user WHERE user_email = "'.$email.'"'));
				if(isset($UserData)){
					if(password_verify($password, $UserData['user_password'])){
						$_SESSION['UserData'] = array(
							'email' => $UserData['user_email'],
							'name' => $UserData['user_name'], 
							'role_type' => $UserData['user_roletype'],
							'id' => $UserData['user_id']
						);
						exit('success');
					}else{
						exit('Invalid Login Credentials');
					}
				}else{
					exit('Invalid Login Credentials');
				}
			}
		}else{
			exit('Please Enter The All Required Fields');
		}

	}else{
		header('Location: ' . $SiteUrl . 'admin/dashboard.php');
		exit();
	}