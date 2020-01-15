<?php
switch (Input::POST('action')){
		
	case "add";
		$data = [
		    "cc_name"	        => Input::POST("cc_name"),
			"cc_description"	=> Input::POST("cc_description"),
 			"cc_date"			=> F::GetDate(),
 			"cc_time"			=> F::GetTime(),
 			"cc_user"			=> $_SESSION['user_id']
		];
		
		$a = company_category::insertInto($data);
		
		if($a){
		    $_SESSION["SUCCESS"] = "Category information has been added.";
			?>
			<script>
				window.location = PORTAL + "settings/company-setting";
			</script>
			<?php
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit";
	
		$data = [
		    "cc_name"	        => Input::post("cc_name"),
			"cc_description"	=> Input::post("cc_description"),
 			"cc_date"			=> F::GetDate(),
 			"cc_time"			=> F::GetTime(),
 			"cc_user"			=> $_SESSION['user_id']
		];
		
		$a = company_category::updateBy(["cc_id"=>url::get(3)], $data);
		
		if($a){
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}												
	break;	
	
	case "delete":
		company_category::deleteBy(
		["cc_id"=> url::get(3)]	);
	
		$_SESSION["SUCCESS"] = "Category information has been deleted.";
	?>
	<script>
		window.location = PORTAL + "settings/company-setting";
	</script>
	<?php
	break;
	
}
?>