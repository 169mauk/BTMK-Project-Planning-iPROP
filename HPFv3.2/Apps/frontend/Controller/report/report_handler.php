<?php
switch (input::post('action')){
		
	case "new_report";
		$key = F::UniqKey("REPORT_"); 
	
		$data = [
		    "r_title" 		=> Input::post("report_title", true, ["uppercase" => true]),
		    "r_category" 	=> Input::post("report_category"),
		    "r_project" 	=> Input::post("report_project"),
		    "r_description" => Input::post("report_description"),
			"r_content" 	=> Input::post("report_content", false),
			"r_claim" 		=> Input::post("report_claim"),
			"r_location"	=> Input::post("report_location"),
 			"r_date" 		=> F::GetDate(),
 			"r_time" 		=> F::GetTime(),
 			"r_user"		=> $_SESSION["user_id"],
 			"r_status" 		=> "0",
 			"r_key"			=> $key
		];
		
		$new_report_query = reports::insertInto($data);
		$check = reports::getBy(["r_key" => $key]);
		
		if(count($check) > 0){
			$check = $check[0];

			if($_FILES["file"]["name"][0] != ""){
				for($i = 0 ; $i < count($_FILES["file"]["name"]); $i++){

		   			$fname = F::GetTime() . "-" . F::URLSlugEncode($_FILES["file"]["name"][$i]);
					$temp = $_FILES["file"]["tmp_name"][$i];
				            
					$pt = pathinfo($fname);
				    $ext = $pt["extension"];
					
					$u = move_uploaded_file($_FILES["file"]["tmp_name"][$i], ASSET . "medias/reports/" . $fname);
							
				    //$u = F::UploadImage($temp, ASSET . "medias/reports/" . $fname, $ext, 555, 440);
							
					if($u){
						$data = array(
							"ri_report"		=> $check->r_id,
							"ri_image"		=> $fname
						);
								
						$rp = report_images::insertInto($data);

						if($rp){
							$_SESSION["SUCCESS"] = "Report information has been added.";
							?>
							<script>
								window.location = PORTAL + "reports/all";
							</script>
							<?php
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

	case "edit_report":
		$r = reports::getBy(["r_id" => url::get(3)]);
		
		if(count($r)){
			$r = $r[0];
			
			$data = [
				"r_title" 		=> Input::post("r_title_edit", true, ["uppercase" => true]),
				"r_category" 	=> Input::post("r_category_edit"),
				"r_project" 	=> Input::post("r_project_edit"),
				"r_description" => Input::post("r_description_edit"),
				"r_content" 	=> Input::post("r_content_edit", false),
				"r_claim" 		=> Input::post("r_claim_edit"),
				"r_location" 	=> Input::post("r_location_edit"),
				"r_date" 		=> F::GetDate(),
				"r_time" 		=> F::GetTime(),
				"r_user" 		=> $_SESSION['user_id'],
				"r_verify"		=> $_SESSION['user_id'],
				"r_status"		=> Input::post("status")
			];
			
			reports::updateBy(["r_id" => $r->r_id], $data);
			
			new Alert("success", "report information updated");
			
			if($_FILES["file"]["name"][0] != ""){
				for($i = 0 ; $i < count($_FILES["file"]["name"]); $i++){
					$fname = F::GetTime() . "-" . F::URLSlugEncode($_FILES["file"]["name"][$i]);
					$temp = $_FILES["file"]["tmp_name"][$i];
							
					$pt = pathinfo($fname);
					$ext = $pt["extension"];
					
					$u = move_uploaded_file($_FILES["file"]["tmp_name"][$i], ASSET . "medias/reports/" . $fname);
					//$u = F::UploadImage($temp, ASSET . "medias/reports/" . $fname, $ext, 555, 440);
							
					if($u){	
						$data = array(
							"ri_report"		=> $r->r_id,
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
		}else{
			new Alert("error", "Sorry, no report were found in current request.");
		}
	break;

	case "delete":
		reports::deleteBy([
			"r_id" => url::get(3)
		]
		);
		
		
		$_SESSION["SUCCESS"] = "Report information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "reports/all";
		</script>
		<?php
	break;

	case "approve":
		$data = [
			"r_status"						=> "1",
 			"r_verify"						=> $_SESSION['user_id'],
			"r_invoiceNo"					=> Input::post("invoiceNo"),
			"r_invoiceDate"					=> Input::post("invoiceDate"),
			"r_invoiceAcknowledgeDate"		=> Input::post("invoiceAcknowledgeDate"),
			"r_loNo"						=> Input::post("loNo"),
			"r_voucherNo"					=> Input::post("voucherNo"),
			"r_byDate"						=> F::GetDate()
		];
		
		$new_report_query = reports::updateBy(["r_id" => url::get(3)], $data);

		if($new_report_query){
			new Alert("success", "Report has been updated as Approved.");
		}else{
			new Alert("error", "Sorry, fail updating report.");
		}
	break;

	case "reject":
		$data = [
			"r_status"		=> "2",
 			"r_verify"		=> $_SESSION['user_id'],
			"r_byDate"		=> F::GetDate(),
			"r_rejectNote"	=> Input::post("rejectNote")
		];
		
		$new_report_query = reports::updateBy(["r_id"=>url::get(3)], $data);

		if($new_report_query){
			new Alert("success", "Report has been updated as Rejected");
		}else{
			new Alert("error", "Fail to reject report");
		}
	break;
}

?>