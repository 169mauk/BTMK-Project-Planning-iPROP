<?php
switch (input::post('action')){
		
	case "new_report";
		$key=F::UniqKey("REPORT_"); 
	
		$data = [
		    "r_title" 		=> Input::post("report_title"),
		    "r_category" 	=> Input::post("report_category"),
		    "r_project" 	=> Input::post("report_project"),
		    "r_description" => Input::post("report_description"),
			"r_content" 	=> Input::post("report_content"),
			"r_claim" 		=> Input::post("report_claim"),
			"r_location"	=> Input::post("report_location"),
 			"r_date" 		=> F::GetDate(),
 			"r_time" 		=> F::GetTime(),
 			"r_user"		=> $_SESSION["user_id"],
 			"r_status" 		=> "0",
 			"r_key"			=> $key
		];
		
		$new_report_query = reports::insertInto($data);
		
		
		$data_act = [
			"a_title"		=> Input::post("report_title"),
			"a_user"		=> $_SESSION["user_id"],
			"a_description"	=> "Add new Report",
			"a_date"		=> F::GetDate(),
			"a_time"		=> F::GetTime()
		];
		
		activities::insertInto($data_act);
		
		$check = reports::getBy(["r_key" => $key]);
		
		if(count($check) > 0){
			$check = $check[0];

			if($_FILES["file"]["name"][0] != ""){
				for($i = 0 ; $i < count($_FILES["file"]["name"]); $i++){

		   			$fname = F::GetTime() . "-" . F::URLSlugEncode($_FILES["file"]["name"][$i]);
					$temp = $_FILES["file"]["tmp_name"][$i];
				            
					$pt = pathinfo($fname);
				    $ext = $pt["extension"];
							
				    $u = F::UploadImage($temp, ASSET . "medias/reports/" . $fname, $ext, 555, 440);
							
					if($u){
							    
						$data = array(
							"ri_report"		=> $check->r_id,
							"ri_image"		=> $fname
						);
								
						$rp = report_images::insertInto($data);

						if($rp){
							new Alert("success","Data saved");
						}else{
							new Alert("error","Image not saved");
						}
								
					}else{
						new Alert("Error", "Image is not saved");
					}
				}
			}
		}
	break;

	case "edit_report";
		$key=F::UniqKey("REPORT_"); 
	
		$data = [
		    "r_title" 		=> Input::post("r_title_edit"),
		    "r_category" 	=> Input::post("r_category_edit"),
		    "r_project" 	=> Input::post("r_project_edit"),
		    "r_description" => Input::post("r_description_edit"),
			"r_content" 	=> Input::post("r_content_edit"),
			"r_claim" 		=> Input::post("r_claim_edit"),
			"r_location" 	=> Input::post("r_location_edit"),
 			"r_date" 		=> F::GetDate(),
 			"r_time" 		=> F::GetTime(),
 			"r_user" 		=> $_SESSION['user_id'],
 			"r_verify"		=> $_SESSION['user_id'],
 			"r_key"			=> $key
		];
		
		$new_report_query = reports::updateBy(["r_id"=>url::get(3)], $data);

		if($new_report_query){
			new Alert("success", "report information updated");
		}else{
			new Alert("error", "fail to update report information");
		}
		
		$edited_report = reports::getBy(["r_key" => $key]);
		
		if(count($edited_report) > 0){
			$edited_report = $edited_report[0];

			if($_FILES["file"]["name"][0] != ""){
				// if new image is added, remove the previous image
				$delete = report_images::deleteBy(["ri_report" => url::get(3)]);
				for($i = 0 ; $i < count($_FILES["file"]["name"]); $i++){

		   			$fname = F::GetTime() . "-" . F::URLSlugEncode($_FILES["file"]["name"][$i]);
					$temp = $_FILES["file"]["tmp_name"][$i];
				            
					$pt = pathinfo($fname);
				    $ext = $pt["extension"];
							
				    $u = F::UploadImage($temp, ASSET . "medias/reports/" . $fname, $ext, 555, 440);
							
					if($u){
							    
						$data = array(
							"ri_report"		=> url::get(3),
							"ri_image"		=> $fname
						);
								
						$rp = report_images::insertInto($data);

						if($rp){
							new Alert("success","Data saved");
						}else{
							new Alert("error","Image not saved");
						}
								
					}else{
						new Alert("Error", "Image is not saved");
					}
				}
			}else{
				break;
			}
		}
	break;

	case "delete":
		reports::deleteBy(
			["r_id"=> url::get(3)]	);
		
		new Alert("success", "Deleted");
		echo '<script>window.location = "'.PORTAL.url::get(0)."/".url::get(1).'"</script>';
	break;

	case "approve":
	
		$data = [
			"r_status"		=> "1",
 			"r_verify"		=> $_SESSION['user_id']

		];
		
		$new_report_query = reports::updateBy(["r_id"=>url::get(3)], $data);

		if($new_report_query){
			new Alert("success", "report approved");
		}else{
			new Alert("error", "fail to approve report");
		}
		
		new Alert("success", "Deleted");
		echo '<script>window.location = "'.PORTAL.url::get(0)."/".url::get(1).'"</script>';
	break;

	case "reject":
		$data = [
			"r_status"		=> "2",
 			"r_verify"		=> $_SESSION['user_id']

		];
		
		$new_report_query = reports::updateBy(["r_id"=>url::get(3)], $data);

		if($new_report_query){
			new Alert("success", "report rejected");
		}else{
			new Alert("error", "fail to reject report");
		}
		
		new Alert("success", "Deleted");
		echo '<script>window.location = "'.PORTAL.url::get(0)."/".url::get(1).'"</script>';
	break;

	default:
	break;
}

?>