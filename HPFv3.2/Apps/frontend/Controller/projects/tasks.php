<?php

switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("title"))){
			$key = F::UniqKey("TASK_");
			
			tasks::insertInto([
				"t_group"		=> url::get(6),
				"t_start"		=> date("d-M-Y", strtotime(Input::post("start"))),
				"t_end"			=> date("d-M-Y", strtotime(Input::post("end"))),
				"t_planStart"	=> date("d-M-Y", strtotime(Input::post("planStart"))),
				"t_planEnd"		=> date("d-M-Y", strtotime(Input::post("planEnd"))),
				"t_color"		=> Input::post("color"),
				"t_subOf"		=> Input::post("subOf"),
				"t_after"		=> Input::post("main"),
				"t_notes"		=> Input::post("note"),
				"t_title"		=> Input::post("title"),
				"t_content"		=> Input::post("content"),
				"t_key"			=> $key,
				"t_date"		=> F::GetDate(),
				"t_time"		=> F::GetTime(),
				"t_user"		=> $_SESSION["user_id"]
			]);
			
			$t = tasks::getBy(["t_key" => $key]);
			
			if(count($t)){
				$t = $t[0];
				
				
				if(!empty(Input::post("users"))){
					foreach(Input::post("users") as $user){
						$u = users::getBy(["user_id" => $user]);
						
						if(count($u)){
							$u = $u[0];
							
							activities::insertInto([
								"a_date"			=> F::GetDate(),
								"a_time"			=> F::GetTime(),
								"a_user"			=> $_SESSION["user_id"],
								"a_title"			=> "Tasks",
								"a_description"		=> "Task has been assigned.",
								"a_to"				=> $u->user_id,
								"a_seen"			=> 0,
								"a_table"			=> "tasks",
								"a_row"				=> $t->t_id,
								"a_type"			=> "tasks"
							]);
							
							task_user::insertInto([
								"tu_task"	=> $t->t_id,
								"tu_user"	=> $u->user_id
							]);
						}
					}
				}
				
				if(!empty(Input::post("clients"))){
					foreach(Input::post("clients") as $client){
						$c = companies::getBy(["c_id" => $client]);
						
						if(count($c)){
							$c = $c[0];
							
							task_user::insertInto([
								"tu_task"		=> $t->t_id,
								"tu_company"	=> $c->c_id
							]);
						}
					}
				}
				
				new Alert("success", "Task Information has been updated.");
			}else{
				new Alert("error", "Error while saving task information.");
			}
		}else{
			new Alert("error", "Task title cannot be empty.");
		}
	break;
	
	case "edit":
		if(!empty(Input::post("_title"))){			
			tasks::updateBy(["t_id" => Input::post("tid"), "t_group" => url::get(6)], [
				"t_group"		=> url::get(6),
				"t_start"		=> date("d-M-Y", strtotime(Input::post("_start"))),
				"t_end"			=> date("d-M-Y", strtotime(Input::post("_end"))),
				"t_planStart"	=> date("d-M-Y", strtotime(Input::post("_planStart"))),
				"t_planEnd"		=> date("d-M-Y", strtotime(Input::post("_planEnd"))),
				"t_color"		=> Input::post("_color"),
				"t_subOf"		=> Input::post("_subOf"),
				"t_after"		=> Input::post("_main"),
				"t_notes"		=> Input::post("_note"),
				"t_title"		=> Input::post("_title"),
				"t_content"		=> Input::post("_content"),
				"t_date"		=> F::GetDate(),
				"t_time"		=> F::GetTime(),
				"t_user"		=> $_SESSION["user_id"],
				"t_percent"		=> Input::post("_percent")
			]);
			
			$t = tasks::getBy(["t_id" => Input::post("tid"), "t_group" => url::get(6)]);
			
			if(count($t)){
				$t = $t[0];
				
				task_user::deleteBy(["tu_task" => $t->t_id]);
				
				if(!empty(Input::post("_users"))){
					foreach(Input::post("_users") as $user){
						$u = users::getBy(["user_id" => $user]);
						
						if(count($u)){
							$u = $u[0];
							
							activities::insertInto([
								"a_date"			=> F::GetDate(),
								"a_time"			=> F::GetTime(),
								"a_user"			=> $_SESSION["user_id"],
								"a_title"			=> "Tasks",
								"a_description"		=> "Task has been assigned.",
								"a_to"				=> $u->user_id,
								"a_seen"			=> 0,
								"a_table"			=> "tasks",
								"a_row"				=> $t->t_id,
								"a_type"			=> "tasks"
							]);
							
							task_user::insertInto([
								"tu_task"	=> $t->t_id,
								"tu_user"	=> $u->user_id
							]);
						}
					}
				}
				
				if(!empty(Input::post("_clients"))){
					foreach(Input::post("_clients") as $client){
						$c = companies::getBy(["c_id" => $client]);
						
						if(count($c)){
							$c = $c[0];
							
							task_user::insertInto([
								"tu_task"		=> $t->t_id,
								"tu_company"	=> $c->c_id
							]);
						}
					}
				}
				
				new Alert("success", "Task Information has been updated.");
			}else{
				new Alert("error", "Error while saving task information.");
			}
			
		}else{
			new Alert("error", "Task title cannot be empty.");
		}
	break;
	
	case "delete":
		
	break;
}