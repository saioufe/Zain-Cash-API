<?php
	

	Class registerUser extends rest {



		private $InputName = 'saif';            		   //enter your name HERE !!!! String Only
		private $InputEmail='saioufeyoutube@yahoo.com'; //ente your email HERE !!!! String Only
		private $InputAge = 22 ; 					   //enter your age HERE  !!!! Integer Only


		public $Name;
		public $Email;
		public $Age;

		public $token;  //to store the JWT token

		public $tableName='users'; // the dataBase table name

		public $dbConn;

		public function __construct(){
			$db = new DbConnect;
			$this->dbConn = $db->connect();

			$this->generateToken();
		}



			public function generateToken(){
			$Name = $this->validateParameter('Name' ,$this->InputName,STRING);
			$Email = $this->validateParameter('Email',$this->InputEmail,STRING);
			$Age = $this->validateParameter('Age',$this->InputAge,INTEGER);

			try{
				$paylod =[
					'iat' =>time(),
					'iss' =>'localhost',
					'exp' => time() +(40*60),
					'name' =>$Name,
					'email' =>$Email,
					'age' =>$Age

				];
				$this->token = jwt::encode($paylod,SECRETE_KEY);
			    $this->addUser();
				//$data = ['token' => $token];

				//$this->returnResponse(SUCCESS_RESPONSE , $data);
			}catch (Exception $e){
				$this->throwError(JWT_PROCESSING_ERROR,$e->getMessage());
			}


		}



		public function addUser(){

			try {
				 $paylod = jwt::decode($this->token ,SECRETE_KEY ,['HS256'] );
				// print_r($paylod);
				 
				 $this->Name = $paylod->name;
				 $this->Email= $paylod->email;
				 $this->Age = $paylod->age;

				 $sql = 'INSERT INTO ' . $this->tableName . '(Name, Email, Age) VALUES (:name, :email, :age)';
				 $stmt = $this->dbConn->prepare($sql);

				 $stmt->bindParam(':name',$this->Name);
				 $stmt->bindParam(':email', $this->Email);
				 $stmt->bindParam(':age', $this->Age);

				 try {
				 	$stmt->execute();
				 	$this->returnResponse('True' , $data);
				 } catch (Exception $e) {
				 	$this->returnResponse('False' , $e->getMessage());
				 }


			} catch (Exception $e) {
				$this->throwError(JWT_PROCESSING_ERROR,$e->getMessage());

			}
		}

	}


















?>