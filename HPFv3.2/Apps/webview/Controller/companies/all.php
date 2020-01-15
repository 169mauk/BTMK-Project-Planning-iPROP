<?php
switch (input::post('action')){
		
	case "add";
		$data = [
		    "c_name"	        => Input::post("c_name"),
			"c_email"	        => Input::post("c_email"),
			"c_phone"			=> Input::post("c_phone"),
			"c_regno"			=> Input::post("c_regno"),
			"c_category"		=> Input::post("c_category"),
			"c_address"			=> Input::post("c_address"),
 			"c_date"			=> F::GetDate(),
 			"c_time"			=> F::GetTime(),
 			"c_user"			=> $_SESSION['user_id']
		];
		
		
		
		if(file_exists($_FILES["file"]["tmp_name"])){
                $fname = F::GetTime() . "-" . F::URLSlugEncode($_FILES["file"]["name"]);
                $temp = $_FILES["file"]["tmp_name"];
                
                $pt = pathinfo($fname);
                $ext = $pt["extension"];
                
                $u = F::UploadImage($temp, ASSET . "medias/companies/" . $fname, $ext);
    			
    			if($u){
    				$data["c_logo"] = $fname;
    			}	
        }
		
		$a = companies::insertInto($data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit";
	
		$data = [
		    "c_name"	        => Input::post("c_name"),
			"c_email"	        => Input::post("c_email"),
			"c_phone"			=> Input::post("c_phone"),
			"c_regno"			=> Input::post("c_regno"),
			"c_category"		=> Input::post("c_category"),
			"c_address"			=> Input::post("c_address"),
 			"c_date"			=> F::GetDate(),
 			"c_time"			=> F::GetTime(),
 			"c_user"			=> $_SESSION['user_id']
		];
		
		
		
		if(file_exists($_FILES["file"]["tmp_name"])){
                $fname = F::GetTime() . "-" . F::URLSlugEncode($_FILES["file"]["name"]);
                $temp = $_FILES["file"]["tmp_name"];
                
                $pt = pathinfo($fname);
                $ext = $pt["extension"];
                
                $u = F::UploadImage($temp, ASSET . "medias/companies/" . $fname, $ext);
    			
    			if($u){
    				$data["c_logo"] = $fname;
    			}	
        }
		
		$a = companies::updateBy(["c_id"=>url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}													
	break;	
	
	case "delete":
		companies::deleteBy(
		["c_id"=> url::get(3)]	);
	
		new Alert("success", "Deleted");
	break;
	
}
?>