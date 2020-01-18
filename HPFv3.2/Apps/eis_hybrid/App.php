<?php
//A journey start with a step
header("Access-Control-Allow-Origin: *");

if(url::get(0) == ACCESS_KEY){
	switch(url::get(1)){
		case "index.html":
		case "dashboard.html":
			Page::Load("index");
		break;
		
		case "sob.html":
			Page::Load("sob");
		break;
		
		case "department.html":
			Page::Load("department");
		break;
		
		case "status.html":
			Page::Load("status");
		break;
		
		case "logout.html":
			Page::Load("logout");
		break;
		
		case "login.html":
			Page::Load("login");
		break;
		
		default:
			Page::Load("404");
		break;
	}
}elseif(url::get(0) == "login"){
	$o = fopen("php://input", "rb");
	$str = stream_get_contents($o);
	fclose($o);
	
	$obj = json_decode($str);
	
	if(isset($obj->username, $obj->password)){
		$u = users::getBy(["user_login" => $obj->username, "user_password" => F::Encrypt($obj->password)]);
		
		if(count($u) < 1){
			$u = users::getBy(["user_login" => $obj->username, "user_password" => ($obj->password)]);
		}
		
		if(count($u)){
			$u = $u[0];
			
			echo json_encode([
				"status"			=> "success",
				"message"		=> "Login successfully.",
				"data"			=> [
					"username"	=> $u->user_login,
					"password"	=> $u->user_password
				]
			]);
		}else{
			echo json_encode([
				"status"			=> "error",
				"message"		=> "User information not found."
			]);
		}
	}else{
		echo json_encode([
			"status"			=> "error",
			"message"		=> "User information not found."
		]);
	}
}else{
	Page::Load("404");
}