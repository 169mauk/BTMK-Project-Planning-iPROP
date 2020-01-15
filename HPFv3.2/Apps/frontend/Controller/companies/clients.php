<?php
switch (input::post('action')){
		
	case "add":
		$data = [
		    "cl_name"	        => Input::post("cl_name"),
			"cl_email"	        => Input::post("cl_email"),
			"cl_phone"			=> Input::post("cl_phone"),
			"cl_title"			=> Input::post("cl_title"),
			"cl_password"		=> F::Encrypt(Input::post("cl_password")),
			"cl_company"		=> Input::post("cl_company"),
			"cl_address"		=> Input::post("c_address"),
 			"cl_date"			=> F::GetDate(),
 			"cl_time"			=> F::GetTime(),
 			"cl_user"			=> $_SESSION['user_id']
		];
		
		$a = clients::insertInto($data);
		
		if($a){
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Client Registration",
				"a_description"		=> "Client " . Input::post("cl_name") . " added.",
				"a_to"				=> $_SESSION["user_id"],
				"a_seen"			=> 1,
				"a_table"			=> "clients",
				"a_row"				=> 0
			]);
			
		    $_SESSION["SUCCESS"] = "Client information has been added.";
			?>
			<script>
				window.location = PORTAL + "companies/clients";
			</script>
			<?php
		}else{
			new Alert("error", "Fail to saved data.");
		}
		
	break;
	
	case "edit":
	
		$data = [
		    "cl_name"	        => Input::post("c_name"),
			"cl_email"	        => Input::post("c_email"),
			"cl_phone"			=> Input::post("c_phone"),
			"cl_title"			=> Input::post("c_title"),
			"cl_company"		=> Input::post("c_company"),
			"cl_address"		=> Input::post("c_address"),
 			"cl_date"			=> F::GetDate(),
 			"cl_time"			=> F::GetTime(),
 			"cl_user"			=> $_SESSION['user_id']
		];
		
		
		
		$a = clients::updateBy(["cl_id"=>url::get(3)], $data);
		
		if($a){
			activities::insertInto([
				"a_date"			=> F::GetDate(),
				"a_time"			=> F::GetTime(),
				"a_user"			=> $_SESSION["user_id"],
				"a_title"			=> "Client Alteration",
				"a_description"		=> "Client " . Input::post("cl_name") . " editted.",
				"a_to"				=> $_SESSION["user_id"],
				"a_seen"			=> 1,
				"a_table"			=> "clients",
				"a_row"				=> url::get(3)
			]);
		    new Alert("success", "Data Saved");
		}else{
			new Alert("error", "Fail to saved data.");
		}													
	break;	
	
	case "delete":
		clients::deleteBy(
		["cl_id"=> url::get(3)]	);
		
		activities::insertInto([
			"a_date"			=> F::GetDate(),
			"a_time"			=> F::GetTime(),
			"a_user"			=> $_SESSION["user_id"],
			"a_title"			=> "Client Alteration",
			"a_description"		=> "Client " . url::get(3) . " deleted.",
			"a_to"				=> $_SESSION["user_id"],
			"a_seen"			=> 1,
			"a_table"			=> "clients",
			"a_row"				=> url::get(3)
		]);
		
		$_SESSION["SUCCESS"] = "Client information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "companies/clients";
		</script>
		<?php
	break;
	
}
?>