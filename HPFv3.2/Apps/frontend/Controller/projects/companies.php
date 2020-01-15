<?php

switch(Input::post("action")){
	case "add":
		foreach($_POST["company"] as $c_id){
			project_company::insertInto([
				"c_date"	=> F::GetDate(),
				"c_time"	=> F::GetTime(),
				"c_company"	=> $c_id,
				"c_project"	=> url::Get(3)
			]);
		}
		
		new Alert("success", "Task added successfully.");
	break;
	
	case "edit":
	
	break;
	
	case "delete":
		
	break;
}