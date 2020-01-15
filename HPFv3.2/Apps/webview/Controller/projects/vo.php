<?php

switch(input::post("action")){
	case "add":
		
		$data = [
		    "v_project"	        => url::Get(3),
			"v_company"			=> Input::POST("v_company"),
			"v_value"			=> Input::POST("v_value"),
			"v_note"			=> Input::POST("v_note"),
			"v_ref"				=> Input::POST("v_ref"),
 			"v_date"			=> F::GetDate(),
 			"v_time"			=> F::GetTime(),
 			"v_user"			=> $_SESSION['user_id']
		];
		
		$a = vo::insertInto($data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
}