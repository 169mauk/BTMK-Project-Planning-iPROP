<?php

switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("title"))){
			jobs::insertInto([
				"j_title"			=> Input::post("title"),
				"j_description"		=> Input::post("description"),
				"j_date"			=> F::GetDate(),
				"j_time"			=> F::GetTime(),
				"j_user"			=> Input::post("userjob"),
				"j_project"			=> url::get(3),
				"j_by"				=> $_SESSION["user_id"]
			]);
			
			new Alert("success", "Job added to user.");
		}else{
			new Alert("error", "Please insert at least job title.");
		}
	break;
	
	case "edit":
		jobs::updateBy(["j_id" => Input::post("jid")], [
			"j_status"			=> Input::post("jstatus"),
			"j_tags"			=> !empty(Input::post("jtag")) ? implode(",", Input::post("jtag")) : ""
		]);
		
		new Alert("success", "Job saved to user.");
	break;
	
	case "delete":
		jobs::deleteBy(["j_id" => Input::post("job_id")]);
		
		new Alert("success", "Job deleted");
	break;
}