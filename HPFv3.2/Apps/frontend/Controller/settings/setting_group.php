<?php
switch(Input::POST("action")){	
	case "add":
		$data = [
		    "sg_name"	        => Input::POST("name", true, ["uppercase" => true]),
			"sg_code"	        => Input::POST("code"),
			"sg_description"	=> Input::POST("description")
		];
		
		$a = setting_group::insertInto($data);
		
		if($a){
		    new Alert("success", "Group setting has been added.");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit":
		$data = [
		    "sg_name"	        => Input::POST("name", true, ["uppercase" => true]),
			"sg_code"	        => Input::POST("code"),
			"sg_description"	=> Input::POST("description")
		];
		
		$a = setting_group::updateBy(["sg_code" => url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		setting_group::deleteBy(
		["sg_code"=> url::get(3)]	);
	
		
		$_SESSION["SUCCESS"] = "Option information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "settings/options/";
		</script>
		<?php
	break;
	
}
?>