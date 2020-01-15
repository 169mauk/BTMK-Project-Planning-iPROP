<?php
switch (input::post('action')){
		
	case "new_category";

		$key=F::UniqKey("reports_category"); 

		$data = [
		    "rc_title" 		=> Input::post("category_title"),
			"rc_projects" 	=> Input::post("category_project"),
 			"rc_date" 		=> F::GetDate(),
 			"rc_time" 		=> F::GetTime(),
 			"rc_users" 		=> $_SESSION['user_id'],
 			"rc_key"		=> $key
		];
		
		$rcq = reports_category::insertInto($data);
		$rcq_check = reports_category::getBy(["rc_key" => $key]);
		if(count($rcq_check) > 0){
			$rcq_check = $rcq_check[0];
			$data_project = ["rc_id" => $rcq_check->rc_id, "rp_projects" => $rcq_check->rc_projects];
			$rpq = report_projects::insertInto($data_project);
		}
		
		if($rcq && $rpq){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;

	case "edit";
		
		$key=F::UniqKey("edit_reports_category");

		$data = [
		    "rc_title"	        => Input::post("edit_rc_title"),
			"rc_projects"		=> Input::post("edit_rc_project"),
 			"rc_date"			=> F::GetDate(),
 			"rc_time"			=> F::GetTime(),
 			"rc_users"			=> $_SESSION['user_id'],
 			"rc_key"			=> $key
		];
		
		$rc_edit = reports_category::updateBy(["rc_id"=>url::get(3)], $data);
		$rc_edit_check = reports_category::getBy(["rc_key" => $key]);
		
		if(count($rc_edit_check) > 0){
			$rc_edit_check = $rc_edit_check[0];
			$data = [
				"rp_projects" => $rc_edit_check->rc_projects
			];
			$rp_edit = report_projects::updateBy(["rc_id"=>$rc_edit_check->rc_id], $data);
		}


		if($rc_edit && $rp_edit){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	

	case "delete":
		reports_category::deleteBy(
			["rc_id"=> url::get(3)]	);
		
		$_SESSION["SUCCESS"] = "Report information has been deleted.";
		echo '<script>window.location = "'.PORTAL.url::get(0)."/".url::get(1).'"</script>';
	break;

	

	default:
	break;
}

?>