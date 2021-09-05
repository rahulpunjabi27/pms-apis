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


	if($patient->add_patient()){
		$patient_arr = array(
			"status"  		=> true,
			"message"		=> "Successfully Add Patient",
			"id"			=> $patient->pid,
			"first_name"	=> $patient->first_name

		);
	}
	else{

		$patient_arr = array(
			"status" 	=> false,
			"message" 	=> "Please Fill All input Fields"		
		);
	}

	print_r(json_encode($patient_arr));

 ?>