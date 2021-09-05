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

	$patient->pid = isset($_GET['pid'])?$_GET['pid']:false;
	
	$stmt = $patient->getSinglePatient($patient->pid);

	if($stmt->rowCount() > 0){
		
		$patient_arr = array();
		$patient_arr['body'] = array();

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

			array_push($patient_arr['body'], $row);	

		}
		http_response_code(200);		

	}
	else{
		http_response_code(400);
		$patient_arr = array(
			
			"status"  => false,
			"message" => "No Record Found"
		);

	}
	
	print_r(json_encode($patient_arr));


 ?>