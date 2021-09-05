<?php 

class User{

	//database connection and table name
	private $conn;
	private $table_name = "users";

	//object properties
	public $id;
	public $oauth_provider;
	public $oauth_uid;
	public $first_name;
	public $last_name;
	public $username;
	public $email;
	public $password;
	public $gender;
	public $phone;
	public $locale;
	public $picture;
	public $type;
	public $status;
	public $created;
	public $modified;

	//constructor with $db as database connetion
	public function __construct($db){
		 $this->conn = $db;
	}

	//signup user
	function signup(){


		if ($this->isAlreadyExist()) {
			return false;
		}

		$query = "INSERT into $this->table_name(oauth_provider,oauth_uid,first_name,last_name,username,password,gender,phone,locale,picture,type,status,created,modified)";
		$query .="VALUES(:oauth_provider, :oauth_uid, :first_name, :last_name, :username, :password, :gender, :phone, :locale, :picture, :type, :status, :created, :modified )";


		//prepare query;
		$stmt  = $this->conn->prepare($query);



		//sanitize
		$this->oauth_provider			=htmlspecialchars(strip_tags($this->oauth_provider));
		$this->oauth_uid				=htmlspecialchars(strip_tags($this->oauth_uid));
		$this->firs_tname				=htmlspecialchars(strip_tags($this->first_name));
		$this->last_name 				=htmlspecialchars(strip_tags($this->last_name));
		$this->username 				=htmlspecialchars(strip_tags($this->username));
		$this->email 					=htmlspecialchars(strip_tags($this->email));
		$this->password 				=htmlspecialchars(strip_tags($this->password));
		$this->gender 					=htmlspecialchars(strip_tags($this->gender));
		$this->phone 					=htmlspecialchars(strip_tags($this->phone));
		$this->locale 					=htmlspecialchars(strip_tags($this->locale));
		$this->picture 					=htmlspecialchars(strip_tags($this->picture));
		$this->type 					=htmlspecialchars(strip_tags($this->type));
		$this->status 					=htmlspecialchars(strip_tags($this->status));
		$this->created 					=htmlspecialchars(strip_tags($this->created));
		$this->modified 				=htmlspecialchars(strip_tags($this->modified));

		$arr_values=array(
				":oauth_provider" 	=> $this->oauth_provider,
				":oauth_uid"		=> $this->oauth_uid,
				":first_name"		=> $this->first_name,
				":last_name"		=> $this->last_name,
				":username"			=> $this->username,
				":password"			=> $this->password,
				":gender"			=> $this->gender,
				":phone"			=> $this->phone,
				":locale"			=> $this->locale,
				":picture"			=> $this->picture,
				":type"				=> $this->type,
				":status"			=> $this->status,
				":created"			=> $this->created,
				":modified"			=> $this->modified	

			);

		//execute query
		if ($stmt->execute($arr_values)) {
			$this->id = $this->conn->lastInsertId();
			return true;
		}
		return false;
	}
	



	function isAlreadyExist(){
		
		$query 	= "SELECT * FROM ".$this->table_name." WHERE username ='".$this->username."'";
		$stmt 	= $this->conn->prepare($query);
		
		//execute query
		$stmt->execute();
		
		if($stmt->rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	}

	function login(){
		//select all Query
		$query = "SELECT `id`,`username`,`password`,`created` FROM ".$this->table_name." WHERE username ='".$this->username."'AND password = '".$this->password."'";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}


	


}




 ?>