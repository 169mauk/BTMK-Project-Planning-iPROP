<?php
switch (Input::POST('action')){
		
	case "add";
	
		$data = [
		    "e_project"	        => Input::POST("e_project"),
			"e_company"			=> Input::POST("e_company"),
			"e_task"			=> Input::POST("e_task"),
			"e_end"				=> Input::POST("e_end"),
			"e_status"			=> Input::POST("e_status"),
 			"e_date"			=> F::GetDate(),
 			"e_time"			=> F::GetTime(),
 			"e_user"			=> $_SESSION['user_id']
		];
		
		$a = eot::insertInto($data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit";
	
		if(is_numeric(Input::POST("e_status"))){
			$data = [
			    "e_project"	        => Input::POST("e_project"),
				"e_company"			=> Input::POST("e_company"),
				"e_task"			=> Input::POST("e_task"),
				"e_end"				=> Input::POST("e_end"),
				"e_status"			=> Input::POST("e_status"),
	 			"e_date"			=> F::GetDate(),
	 			"e_time"			=> F::GetTime(),
	 			"e_approve_by"		=> $_SESSION['user_id']
			];
		}else{
			$data = [
			    "e_project"	        => Input::POST("e_project"),
				"e_company"			=> Input::POST("e_company"),
				"e_task"			=> Input::POST("e_task"),
				"e_end"				=> Input::POST("e_end"),
	 			"e_date"			=> F::GetDate(),
	 			"e_time"			=> F::GetTime(),
	 			"e_user"			=> $_SESSION['user_id']
			];
		}
		
		$a = eot::updateBy(["e_id"=>url::get(2)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		eot::deleteBy(
		["e_id"=> url::get(2)]	);
	
		new Alert("success", "Deleted");
	break;
	
}
?>