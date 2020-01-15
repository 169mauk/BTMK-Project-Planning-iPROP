<?php
switch (Input::POST('action')){
		
	case "add":
		$data = [
		    "s_name"	        => Input::POST("s_name"),
		    "s_amount"			=> Input::POST("s_amount"),
			"s_description"		=> Input::POST("s_description"),
 			"s_date"			=> F::GetDate(),
 			"s_time"			=> F::GetTime(),
 			"s_user"			=> $_SESSION['user_id']
		];
		
		$a = sob::insertInto($data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit":
	
		$data = [
		    "s_name"	        => Input::POST("s_name"),
		    "s_amount"			=> Input::POST("s_amount"),
			"s_description"		=> Input::POST("s_description"),
 			"s_date"			=> F::GetDate(),
 			"s_time"			=> F::GetTime(),
 			"s_user"			=> $_SESSION['user_id']
		];
		
		$a = sob::updateBy(["s_id"=>url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		sob::deleteBy(
		["s_id"=> url::get(3)]	);
	
		
		$_SESSION["SUCCESS"] = "SOB information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "settings/sob";
		</script>
		<?php
	break;
	
}
?>