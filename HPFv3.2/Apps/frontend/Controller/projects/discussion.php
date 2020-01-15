<?php


switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("title"))){
			discussions::insertInto([
				"d_title"		=> Input::post("title"),
				"d_content"		=> Input::post("content"),
				"d_project"		=> url::get(3),
				"d_date"		=> F::GetDate(),
				"d_time"		=> F::GetTime(),
				"d_user"		=> $_SESSION["user_id"],
				"d_category"	=> Input::post("category")
			]);
			
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Issues & Discussions",
				"a_description"		=> "An Issue/Discussion has been submitted.",
				"a_to"				=> 0,
				"a_seen"			=> 0,
				"a_table"			=> "projects",
				"a_row"				=> url::get(3),
				"a_type"			=> "discussions"
			]);
			
			new Alert("success", "Topic has been created");
		}else{
			new Alert("error", "Please insert at least title.");
		}
	break;
	
	case "add_reply":
		if(!empty(Input::post("content"))){
			discussions::insertInto([
				"d_content"		=> Input::post("content"),
				"d_main"		=> url::get(5),
				"d_date"		=> F::GetDate(),
				"d_time"		=> F::GetTime(),
				"d_user"		=> $_SESSION["user_id"]
			]);
			
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Issues & Discussions",
				"a_description"		=> "Replying on issue.",
				"a_to"				=> 0,
				"a_seen"			=> 0,
				"a_table"			=> "discussions",
				"a_row"				=> url::get(5),
				"a_type"			=> "discussions"
			]);
			
			new Alert("success", "Topic has been created");
		}else{
			new Alert("error", "Please insert at least title.");
		}
	break;
	
	case "closing":
		discussions::updateBy(["d_id" => url::get(5), "d_project" => url::get(3)], [
			"d_status"	=> 1
		]);
		
		activities::insertInto([
			"a_date"			=> F::GetDate(),
			"a_time"			=> F::GetTime(),
			"a_user"			=> $_SESSION["user_id"],
			"a_title"			=> "Issues & Discussions",
			"a_description"		=> "Closing issue.",
			"a_to"				=> 0,
			"a_seen"			=> 0,
			"a_table"			=> "projects",
			"a_row"				=> url::get(3),
			"a_type"			=> "discussions"
		]);
		
		new Alert("success", "Issue has been updated.");
	break;
	
	case "opening":
		discussions::updateBy(["d_id" => url::get(5), "d_project" => url::get(3)], [
			"d_status"	=> 0
		]);
		
		activities::insertInto([
			"a_date"			=> F::GetDate(),
			"a_time"			=> F::GetTime(),
			"a_user"			=> $_SESSION["user_id"],
			"a_title"			=> "Issues & Discussions",
			"a_description"		=> "Reopening issue.",
			"a_to"				=> 0,
			"a_seen"			=> 0,
			"a_table"			=> "projects",
			"a_row"				=> url::get(3),
			"a_type"			=> "discussions"
		]);
		
		new Alert("success", "Issue has been updated.");
	break;
}