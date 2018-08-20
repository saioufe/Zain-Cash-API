<?php

    require_once('constant.php');
    class Rest {

    	public function validateParameter($fieldName, $value,$dataType , $required =true){
            if($required ==true &&empty($value) ==true){
                $this->throwError('False' , $fieldName . " parameter is required .");

            }


            switch ($dataType) {
                case BOOLEAN:
                    if(!is_bool($value)){
                        $this->returnResponse('False' ,'data type is not valid for 
                            '.$fieldName .'should be boolean');
                    }
                    break;
                case INTEGER:
                         if(!is_numeric($value)){
                        $this->returnResponse('False' ,'data type is not valid for '. $fieldName .'should be integer');
                    }
                    break;
                    case STRING:
                        if(!is_string($value)){
                        $this->returnResponse('False' ,'data type is not valid for 
                            '.$fieldName .'should be string');
                    }
                        break;

            }

            return $value;
    	}

    	public function throwError($code, $message){
            header("content-type : application/x-www-form-urlencoded");
            $errorMsg = json_encode((['error' => ['status' =>$code , 'message' =>$message]]));
            echo $errorMsg; exit();
    	}

    	public function returnResponse($code , $data){
            header("content-type:application/json");
            $respones = json_encode(['resonse' => ['status' => $code , 'ErrorMessage' =>$data]]);
            echo $respones ; exit();
    	}        
    	
    }




?>