<?php
switch (Input::POST('action')){
		
	case "add":
		$data = [
		    "s_name"	=> Input::POST("name")
		];
		
		$a = sectors::insertInto($data);
		
		if($a){
		    new Alert("success", "Sector added successfully.");
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit":
	
		$data = [
		    "s_name"	=> Input::POST("name")
		];
		
		$a = sectors::updateBy(["s_id"=>url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		sectors::deleteBy(
		["s_id"=> url::get(3)]	);
	
		
		$_SESSION["SUCCESS"] = "Sector information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "settings/sectors";
		</script>
		<?php
	break;
	
}
?>