<?php 



class Database{


	private $host 			= "localhost";
	private $db_name 		= "db_medical_management_system";
	private $db_username 	= "root";
	private $password 		= "";
	public  $conn;

	public function dbConnection(){
		$this->conn =null;
		try{
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->db_username, $this->password);
			$this->conn->exec("set names utf8");
		}
		catch(PDOException $e){
			echo "Connection error ".$e->getMessage();
			exit;
		}

		return $this->conn;

	}

}

		



 ?>