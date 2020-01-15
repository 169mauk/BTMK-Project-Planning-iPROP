<?php

switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("title"))){
			$key = F::UniqKey();
			
			reports::insertInto([
				"r_title"			=> Input::post("title"),
				"r_description"		=> Input::post("description"),
				"r_content"			=> Input::post("content", false),
				"r_date"			=> F::GetDate(),
				"r_time"			=> F::GetTime(),
				"r_user"			=> $_SESSION["user_id"],
				"r_key"				=> $key,
				"r_project"			=> url::get(3),
				"r_claim"			=> Input::post("claim")
			]);
			
			$xr = reports::GetBy(["r_key" => $key]);
			
			if(count($xr) > 0){
				$xr = $xr[0];
				
				for($i = 0; $i < count($_FILES["images"]["name"]); $i++){
					if(!empty($_FILES["images"]["name"][$i])){
						$name = F::UniqKey() . "-" . F::URLSlugEncode($_FILES["images"]["name"][$i]);
						
						if(file_exists($_FILES["images"]["tmp_name"][$i]) && is_uploaded_file($_FILES["images"]["tmp_name"][$i])){
							F::UploadImage(
								$_FILES["images"]["tmp_name"][$i], 
								ASSET . "images/reports/" . $name, 
								pathinfo($_FILES["images"]["name"][$i])["extension"]
							);
							
							report_images::insertInto([
								"ri_report"		=> url::get(3),
								"ri_image"		=> $name
							]);
						}
					}
				}
				
				new Alert("success", "Report added successfully.");
			}else{
				new Alert("error", "Sorry, fail saving report. Please try again.");
			}
		}else{
			new Alert("error", "Report title is required!");
		}
	break;
}