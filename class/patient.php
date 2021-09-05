<?php 

class Patient{


	//database connection and table name
	private $conn;
	private $table_name = "patient";

	public $pid;
	public $first_name;
	public $last_name;
	public $gender;
	public $date_of_birth;
	public $profession;
	public $email;
	public $phone;
	public $clinic_location;
	public $picture;
	public $street;
	public $city;
	public $country;
	public $postalcode;
	public $note;
	public $password;
	public $referrer;
	public $referrer_details;
	


	//constructor with $db as database connetion
	public function __construct($db){
		 $this->conn = $db;
	}

	//Get All Patient Records
	function getAllPatient(){

		$query 	= "SELECT * FROM $this->table_name";
		$stmt 	= $this->conn->prepare($query);
		//execute query
		$stmt->execute();
		return $stmt;

	}
	//delete patient
	function deletePatient($pid){

			$query = "DELETE FROM $this->table_name WHERE pid = '$this->pid'";
			$stmt 	= $this->conn->prepare($query);
			//execute query
			$stmt->execute();
			return $stmt;
	}

	//Add patient
	function add_patient(){
		$query = "INSERT INTO patient(first_name,last_name,gender,date_of_birth,profession,email,phone,clinic_location,picture,street,city,country,postalcode,note,password,referrer,referrer_details)";

		$query .= "VALUES(:first_name, :last_name, :gender, :date_of_birth, :profession, :email, :phone, :clinic_location, :picture, :street, :city, :country, :postalcode, :note, :password, :referrer, :referrer_details)";

		//prepare query;
		$stmt  = $this->conn->prepare($query);

		//santizie
		$this->first_name 				=htmlspecialchars(strip_tags($this->first_name));
		$this->last_name 				=htmlspecialchars(strip_tags($this->last_name));
		$this->gender 					=htmlspecialchars(strip_tags($this->gender));
		$this->date_of_birth 			=htmlspecialchars(strip_tags($this->date_of_birth));
		$this->profession 				=htmlspecialchars(strip_tags($this->profession));
		$this->email 					=htmlspecialchars(strip_tags($this->email));
		$this->phone 					=htmlspecialchars(strip_tags($this->phone));
		$this->clinic_location 			=htmlspecialchars(strip_tags($this->clinic_location));
		$this->picture 					=htmlspecialchars(strip_tags($this->picture));
		$this->street 					=htmlspecialchars(strip_tags($this->street));
		$this->city 					=htmlspecialchars(strip_tags($this->city));
		$this->country 					=htmlspecialchars(strip_tags($this->country));
		$this->postalcode 				=htmlspecialchars(strip_tags($this->postalcode));
		$this->note 					=htmlspecialchars(strip_tags($this->note));
		$this->password 				=htmlspecialchars(strip_tags($this->password));
		$this->referrer 				=htmlspecialchars(strip_tags($this->referrer));
		$this->referrer_details 		=htmlspecialchars(strip_tags($this->referrer_details));

		$patient_arr_values = array(
				":first_name" 		=> $this->first_name,
				":last_name"		=> $this->last_name,
				":gender"			=> $this->gender,
				":date_of_birth" 	=> $this->date_of_birth,
				":profession"		=> $this->profession,
				":email"			=> $this->email,
				":phone"			=> $this->phone,
				":clinic_location"	=> $this->clinic_location,
				":picture"			=> $this->picture,
				":street" 			=> $this->street,
				":city"				=> $this->city,
				":country"			=> $this->country,
				":postalcode"		=> $this->postalcode,
				":note"				=> $this->note,
				":password"			=> $this->password,
				":referrer"			=> $this->referrer,
				":referrer_details" => $this->referrer_details
			);


		if ($stmt->execute($patient_arr_values)) {
			$this->pid = $this->conn->lastInsertId();
			return true;
		}
		return false;	

	}
	// update patient
	function  update_patient($pid){

		//santizie
		$this->first_name 				=htmlspecialchars(strip_tags($this->first_name));
		$this->last_name 				=htmlspecialchars(strip_tags($this->last_name));
		$this->gender 					=htmlspecialchars(strip_tags($this->gender));
		$this->date_of_birth 			=htmlspecialchars(strip_tags($this->date_of_birth));
		$this->profession 				=htmlspecialchars(strip_tags($this->profession));
		$this->email 					=htmlspecialchars(strip_tags($this->email));
		$this->phone 					=htmlspecialchars(strip_tags($this->phone));
		$this->clinic_location 			=htmlspecialchars(strip_tags($this->clinic_location));
		$this->picture 					=htmlspecialchars(strip_tags($this->picture));
		$this->street 					=htmlspecialchars(strip_tags($this->street));
		$this->city 					=htmlspecialchars(strip_tags($this->city));
		$this->country 					=htmlspecialchars(strip_tags($this->country));
		$this->postalcode 				=htmlspecialchars(strip_tags($this->postalcode));
		$this->note 					=htmlspecialchars(strip_tags($this->note));
		$this->password 				=htmlspecialchars(strip_tags($this->password));
		$this->referrer 				=htmlspecialchars(strip_tags($this->referrer));
		$this->referrer_details 		=htmlspecialchars(strip_tags($this->referrer_details));

		

		$query = "UPDATE $this->table_name"." SET
					first_name 			= '$this->first_name',
					last_name  			= '$this->last_name',
					gender 				= '$this->gender',
					date_of_birth 		= '$this->date_of_birth',
					profession 			= '$this->profession',
					email 				= '$this->email',
					phone 				= '$this->phone',
					clinic_location 	= '$this->clinic_location',
					picture 			= '$this->picture',
					street 				= '$this->street',
					city 				= '$this->city',
					country 			= '$this->country',
					postalcode 			= '$this->postalcode',
					note 				= '$this->note',
					password 			= '$this->password',
					referrer 			= '$this->referrer',
					referrer_details 	= '$this->referrer_details'
					WHERE pid = '$this->pid'";
	
		//prepare query;
		$stmt  = $this->conn->prepare($query);
		
		if ($stmt->execute()) {
			return true;
		}
		return false;

	}

	//Get single patient Data
	function getSinglePatient($pid){

		$query 	= "SELECT * FROM $this->table_name WHERE pid = '$this->pid'";
		$stmt 	= $this->conn->prepare($query);
		//execute query
		$stmt->execute();
		return $stmt;

	}


}


 ?>