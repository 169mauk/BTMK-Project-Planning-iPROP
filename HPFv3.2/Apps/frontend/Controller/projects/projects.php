<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

switch(input::post("action")){
	case "add":
		if(!empty(Input::post("name"))){
			$key = F::UniqKey();
			$i = projects::insertInto([
				"p_name"				=> Input::post("name", true, ["uppercase" => true]),
				"p_category"			=> Input::post("category"),
				"p_tags"				=> !empty(Input::post("tags")) ? implode(",", Input::post("tags")) : "",
				//"p_clients"			=> count(Input::post("clients")) > 0 ? implode(",", Input::post("clients")) : "",
				"p_date"				=> F::GetDate(),
				"p_time"				=> strtotime(Input::post("start")),
				"p_end"					=> strtotime(Input::post("end")),
				"p_cost"				=> Input::post("cost"),
				"p_user"				=> $_SESSION["user_id"],
				"p_content"				=> Input::post("content", false),
				"p_status"				=> Input::post("status"),
				"p_sob"					=> Input::post("sob"),
				"p_key"					=> $key,
				"p_location"			=> Input::post("location"),
				"p_ref"					=> Input::post("ref"),
				"p_sector"				=> Input::post("sector"),
				"p_year"				=> Input::post("year"),
				"p_outsource"			=> Input::post("outsource"),
				"p_period"				=> Input::post("period"),
				"p_short"				=> Input::post("short", true, ["uppercase" => true]),
				"p_departmentBudget"	=> Input::post("departmentBudget"),
				"p_bid"					=> Input::post("bid"),
				"p_estimateStart"		=> Input::post("estimateStart"),
				"p_estimateEnd"			=> Input::post("estimateEnd"),
				"p_maintenanceStart"	=> Input::post("maintenanceStart"),
				"p_maintenanceEnd"		=> Input::post("maintenanceEnd"),
				"p_offeredCost"			=> Input::post("offeredCost")
			]);
			
			if($i){
				$p = projects::getBy(["p_key" => $key]);
				
				if(count($p) > 0){
					$p = $p[0];
					
					activities::insertInto([
						"a_date"			=> F::GetDate(),
						"a_time"			=> F::GetTime(),
						"a_user"			=> $_SESSION["user_id"],
						"a_title"			=> "Projects",
						"a_description"		=> "Project ". $p->p_name ." has been created",
						"a_to"				=> 0,
						"a_seen"			=> 1,
						"a_table"			=> "",
						"a_row"				=> 0,
						"a_type"			=> "projects"
					]);
					
					if(!empty(Input::post("department"))){
						foreach(Input::post("department") as $department){
							project_department::insertInto([
								"pd_department"	=> $department,
								"pd_project"	=> $p->p_id
							]);
						}
					}
					
					if(!empty(Input::post("clients"))){
						foreach(Input::post("clients") as $client){
							project_company::insertInto([
								"c_company"	=> $client,
								"c_project"	=> $p->p_id,
								"c_date"	=> F::GetDate(),
								"c_time"	=> F::GetTime()
							]);
						}
					}
					
					?>
					<script>
						window.location = PORTAL + "projects/all/edit/<?= $p->p_id ?>";
					</script>
					<?php
					new Alert("success", "Project information has been saved successfully.");
				}else{
					new Alert("error", "Cannot saving project at this time.");
				}
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
				"p_name"		=> Input::post("name", true, ["uppercase" => true]),
				"p_category"	=> Input::post("category"),
				"p_tags"		=> !empty(Input::post("tags")) ? implode(",", Input::post("tags")) : "",
				//"p_clients"		=> count(Input::post("clients")) > 0 ? implode(",", Input::post("clients")) : "",
				"p_date"		=> F::GetDate(),
				"p_time"		=> strtotime(Input::post("start")),
				"p_end"			=> strtotime(Input::post("end")),
				"p_cost"		=> Input::post("cost"),
				"p_user"		=> $_SESSION["user_id"],
				"p_content"		=> Input::post("content", false),
				"p_status"		=> Input::post("status"),
				"p_department"	=> !empty(Input::post("department")) ? implode(",", Input::post("department")) : "",
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
					
					activities::insertInto([
						"a_date"			=> F::GetDate(),
						"a_time"			=> F::GetTime(),
						"a_user"			=> $_SESSION["user_id"],
						"a_title"			=> "Projects",
						"a_description"		=> "Sub project ". $p->p_name ." has been created",
						"a_to"				=> 0,
						"a_seen"			=> 1,
						"a_table"			=> "projects",
						"a_row"				=> $p->p_id,
						"a_type"			=> "projects"
					]);
					
					if(!empty(Input::post("department"))){
						foreach(Input::post("department") as $department){
							project_department::insertInto([
								"pd_department"	=> $department,
								"pd_project"	=> $p->p_id
							]);
						}
					}
					
					if(!empty(Input::post("clients"))){
						foreach(Input::post("clients") as $client){
							project_company::insertInto([
								"c_company"	=> $client,
								"c_project"	=> $p->p_id,
								"c_date"	=> F::GetDate(),
								"c_time"	=> F::GetTime()
							]);
						}
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
				"p_name"				=> Input::post("name", true, ["uppercase" => true]),
				"p_category"			=> Input::post("category"),
				"p_tags"				=> !empty(Input::post("tags")) ? implode(",", Input::post("tags")) : "",
				"p_date"				=> F::GetDate(),
				"p_time"				=> strtotime(Input::post("start")),
				"p_end"					=> strtotime(Input::post("end")),
				"p_cost"				=> Input::post("cost"),
				"p_user"				=> $_SESSION["user_id"],
				"p_content"				=> Input::post("content", false),
				"p_status"				=> Input::post("status"),
				"p_sob"					=> Input::post("sob"),
				"p_location"			=> Input::post("location"),
				"p_ref"					=> Input::post("ref"),
				"p_sector"				=> Input::post("sector"),
				"p_year"				=> Input::post("year"),
				"p_outsource"			=> Input::post("outsource"),
				"p_period"				=> Input::post("period"),
				"p_short"				=> Input::post("short", true, ["uppercase" => true]),
				"p_departmentBudget"	=> Input::post("departmentBudget"),
				"p_bid"					=> Input::post("bid"),
				"p_estimateStart"		=> Input::post("estimateStart"),
				"p_estimateEnd"			=> Input::post("estimateEnd"),
				"p_maintenanceStart"	=> Input::post("maintenanceStart"),
				"p_maintenanceEnd"		=> Input::post("maintenanceEnd"),
				"p_offeredCost"			=> Input::post("offeredCost"),
				"p_kodObjek"			=> Input::post("kodObjek"),
				"p_kodLanjut"			=> Input::post("kodLanjut"),
				"p_kodMaksud"			=> Input::post("kodMaksud"),
				"p_letterDate"			=> Input::post("letterDate"),
				"p_warrantAcceptanceDate"	=> Input::post("warrantAcceptanceDate"),
				"p_warrantNo"			=> Input::post("warrantNo"),
				"p_indentNo"			=> Input::post("indentNo"),
				"p_indentDate"			=> Input::post("indentDate")
			]);
			
			if($i){
				$p = projects::getBy(["p_id" => url::get(3)]);
				
				if(count($p) > 0){
					$p = $p[0];
					
					activities::insertInto([
						"a_date"			=> F::GetDate(),
						"a_time"			=> F::GetTime(),
						"a_user"			=> $_SESSION["user_id"],
						"a_title"			=> "Projects",
						"a_description"		=> "Project ". $p->p_name ." has been editted",
						"a_to"				=> 0,
						"a_seen"			=> 1,
						"a_table"			=> "projects",
						"a_row"				=> $p->p_id,
						"a_type"			=> "projects"
					]);
					
					project_company::deleteBy(["c_project" => url::Get(3)]);
					
					if(!empty(Input::post("clients"))){
						foreach(Input::post("clients") as $client){
							project_company::insertInto([
								"c_company"	=> $client,
								"c_project"	=> $p->p_id,
								"c_date"	=> F::GetDate(),
								"c_time"	=> F::GetTime()
							]);
						}
					}
					
					project_department::deleteBy(["pd_project" => url::Get(3)]);
					
					print_r(Input::post("department"));
					
					if(!empty(Input::post("department"))){
						foreach(Input::post("department") as $department){
							project_department::insertInto([
								"pd_department"	=> $department,
								"pd_project"	=> $p->p_id
							]);
						}
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
			
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Projects",
				"a_description"		=> "Project (". url::get(3) .") has been deleted",
				"a_to"				=> 0,
				"a_seen"			=> 1,
				"a_table"			=> "projects",
				"a_row"				=> 0,
				"a_type"			=> "projects"
			]);
			
			new Alert("success", "Project information has been deleted successfully.");
		}else{
			new  Alert("error", "Fail saving project record.");
		}
	break;
}