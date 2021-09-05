<?php 

	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


	//get database connection
	include_once '../config/database.php';

	//instantiate user object
	include_once '../class/patient.php';


	$database = new Database();
	$db = $database->dbConnection();

	$patient = new Patient($db);

	$patient-> first_name			= $_POST['first_name'];
	$patient-> last_name 			= $_POST['last_name'];
	$patient-> gender 				= $_POST['gender'];
	$patient-> date_of_birth 		= $_POST['date_of_birth']; 
	$patient-> profession 			= $_POST['profession'];
	$patient-> email 				= $_POST['email'];
	$patient-> phone 				= $_POST['phone'];
	$patient-> clinic_location 		= $_POST['clinic_location'];
	$patient-> picture  			= $_POST['picture'];
	$patient-> street 				= $_POST['street'];
	$patient-> city 				= $_POST['city'];
	$patient-> country 				= $_POST['country'];
	$patient-> postalcode 			= $_POST['postalcode'];
	$patient-> note 				= $_POST['note'];
	$patient-> password 			= $_POST['password'];
	$patient-> referrer 			= $_POST['referrer'];
	$patient-> referrer_details 	= $_POST['referrer_details'];

	$patient->pid = isset($_GET['pid'])?$_GET['pid']:die();

	if($patient->update_patient($patient->pid)){

			$patient_arr = array(
				"status" 	=> true,
				"message" 	=> "Patient Record Update Successfully!"
			);
			http_response_code(200);

	}else{
			http_response_code(400);
			$patient_arr = array(
				"status" 	=> false,
				"message" 	=> "Record could not update Successfully!"
			);

	}

	print_r(json_encode($patient_arr));

 ?>