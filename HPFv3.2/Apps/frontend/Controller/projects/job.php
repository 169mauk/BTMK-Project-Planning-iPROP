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
			
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Job: " . Input::post("title"),
				"a_description"		=> Input::post("description"),
				"a_to"				=> Input::post("userjob"),
				"a_seen"			=> 0,
				"a_table"			=> "jobs",
				"a_row"				=> 0,
				"a_type"			=> "jobs"
			]);
			
			new Alert("success", "Job added to user.");
		}else{
			new Alert("error", "Please insert at least job title.");
		}
	break;
	
	case "edit":
		if(!empty(Input::post("jtitle"))){
			jobs::updateBy(["j_id" => Input::post("jid")], [
				"j_title"			=> Input::post("jtitle"),
				"j_description"		=> Input::post("jdescription"),
				"j_status"			=> Input::post("jstatus"),
				"j_tags"			=> !empty(Input::post("jtag")) ? implode(",", Input::post("jtag")) : ""
			]);
			
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Job Update: " . Input::post("jtitle"),
				"a_description"		=> Input::post("jdescription"),
				"a_to"				=> Input::post("juser"),
				"a_seen"			=> 0,
				"a_table"			=> "jobs",
				"a_row"				=> 0,
				"a_type"			=> "jobs"
			]);
			
			new Alert("success", "Job saved to user.");
		}else{
			new Alert("error", "Please insert at least job title.");
		}
	break;
	
	case "delete":
		jobs::deleteBy(["j_id" => Input::post("job_id")]);
		
		activities::insertInto([
			"a_date"			=> F::GetDate(),
			"a_time"			=> F::GetTime(),
			"a_user"			=> $_SESSION["user_id"],
			"a_title"			=> "Job Delete",
			"a_description"		=> "A job has been removed from your list",
			"a_to"				=> Input::post("job_user"),
			"a_seen"			=> 0,
			"a_table"			=> "jobs",
			"a_row"				=> 0,
			"a_type"			=> "jobs"
		]);
		
		new Alert("success", "Job deleted");
	break;
}