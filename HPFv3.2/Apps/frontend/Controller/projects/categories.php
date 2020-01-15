<?php

switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("name"))){
			project_categories::insertInto([
				"c_name"			=> Input::post("name"),
				"c_description"		=> Input::post("description"),
				"c_user"			=> $_SESSION["user_id"]
			]);
			
			new Alert("success", "Category added successfully.");
		}else{
			new Alert("error", "Category name cannot be empty!");
		}
	break;
	
	case "edit":
		if(!empty(Input::post("name"))){
			project_categories::updateBy(["c_id" => url::get(4)], [
				"c_name"			=> Input::post("name"),
				"c_description"		=> Input::post("description"),
				"c_user"			=> $_SESSION["user_id"]
			]);
			
			new Alert("success", "Category updated successfully.");
		}else{
			new Alert("error", "Category name cannot be empty!");
		}
	break;
	
	case "delete":
		project_categories::deleteBy(["c_id" => url::get(4)]);
		
		$_SESSION["SUCCESS"] = "Category information has been deleted.";
		?>
		<script>
			window.location = PORTAL + "settings/project-setting/Category";
		</script>
		<?php
	break;
}