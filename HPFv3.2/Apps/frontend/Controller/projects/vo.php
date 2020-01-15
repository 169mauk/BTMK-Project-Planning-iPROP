<?php

switch(input::post("action")){
	case "add":
		
		$data = [
		    "v_project"	        => url::Get(3),
			//"v_company"			=> Input::POST("v_company"),
			"v_value"			=> Input::POST("v_value"),
			"v_note"			=> Input::POST("v_note"),
			"v_ref"				=> Input::POST("v_ref"),
 			"v_date"			=> F::GetDate(),
 			"v_time"			=> F::GetTime(),
 			"v_user"			=> $_SESSION['user_id']
		];
		
		$a = vo::insertInto($data);
		
		if($a){
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Variation Order",
				"a_description"		=> "A VO has been submitted for review.",
				"a_to"				=> 0,
				"a_seen"			=> 0,
				"a_table"			=> "projects",
				"a_row"				=> url::get(3),
				"a_type"			=> "vo"
			]);
			
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
}