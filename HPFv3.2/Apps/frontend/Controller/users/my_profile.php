<?php
switch (input::post('action')){
		
	case "update";
	
		if(empty(Input::post("u_password"))){
			$data = [
			    "user_name"	        => Input::post("u_name"),
				"user_login"	    => Input::post("u_login"),
				"user_email"		=> Input::post("u_email"),
				"user_phone"		=> Input::post("u_phone")
			];
		}else{
			$data = [
			    "user_name"	        => Input::post("u_name"),
				"user_login"	    => Input::post("u_login"),
				"user_password"		=> F::Encrypt(Input::post("u_password")),
				"user_email"		=> Input::post("u_email"),
				"user_phone"		=> Input::post("u_phone")
			];
			
		}
		
		
		if(file_exists($_FILES["file"]["tmp_name"])){
                $fname = F::GetTime() . "-" . F::URLSlugEncode($_FILES["file"]["name"]);
                $temp = $_FILES["file"]["tmp_name"];
                
                $pt = pathinfo($fname);
                $ext = $pt["extension"];
                
                $u = F::UploadImage($temp, ASSET . "medias/users/" . $fname, $ext);
    			
    			if($u){
    				$data["user_picture"] = $fname;
    			}	
        }
		
		$a = users::updateBy(["user_id" => $_SESSION['user_id']],$data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
}
?>