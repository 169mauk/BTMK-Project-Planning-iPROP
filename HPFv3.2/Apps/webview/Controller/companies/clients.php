<?php
switch (input::post('action')){
		
	case "add";
		$data = [
		    "cl_name"	        => Input::post("cl_name"),
			"cl_email"	        => Input::post("cl_email"),
			"cl_phone"			=> Input::post("cl_phone"),
			"cl_title"			=> Input::post("cl_title"),
			"cl_password"		=> F::Encrypt(Input::post("cl_password")),
			"cl_company"		=> Input::post("cl_company"),
			"cl_address"		=> Input::post("c_address"),
 			"cl_date"			=> F::GetDate(),
 			"cl_time"			=> F::GetTime(),
 			"cl_user"			=> $_SESSION['user_id']
		];
		
		
		
		$a = clients::insertInto($data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit";
	
		$data = [
		    "cl_name"	        => Input::post("cl_name"),
			"cl_email"	        => Input::post("cl_email"),
			"cl_phone"			=> Input::post("cl_phone"),
			"cl_title"			=> Input::post("cl_title"),
			"cl_password"		=> F::Encrypt(Input::post("cl_password")),
			"cl_company"		=> Input::post("cl_company"),
			"cl_address"		=> Input::post("c_address"),
 			"cl_date"			=> F::GetDate(),
 			"cl_time"			=> F::GetTime(),
 			"cl_user"			=> $_SESSION['user_id']
		];
		
		
		
		$a = clients::updateBy(["cl_id"=>url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}													
	break;	
	
	case "delete":
		clients::deleteBy(
		["cl_id"=> url::get(3)]	);
	
		new Alert("success", "Deleted");
	break;
	
}
?>