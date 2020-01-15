<?php
switch (Input::POST('action')){
		
	case "add";
	
		$data = [
		    "e_project"	        => Input::POST("e_project"),
			//"e_company"			=> Input::POST("e_company"),
			//"e_task"			=> Input::POST("e_task"),
			"e_end"				=> Input::POST("e_end"),
			"e_status"			=> Input::POST("e_status"),
 			"e_date"			=> F::GetDate(),
 			"e_time"			=> F::GetTime(),
 			"e_user"			=> $_SESSION['user_id']
		];
		
		$a = eot::insertInto($data);
		
		if($a){
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Extension of Time",
				"a_description"		=> "An EOT record has been added",
				"a_to"				=> 0,
				"a_seen"			=> 1,
				"a_table"			=> "projects",
				"a_row"				=> Input::POST("e_project"),
				"a_type"			=> "eot"
			]);
		
		$_SESSION["SUCCESS"] = "EOT information has been added.";
		?>
		<script>
			window.location = PORTAL + "eot";
		</script>
		<?php
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit";
	
		if($_SESSION["role"] > 0){
			$data = [
			    "e_project"	        => Input::POST("e_project"),
				//"e_company"			=> Input::POST("e_company"),
				//"e_task"			=> Input::POST("e_task"),
				"e_end"				=> Input::POST("e_end"),
				"e_status"			=> Input::POST("e_status"),
	 			"e_date"			=> F::GetDate(),
	 			"e_time"			=> F::GetTime(),
	 			"e_approve_by"		=> $_SESSION['user_id']
			];
		}else{
			$data = [
			    "e_project"	        => Input::POST("e_project"),
				//"e_company"			=> Input::POST("e_company"),
				//"e_task"			=> Input::POST("e_task"),
				"e_end"				=> Input::POST("e_end"),
	 			"e_date"			=> F::GetDate(),
	 			"e_time"			=> F::GetTime(),
	 			"e_user"			=> $_SESSION['user_id']
			];
		}
		
		$a = eot::updateBy(["e_id"=>url::get(2)], $data);
		
		if($a){
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Extension of Time",
				"a_description"		=> "An EOT(". url::get(2) .") record has been editted",
				"a_to"				=> 0,
				"a_seen"			=> 1,
				"a_table"			=> "projects",
				"a_row"				=> Input::POST("e_project"),
				"a_type"			=> "eot"
			]);
			
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		eot::deleteBy(
		["e_id"=> url::get(2)]);
		
		activities::insertInto([
			"a_date"			=> F::GetDate(),
			"a_time"			=> F::GetTime(),
			"a_user"			=> $_SESSION["user_id"],
			"a_title"			=> "Extension of Time",
			"a_description"		=> "An EOT(". url::get(2) .") record has been deleted",
			"a_to"				=> 0,
			"a_seen"			=> 1,
			"a_table"			=> "projects",
			"a_row"				=> Input::POST("e_project"),
			"a_type"			=> "eot"
		]);
		
		$_SESSION["SUCCESS"] = "EOT information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "eot";
		</script>
		<?php
	break;
	
}
?>