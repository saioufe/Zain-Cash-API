<?php
	spl_autoload_register(function($className){
		 $path = strtolower($className).".php";
		if(file_exists($path)){
			require_once($path);
			//echo $path;
		}else {
			echo "file ". $path ." is not found";
		}
	})


?>