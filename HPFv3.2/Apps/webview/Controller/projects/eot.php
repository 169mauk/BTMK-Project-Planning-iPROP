<?php

switch(input::post("action")){
	case "add":
		
		$data = [
		    "e_project"	        => url::Get(3),
			"e_company"			=> Input::POST("e_company"),
			//"e_task"			=> Input::POST("e_task"),
			"e_end"				=> Input::POST("e_end"),
			"e_note"			=> Input::POST("e_note"),
			"e_ref"				=> Input::POST("e_ref"),
 			"e_date"			=> F::GetDate(),
 			"e_time"			=> F::GetTime(),
 			"e_user"			=> $_SESSION['user_id']
		];
		
		$a = eot::insertInto($data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
}