<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


	//get database connection
	include_once '../config/database.php';

	//instantiate user object
	include_once '../class/user.php';


	$database = new Database();
	$db = $database->dbConnection();

	$user = new User($db);

	$user->oauth_provider 	= "isweb";
	$user->oauth_uid		= "Null";
	$user->first_name		= $_POST['first_name'];
	$user->last_name		= $_POST['last_name'];
	$user->username			= $_POST['username'];
	$user->email			= $_POST['email'];
	$user->password 		= md5($_POST['password']);
	$user->gender			= $_POST['gender'];
	$user->phone			= $_POST['phone'];
	$user->locale			= "Null";
	$user->picture 			= "Null";
	$user->type 			=  1;
	$user->status 			=  0;
	$user->created 			= date('y-m-d H:i:s');
	$user->modified 		= date('y-m-d H:i:s');

	//create the user

	if($user->signup()){
		$user_arr = array(
			"status"  	=> true,
			"message"	=> "Successfully Signup",
			"id"		=> $user->id,
			"username"	=> $user->username
		);	
	}
	else{

		$user_arr = array(
			"status" 	=> false,
			"message" 	=> "Username already exists!" 
		);
	}

	print_r(json_encode($user_arr));
 ?>