<?php


switch(Input::post("action")){
	case "add":
		project_user::insertInto([
			"pu_user"		=> Input::post("user"),
			"pu_project"	=> url::get(3)
		]);
		
		activities::insertInto([
			"a_date"			=> F::GetDate(),
			"a_time"			=> F::GetTime(),
			"a_user"			=> $_SESSION["user_id"],
			"a_title"			=> "Project Team",
			"a_description"		=> "You are assigned to a project.",
			"a_to"				=> Input::post("user"),
			"a_seen"			=> 0,
			"a_table"			=> "project_user",
			"a_row"				=> url::get(3),
			"a_type"			=> "project_user"
		]);
	break;
	
	case "delete":
		project_user::deleteBy([
			"pu_project"	=> url::get(3),
			"pu_user"		=> Input::post("duser_id")
		]);
		
		activities::insertInto([
			"a_date"			=> F::GetDate(),
			"a_time"			=> F::GetTime(),
			"a_user"			=> $_SESSION["user_id"],
			"a_title"			=> "Project Team Removeds",
			"a_description"		=> "You are removed from a project.",
			"a_to"				=> Input::post("duser_id"),
			"a_seen"			=> 0,
			"a_table"			=> "project_user",
			"a_row"				=> url::get(3),
			"a_type"			=> "project_user"
		]);
		
		if(Input::post("migrate") > 0){
			jobs::updateBy([
				"j_project" 	=> url::get(3),
				"j_user"		=> Input::post("duser_id")
			],[
				"j_user"		=> Input::post("migrate")
			]);
			
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Job Migrated",
				"a_description"		=> "Some jobs has been assigned to you.",
				"a_to"				=> Input::post("migrate"),
				"a_seen"			=> 0,
				"a_table"			=> "project_user",
				"a_row"				=> url::get(3),
				"a_type"			=> "project_user"
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