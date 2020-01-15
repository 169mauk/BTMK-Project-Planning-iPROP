<?php
switch(Input::POST("action")){	
	case "add":
		$data = [
		    "s_name"	        => Input::POST("name", true, ["uppercase" => true]),
			"s_key"	        	=> url::get(3),
			"s_value"	        => Input::POST("value"),
			"s_description"		=> Input::POST("description"),
 			"s_date"			=> F::GetDate(),
 			"s_time"			=> F::GetTime(),
 			"s_user"			=> $_SESSION['user_id']
		];
		
		$a = settings::insertInto($data);
		
		if($a){
		    new Alert("success", "Raw setting has been added.");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit":
		$data = [
		    "s_name"	        => Input::POST("name", true, ["uppercase" => true]),
			"s_key"	        	=> Input::POST("key"),
			"s_value"	        => Input::POST("value"),
			"s_description"		=> Input::POST("description"),
 			"s_date"			=> F::GetDate(),
 			"s_time"			=> F::GetTime(),
 			"s_user"			=> $_SESSION['user_id']
		];
		
		$a = settings::updateBy(["s_id" => url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		settings::deleteBy(
		["s_id"=> url::get(3)]	);
	
		
		$_SESSION["SUCCESS"] = "Option information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "settings/options/edit_group/<?= Input::post("back") ?>";
		</script>
		<?php
	break;
	
}
?>