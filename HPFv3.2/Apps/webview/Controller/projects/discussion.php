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
				"d_user"		=> $_SESSION["user_id"]
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
				"d_main"		=> url::get(3),
				"d_date"		=> F::GetDate(),
				"d_time"		=> F::GetTime(),
				"d_user"		=> $_SESSION["user_id"]
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
		
		new Alert("success", "Issue has been updated.");
	break;
	
	case "opening":
		discussions::updateBy(["d_id" => url::get(5), "d_project" => url::get(3)], [
			"d_status"	=> 0
		]);
		
		new Alert("success", "Issue has been updated.");
	break;
}