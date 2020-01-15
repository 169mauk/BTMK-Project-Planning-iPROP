<?php
require_once(dirname(__DIR__) . "/Misc/document_access.php");

class Controller{
	public function __construct(){
		if(isset($_POST["__SUBMIT__"])){
			if(Input::post("__SUBMIT__") == $_SESSION["IR"]){
				$this->Execute(Input::post("__ROUTE__"));
				$_SESSION["IR"] = F::UniqKey();
			}else{
				new Alert("error", "Request token has expired, please try again.");
			}
		}else{
			if(isset($_SESSION["SUCCESS"])){
				new Alert("success", $_SESSION["SUCCESS"]);
				
				unset($_SESSION["SUCCESS"]);
			}
			
			if(isset($_SESSION["ERROR"])){
				new Alert("error", $_SESSION["ERROR"]);
				
				unset($_SESSION["ERROR"]);
			}
			
			if(isset($_SESSION["WARNING"])){
				new Alert("warning", $_SESSION["WARNING"]);
				
				unset($_SESSION["WARNING"]);
			}
			
			if(isset($_SESSION["INFO"])){
				new Alert("info", $_SESSION["INFO"]);
				
				unset($_SESSION["INFO"]);
			}
		}
	}
	
	public function Execute($path){
		$path = dirname(__DIR__) . "/Apps/". APP_CODE ."/Controller/" . $path . ".php";
		
		if(file_exists($path)){
			include_once($path);
		}else{
			echo "Form cannot be submit. There's an error at your form input or controller file cannot be read.";
		}
	}
	
	public static function Form($route = '', $setting = []){
	    echo 
	        "<input type='hidden' name='__SUBMIT__' value='" . $_SESSION["IR"] . "' />",
	        "<input type='hidden' name='__ROUTE__' value='" . $route . "' />"
	    ;
	    
	    foreach($setting as $key => $value){
	        echo "<input type='hidden' name='". $key ."' value='" . $value . "' />";
	    }
	}
	
	public static function FormAjax($route = "", $setting = []){
	    $_token = F::Encrypt(F::UniqKey("SUBMIT_FORM"));
	    $token = Token::create($_token, "form");
	    echo 
	        "<input type='hidden' id='api_route' value='" . $route . "' />",
	        "<input type='hidden' name='_token' value='" . $_token . "' />",
	        "<input type='hidden' name='token' value='" . $token . "' />"
	    ;
	    
	    foreach($setting as $key => $value){
	        echo "<input type='hidden' name='". $key ."' value='" . F::Encrypt($_token . $value) . "' />";
	    }
	}
}
?>