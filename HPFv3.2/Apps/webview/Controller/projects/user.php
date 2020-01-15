<?php


switch(Input::post("action")){
	case "add":
		project_user::insertInto([
			"pu_user"		=> Input::post("user"),
			"pu_project"	=> url::get(3)
		]);
	break;
	
	case "delete":
		project_user::deleteBy([
			"pu_project"	=> url::get(3),
			"pu_user"		=> Input::post("duser_id")
		]);
		
		if(Input::post("migrate") > 0){
			jobs::updateBy([
				"j_project" 	=> url::get(3),
				"j_user"		=> Input::post("duser_id")
			],[
				"j_user"		=> Input::post("migrate")
			]);
		}else{
			jobs::deleteBy([
				"j_project" 	=> url::get(3),
				"j_user"		=> Input::post("duser_id")
			]);
		}
		
		new Alert("success", "User deleted successfully.");
	break;
}