<?php

switch(Input::post("action")){
	case "add":

		// moved from tasks to milestone table
		// if(!empty(Input::post("title"))){
		// 	$key = F::UniqKey();
		// 	tasks::insertInto([
		// 		"t_date"	=> F::GetDate(),
		// 		"t_time"	=> F::GetTime(),
		// 		"t_title"	=> Input::post("title"),
		// 		"t_content"	=> Input::post("content"),
		// 		"t_status"	=> 0,
		// 		"t_user"	=> $_SESSION["user_id"],
		// 		"t_project"	=> url::Get(3),
		// 		"t_after"	=> Input::post("task"),
		// 		"t_day"		=> Input::post("day"),
		// 		"t_key"		=> $key
		// 	]);
			
		// 	$xt = tasks::GetBy(["t_key" => $key]);
			
		// 	if(count($xt) > 0){
		// 		$xt = $xt[0];
				
		// 		foreach(Input::post("clients") as $xcl){
		// 			task_company::insertInto([
		// 				"t_company"	=> $xcl,
		// 				"t_task"	=> $xt->t_id
		// 			]);
		// 		}
				
		// 		new Alert("success", "Task added successfully.");
		// 	}else{
		// 		new Alert("error", "Fail saving task information.");
		// 	}
		// }else{
		// 	new Alert("error", "Task title cannot be empty.");
		// }

		if(!empty(Input::post("title"))){
			$key = F::UniqKey();
			milestone::insertInto([
				"m_date"	=> F::GetDate(),
				"m_time"	=> F::GetTime(),
				"m_title"	=> Input::post("title"),
				"m_content"	=> Input::post("content"),
				"m_weight"	=> Input::post("weight"),
				"m_status"	=> 0,
				"m_user"	=> $_SESSION["user_id"],
				"m_project"	=> url::Get(3),
				"m_after"	=> Input::post("task"),
				"m_day"		=> Input::post("day"),
				"m_key"		=> $key
			]);
			
			$xt = milestone::GetBy(["m_key" => $key]);
			
			if(count($xt) > 0){
				$xt = $xt[0];
				
				foreach(Input::post("clients") as $xcl){
					task_company::insertInto([
						"t_company"	=> $xcl,
						"t_task"	=> $xt->t_id
					]);
				}
				
				new Alert("success", "Task added successfully.");
			}else{
				new Alert("error", "Fail saving task information.");
			}
		}else{
			new Alert("error", "Task title cannot be empty.");
		}
	break;
	
	case "edit":
	
	break;
	
	case "delete":
		
	break;
}