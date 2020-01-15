<?php
switch (Input::POST('action')){
	case "add":
		if(!empty(Input::post("name")) && Input::post("url")){
			menus::insertInto([
				"m_name"		=> Input::post("name"),
				"m_url"			=> Input::post("url"),
				"m_icon"		=> Input::post("icon"),
				"m_description"	=> Input::post("description"),
				"m_main"		=> Input::post("main"),
				"m_order"		=> Input::post("order"),
				"m_role"		=> is_array(Input::post("role")) ? implode(",", Input::post("role")) : "",
				"m_disabled"	=> Input::post("disabled")
			]);
			
			new Alert("success", "Menu has been added successfully.");
		}else{
			new Alert("error", "Please insert name and URL.");
		}		
	break;
	
	case "edit":
		if(!empty(Input::post("name")) && Input::post("url")){
			menus::updateBy(["m_id" => url::get(3)], [
				"m_name"		=> Input::post("name"),
				"m_url"			=> Input::post("url"),
				"m_icon"		=> Input::post("icon"),
				"m_description"	=> Input::post("description"),
				"m_main"		=> Input::post("main"),
				"m_order"		=> Input::post("order"),
				"m_role"		=> is_array(Input::post("role")) ? implode(",", Input::post("role")) : "",
				"m_disabled"	=> Input::post("disabled")
			]);
			
			new Alert("success", "Menu has been updated successfully.");
		}else{
			new Alert("error", "Please insert name and URL.");
		}												
	break;	
	
	case "delete":
		menus::deleteBy(["m_id" => url::get(3)]);
			
		
		$_SESSION["SUCCESS"] = "Menu information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "settings/menus";
		</script>
		<?php
	break;
	
}
?>