<?php

switch(input::post("action")){
	case "add":
		if(!empty(Input::post("title"))){
			$data = [
				"pm_title"	        => Input::POST("title"),
				"pm_content"		=> Input::POST("content", false),
				"pm_description"	=> Input::POST("description"),
				"pm_date"			=> F::GetDate(),
				"pm_time"			=> F::GetTime(),
				"pm_user"			=> $_SESSION['user_id'],
				"pm_client"			=> Input::post("client"),
				"pm_completeDate"	=> Input::post("completeDate"),
				"pm_complain"		=> Input::post("complain"),
				"pm_status"			=> Input::post("status"),
				"pm_project"		=> url::get(3)
			];
			
			$a = project_maintenance::insertInto($data);
			
			if($a){
				activities::insertInto([
					"a_date"			=> F::GetDate(),
					"a_time"			=> F::GetTime(),
					"a_user"			=> $_SESSION["user_id"],
					"a_title"			=> "Project Maintenance",
					"a_description"		=> "A maintenance log has been added",
					"a_to"				=> 0,
					"a_seen"			=> 0,
					"a_table"			=> "projects",
					"a_row"				=> url::get(3),
					"a_type"			=> "project_maintenance"
				]);
					
				$_SESSION["SUCCESS"] = "Maintenance information has been added.";
				?>
				<script>
					window.location = PORTAL + "projects/all/edit/<?= url::get(3) ?>/Maintenance";
				</script>
				<?php
			}else{
				new Alert("error", "Fail to saved data.");
			}
		}else{
			new Alert("error", "Please insert at least log title.");
		}
	break;
	
	case "edit":
		if(!empty(Input::post("title"))){
			$data = [
				"pm_title"	        => Input::POST("title"),
				"pm_content"		=> Input::POST("content", false),
				"pm_description"	=> Input::POST("description"),
				"pm_date"			=> F::GetDate(),
				"pm_time"			=> F::GetTime(),
				"pm_user"			=> $_SESSION['user_id'],
				"pm_client"			=> Input::post("client"),
				"pm_completeDate"	=> Input::post("completeDate"),
				"pm_complain"		=> Input::post("complain"),
				"pm_status"			=> Input::post("status"),
				"pm_project"		=> url::get(3)
			];
			
			$a = project_maintenance::updateBy(["pm_id" => url::get(6), "pm_project" => url::get(3)], $data);
			
			if($a){
				activities::insertInto([
					"a_date"			=> F::GetDate(),
					"a_time"			=> F::GetTime(),
					"a_user"			=> $_SESSION["user_id"],
					"a_title"			=> "Project Maintenance",
					"a_description"		=> "A maintenance log has been updated",
					"a_to"				=> 0,
					"a_seen"			=> 0,
					"a_table"			=> "projects",
					"a_row"				=> url::get(3),
					"a_type"			=> "project_maintenance"
				]);
				
				new Alert("success", "Data Saved");
			}else{
				new Alert("error", "Fail to saved data.");
			}
		}else{
			new Alert("error", "Please insert at least log title.");
		}
	break;
	
	case "delete":
		$a = project_maintenance::deleteBy(["pm_id" => url::get(6), "pm_project" => url::get(3)]);
			
		if($a){
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Project Maintenance",
				"a_description"		=> "A maintenance log has been deleted",
				"a_to"				=> 0,
				"a_seen"			=> 0,
				"a_table"			=> "projects",
				"a_row"				=> url::get(3),
				"a_type"			=> "project_maintenance"
			]);
			
			$_SESSION["SUCCESS"] = "Maintenance information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "projects/all/edit/<?= url::get(3) ?>/Maintenance";
		</script>
		<?php
		}else{
			new Alert("error", "Fail to saved data.");
		}
	break;
}