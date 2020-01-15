<?php
switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("title"))){
			$key = F::UniqKey();
			$i = project_application::insertInto([
				//"pa_project "					=> Input::post("content"),
				"pa_cost"						=> Input::post("cost"),
				"pa_notes"						=> Input::post("content"),
				"pa_manager"					=> Input::post("manager"),
				"pa_sob"						=> Input::post("sob"),
				"pa_outsource"					=> Input::post("outsource"),
				"pa_period"						=> Input::post("period"),
				"pa_estimateStart"				=> Input::post("estimateStart"),
				"pa_estimateEnd"				=> Input::post("estimateEnd"),
				"pa_approvalDate"				=> Input::post("approvalDate"),
				"pa_department"					=> Input::post("department"),
				"pa_technicalDate"				=> Input::post("technicalDate"),
				"pa_guideDate"					=> Input::post("guideDate"),
				"pa_kickOffDate"				=> Input::post("kickOffDate"),
				"pa_applicationBudgetDate"		=> Input::post("applicationBudgetDate"),
				"pa_approvalBudgetDate"			=> Input::post("approvalBudgetDate"),
				"pa_procumentDate"				=> Input::post("procumentDate"),
				"pa_procumentNo"				=> Input::post("procumentNo"),
				"pa_status"						=> Input::post("status"),
				"pa_director"					=> Input::post("director"),
				"pa_category"					=> Input::post("category"),
				"pa_maksudCode"					=> Input::post("maksudCode"),
				"pa_objectCode"					=> Input::post("objectCode"),
				"pa_lanjutCode"					=> Input::post("lanjutCode"),
				"pa_date"						=> F::GetDate(),
				"pa_time"						=> F::GetTime(),
				"pa_user"						=> $_SESSION["user_id"],
				"pa_client"						=> Input::post("clients"),
				"pa_title"						=> Input::post("title"),
				"pa_key"						=> $key,
				"pa_type"						=> Input::post("type")
			]);
			
			
			if($i){
				$p = project_application::getBy(["pa_key" => $key]);
				
				if(count($p) > 0){
					$p = $p[0];
					
					?>
					<script>
						window.location = PORTAL + "projects/application/edit/<?= $p->pa_id ?>";
					</script>
					<?php
					new Alert("success", "Project information has been saved successfully.");
				}
			}else{
				new  Alert("error", "Fail saving project record.");
			}
			
		}else{
			new Alert("error", "Project title cannot be empty!");
		}
		
	break;
	
	case "edit":
		
		if(!empty(Input::post("title"))){
			
			$data = [
				"pa_cost"						=> Input::post("cost"),
				"pa_notes"						=> Input::post("content"),
				"pa_manager"					=> Input::post("manager"),
				"pa_sob"						=> Input::post("sob"),
				"pa_outsource"					=> Input::post("outsource"),
				"pa_period"						=> Input::post("period"),
				"pa_estimateStart"				=> Input::post("estimateStart"),
				"pa_estimateEnd"				=> Input::post("estimateEnd"),
				"pa_approvalDate"				=> Input::post("approvalDate"),
				"pa_department"					=> Input::post("department"),
				"pa_technicalDate"				=> Input::post("technicalDate"),
				"pa_guideDate"					=> Input::post("guideDate"),
				"pa_kickOffDate"				=> Input::post("kickOffDate"),
				"pa_applicationBudgetDate"		=> Input::post("applicationBudgetDate"),
				"pa_approvalBudgetDate"			=> Input::post("approvalBudgetDate"),
				"pa_procumentDate"				=> Input::post("procumentDate"),
				"pa_procumentNo"				=> Input::post("procumentNo"),
				"pa_status"						=> Input::post("status"),
				"pa_director"					=> Input::post("director"),
				"pa_category"					=> Input::post("category"),
				"pa_maksudCode"					=> Input::post("maksudCode"),
				"pa_objectCode"					=> Input::post("objectCode"),
				"pa_lanjutCode"					=> Input::post("lanjutCode"),
				"pa_date"						=> F::GetDate(),
				"pa_time"						=> F::GetTime(),
				"pa_user"						=> $_SESSION["user_id"],
				"pa_client"						=> Input::post("clients"),
				"pa_title"						=> Input::post("title"),
				"pa_type"						=> Input::post("type")
			];
			
			$i = project_application::updateBy(["pa_id" => url::get(3)], $data);
			if($i){
				new  Alert("sucess", "Project application successfully updated");
			}else{
				new  Alert("error", "Fail saving project application record.");
			}
			
		}else{
			new Alert("error", "Project title cannot be empty!");
		}
		
	break;
	
	case "delete":
		$i = project_application::deleteBy(["pa_id" => url::get(3)]);
		
		$_SESSION["SUCCESS"] = "Application information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "projects/application";
		</script>
		<?php
	break;
	
	case "create":
		$id = url::get(3);
		if(!$_SESSION["role"]){
			$pa = project_application::getBy(["pa_id" => $id, "pa_department" => $_SESSION["department"]]);
		}else{
			$pa = project_application::getBy(["pa_id" => $id]);
		}
		
		if(count($pa)){
			$pa = $pa[0];
			
			if(!$pa->pa_project){
				$key = F::UniqKey("PROJECT_");
				
				projects::insertInto([
					"p_name"			=> $pa->pa_title,
					"p_category"		=> $pa->pa_category,
					"p_date"			=> F::GetDate(),
					"p_time"			=> F::GetTime(),
					"p_cost"			=> $pa->pa_cost,
					"p_user"			=> $_SESSION["user_id"],
					"p_status"			=> 1,
					"p_key"				=> $key,
					"p_sob"				=> $pa->pa_sob,
					"p_type"			=> $pa->pa_type,
					"p_sector"			=> $pa->pa_sector,
					"p_period"			=> $pa->pa_period,
					"p_year"			=> date("Y"),
					"p_estimateStart"	=> $pa->pa_estimateStart,
					"p_estimateEnd"		=> $pa->pa_estimateEnd,
					"p_kodObjek"		=> $pa->pa_objectCode,
					"p_kodLanjut"		=> $pa->pa_lanjutCode,
					"p_kodMaksud"		=> $pa->pa_maksudCode
				]);
				
				$p = projects::getBy(["p_key" => $key]);
				
				if(count($p)){
					$p = $p[0];
					
					project_application::updateBy(["pa_id" => $pa->pa_id], ["pa_project" => $p->p_id]);
					
					project_department::insertInto([
						"pd_project"	=> $p->p_id,
						"pd_department"	=> $pa->pa_department
					]);
					
					project_company::insertInto([
						"c_project"	=> $p->p_id,
						"c_company"	=> $pa->pa_client,
						"c_date"	=> F::GetDate(),
						"c_time"	=> F::GetTime()
					]);
					
					new Alert("success", "Project has been successfully created.");
				}else{
					new Alert("error", "Sorry, fail creating project. Please contact system developer.");
				}
			}else{
				new Alert("success", "The project has been created before.");
			}
		}else{
			new Alert("error", "Project application not found.");
		}
	break;
}



























