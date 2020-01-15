<?php
switch (Input::POST('action')){
		
	case "add":
		$data = [
		    "d_name"	        => Input::POST("d_name", true, ["uppercase" => true]),
			"d_status"			=> Input::POST("d_status"),
 			"d_date"			=> F::GetDate(),
 			"d_time"			=> F::GetTime(),
 			"d_user"			=> $_SESSION['user_id']
		];
		
		$a = departments::insertInto($data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit":
	
		$data = [
		    "d_name"	        => Input::POST("d_name", true, ["uppercase" => true]),
			"d_status"			=> Input::POST("d_status"),
 			"d_date"			=> F::GetDate(),
 			"d_time"			=> F::GetTime(),
 			"d_user"			=> $_SESSION['user_id']
		];
		
		$a = departments::updateBy(["d_id"=>url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		departments::deleteBy(
		["d_id"=> url::get(3)]	);
	
		
		$_SESSION["SUCCESS"] = "Department information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "settings/departments";
		</script>
		<?php
	break;
	
}
?>