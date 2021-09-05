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

	$user->username = isset($_POST['username'])?$_POST['username']:die();
	$user->password = isset($_POST['password'])?md5($_POST['password']):die();

	$stmt = $user->login();

	if($stmt->rowCount() > 0){

		// get retrived row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		// create array
		$user_arr = array(
			"status" 	=> true,
			"message" 	=> "Successfully Login!",
			"id"		=> $row['id'],
			"username"	=> $row['username']

		);

	}
	else{

		$user_arr = array(
			"status" 	=> false,
			"message"	=> "Invalid Username And Password"	
		);
	}

	print_r(json_encode($user_arr));

 ?>