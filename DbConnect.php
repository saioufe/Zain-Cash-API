<?php

		Class DbConnect {
			public $server = 'localhost';
			public $dbName = 'test';
			public $userName = 'root';
			public $pass =''; 

			public function connect(){
				try {
					$con = new PDO('mysql:host='.$this->server.';dbname='.$this->dbName,
						$this->userName,$this->pass);
					$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					return $con;
				} catch (Exception $e) {
					echo "data base error". $e->getMessage();
				}
			}


		}




?>