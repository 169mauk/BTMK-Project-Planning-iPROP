<?php

switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("name"))){
			project_tags::insertInto([
				"t_name"			=> Input::post("name"),
				"t_description"		=> Input::post("description"),
				"t_color"			=> Input::post("color"),
				"t_user"			=> $_SESSION["user_id"]
			]);
			
			new Alert("success", "Tag added successfully.");
		}else{
			new Alert("error", "Tag name cannot be empty!");
		}
	break;
	
	case "edit":
		if(!empty(Input::post("name"))){
			project_tags::updateBy(["t_id" => url::get(3)], [
				"t_name"			=> Input::post("name"),
				"t_description"		=> Input::post("description"),
				"t_color"			=> Input::post("color"),
				"t_user"			=> $_SESSION["user_id"]
			]);
			
			new Alert("success", "Tag updated successfully.");
		}else{
			new Alert("error", "Tag name cannot be empty!");
		}
	break;
	
	case "delete":
		project_tags::deleteBy(["t_id" => url::get(3)]);
		
		new Alert("success", "Tag deleted successfully.");
	break;
}