<?php
switch (Input::POST('action')){
		
	case "add":
		$data = [
		    "v_project"	        => Input::POST("v_project"),
			//"v_company"			=> Input::POST("v_company"),
			//"v_task"			=> Input::POST("v_task"),
			"v_value"			=> Input::POST("v_value"),
			"v_status"			=> Input::POST("v_status"),
 			"v_date"			=> F::GetDate(),
 			"v_time"			=> F::GetTime(),
 			"v_user"			=> $_SESSION['user_id']
		];
		
		$a = vo::insertInto($data);
		
		if($a){
		    $_SESSION["SUCCESS"] = "VO information has been added.";
		?>
		<script>
			window.location = PORTAL + "vo";
		</script>
		<?php
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit":
		if($_SESSION["role"] > 0){
			$data = [
			    "v_project"	        => Input::POST("v_project"),
				//"v_company"			=> Input::POST("v_company"),
				//"v_task"			=> Input::POST("v_task"),
				"v_value"			=> Input::POST("v_value"),
				"v_status"			=> Input::POST("v_status"),
	 			"v_date"			=> F::GetDate(),
	 			"v_time"			=> F::GetTime(),
	 			"v_approve_by"			=> $_SESSION['user_id']
			];
		}else{
			$data = [
			    "v_project"	        => Input::POST("v_project"),
				"v_company"			=> Input::POST("v_company"),
				"v_task"			=> Input::POST("v_task"),
				"v_value"			=> Input::POST("v_value"),
	 			"v_date"			=> F::GetDate(),
	 			"v_time"			=> F::GetTime(),
	 			"v_user"			=> $_SESSION['user_id']
			];
		}
		
		$a = vo::updateBy(["v_id"=>url::get(2)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		vo::deleteBy(
		["v_id"=> url::get(2)]	);
		
	$_SESSION["SUCCESS"] = "VO information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "vo";
		</script>
		<?php
	break;
	
}
?>