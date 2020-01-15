<?php

switch(input::post("action")){
	case "add":
		
		$data = [
		    "e_project"	        => url::Get(3),
			//"e_company"			=> Input::POST("e_company"),
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
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Extension of Time",
				"a_description"		=> "An EOT has been submitted for review.",
				"a_to"				=> 0,
				"a_seen"			=> 0,
				"a_table"			=> "projects",
				"a_row"				=> url::get(3),
				"a_type"			=> "eot"
			]);
				
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
}