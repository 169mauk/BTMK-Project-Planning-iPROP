<?php

switch(input::post("action")){
	case "add":
		if(!empty(Input::post("name"))){
			$key = F::UniqKey();
			$i = projects::insertInto([
				"p_name"		=> Input::post("name"),
				"p_category"	=> Input::post("category"),
				"p_tags"		=> count(Input::post("tags")) > 0 ? implode(",", Input::post("tags")) : "",
				//"p_clients"		=> count(Input::post("clients")) > 0 ? implode(",", Input::post("clients")) : "",
				"p_date"		=> F::GetDate(),
				"p_time"		=> strtotime(Input::post("start")),
				"p_end"			=> strtotime(Input::post("end")),
				"p_cost"		=> Input::post("cost"),
				"p_user"		=> $_SESSION["user_id"],
				"p_content"		=> Input::post("content"),
				"p_status"		=> Input::post("status"),
				"p_department"	=> count(Input::post("department")) > 0 ? implode(",", Input::post("department")) : "",
				"p_sob"			=> Input::post("sob"),
				"p_key"			=> $key,
				"p_location"	=> Input::post("location"),
				"p_ref"			=> Input::post("ref")
			]);
			
			if($i){
				$p = projects::getBy(["p_key" => $key]);
				
				if(count($p) > 0){
					$p = $p[0];
					
					foreach(Input::post("department") as $department){
						project_department::insertInto([
							"pd_department"	=> $department,
							"pd_project"	=> $p->p_id
						]);
					}
					
					foreach(Input::post("clients") as $client){
						project_company::insertInto([
							"c_company"	=> $client,
							"c_project"	=> $p->p_id,
							"c_date"	=> F::GetDate(),
							"c_time"	=> F::GetTime()
						]);
					}
					
					
				}
				
				new Alert("success", "Project information has been saved successfully.");
			}else{
				new  Alert("error", "Fail saving project record.");
			}
			
			$data_act = [
				"a_title"		=> Input::post("name"),
				"a_user"		=> $_SESSION["user_id"],
				"a_description"	=> "Add new Project",
				"a_date"		=> F::GetDate(),
				"a_time"		=> F::GetTime()
			];
			
			activities::insertInto($data_act);
			
		}else{
			new Alert("error", "Project title cannot be empty!");
		}
	break;
	
	case "add_sub":
		if(!empty(Input::post("name"))){
			$key = F::UniqKey();
			$i = projects::insertInto([
				"p_name"		=> Input::post("name"),
				"p_category"	=> Input::post("category"),
				"p_tags"		=> count(Input::post("tags")) > 0 ? implode(",", Input::post("tags")) : "",
				//"p_clients"		=> count(Input::post("clients")) > 0 ? implode(",", Input::post("clients")) : "",
				"p_date"		=> F::GetDate(),
				"p_time"		=> strtotime(Input::post("start")),
				"p_end"			=> strtotime(Input::post("end")),
				"p_cost"		=> Input::post("cost"),
				"p_user"		=> $_SESSION["user_id"],
				"p_content"		=> Input::post("content"),
				"p_status"		=> Input::post("status"),
				"p_department"	=> count(Input::post("department")) > 0 ? implode(",", Input::post("department")) : "",
				"p_sob"			=> Input::post("sob"),
				"p_key"			=> $key,
				"p_location"	=> Input::post("location"),
				"p_ref"			=> Input::post("ref"),
				"p_main"		=> url::get(3)
			]);
			
			if($i){
				$p = projects::getBy(["p_key" => $key]);
				
				if(count($p) > 0){
					$p = $p[0];
					
					foreach(Input::post("department") as $department){
						project_department::insertInto([
							"pd_department"	=> $department,
							"pd_project"	=> $p->p_id
						]);
					}
					
					foreach(Input::post("clients") as $client){
						project_company::insertInto([
							"c_company"	=> $client,
							"c_project"	=> $p->p_id,
							"c_date"	=> F::GetDate(),
							"c_time"	=> F::GetTime()
						]);
					}
					
					
				}
				
				new Alert("success", "Project information has been saved successfully.");
			}else{
				new  Alert("error", "Fail saving project record.");
			}
			
			$data_act = [
				"a_title"		=> Input::post("name"),
				"a_user"		=> $_SESSION["user_id"],
				"a_description"	=> "Add new Project",
				"a_date"		=> F::GetDate(),
				"a_time"		=> F::GetTime()
			];
			
			activities::insertInto($data_act);
			
		}else{
			new Alert("error", "Project title cannot be empty!");
		}
	break;
	
	case "edit":
		if(!empty(Input::post("name"))){
			$i = projects::updateBy(["p_id" => url::get(3)], [
				"p_name"		=> Input::post("name"),
				"p_category"	=> Input::post("category"),
				"p_tags"		=> count(Input::post("tags")) > 0 ? implode(",", Input::post("tags")) : "",
				"p_date"		=> F::GetDate(),
				"p_time"		=> strtotime(Input::post("start")),
				"p_end"			=> strtotime(Input::post("end")),
				"p_cost"		=> Input::post("cost"),
				"p_user"		=> $_SESSION["user_id"],
				"p_content"		=> Input::post("content"),
				"p_status"		=> Input::post("status"),
				"p_department"	=> count(Input::post("department")) > 0 ? implode(",", Input::post("department")) : "",
				"p_sob"			=> Input::post("sob"),
				"p_location"	=> Input::post("location"),
				"p_ref"			=> Input::post("ref")
			]);
			
			if($i){
				$p = projects::getBy(["p_id" => url::get(3)]);
				
				if(count($p) > 0){
					$p = $p[0];
					
					project_company::deleteBy(["c_project" => url::Get(3)]);
					
					foreach(Input::post("clients") as $client){
						project_company::insertInto([
							"c_company"	=> $client,
							"c_project"	=> $p->p_id,
							"c_date"	=> F::GetDate(),
							"c_time"	=> F::GetTime()
						]);
					}
					
					project_department::deleteBy(["pd_project" => url::Get(3)]);
					
					foreach(Input::post("department") as $department){
						project_department::insertInto([
							"pd_department"	=> $department,
							"pd_project"	=> $p->p_id
						]);
					}
				}
				
				new Alert("success", "Project information has been saved successfully.");
			}else{
				new  Alert("error", "Fail saving project record.");
			}
		}else{
			new Alert("error", "Project title cannot be empty!");
		}
	break;
	
	case "delete":
		$i = projects::deleteBy(["p_id" => url::get(3)]);
		
		if($i){
			projects::getBy(["p_id" => url::get(3)]);
			project_company::deleteBy(["c_project" => url::Get(3)]);
			project_department::deleteBy(["pd_project" => url::Get(3)]);
				
			
			new Alert("success", "Project information has been deleted successfully.");
		}else{
			new  Alert("error", "Fail saving project record.");
		}
	break;
}