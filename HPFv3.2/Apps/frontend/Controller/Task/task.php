<?php
	switch(Input::post("action")){
		case "add":
			$data = [
				"t_project"		=> Input::post("project"),
				"t_title" 		=> Input::post("title", true, ["uppercase" => true]),
				"t_content" 	=> Input::post("content"),
				"t_category"	=> Input::post("category"),
				"t_tags"		=> count(Input::post("tags")) > 0 ? implode(",", Input::post("tags")) : "",
				"t_date" 		=> F::GetDate(),
				"t_time" 		=> F::GetTime(),
				"t_user" 		=> $_SESSION['user_id']
			];
			
			$a = tasks::insertInto($data);
			if($a){
				
				$data_act = [
					"a_title"		=> Input::post("title"),
					"a_user"		=> $_SESSION["user_id"],
					"a_description"	=> "Add new Task",
					"a_date"		=> F::GetDate(),
					"a_time"		=> F::GetTime()
				];
				
				activities::insertInto($data_act);
				
				$_SESSION["SUCCESS"] = "Task information has been added.";
				?>
				<script>
					window.location = "<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>";
				</script>

				<?php
			}else{
				new Alert("error", "Fail to add data.");
			}
		break;
		
		case "edit":
			$id = url::get(3);
			$t = tasks::getBy(["t_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$data = [
					"t_project"		=> Input::post("project"),
					"t_title" 		=> Input::post("title", true, ["uppercase" => true]),
					"t_content" 	=> Input::post("content"),
					"t_category"	=> Input::post("category"),
					"t_tags"		=> is_array(Input::post("tags")) ? implode(",", Input::post("tags")) : "",
					"t_status" 		=> Input::post("status"),
					"t_date" 		=> F::GetDate(),
					"t_time" 		=> F::GetTime(),
					"t_user" 		=> $_SESSION['user_id']
				];
				
				$a = tasks::updateBy(["t_id" => $id], $data);
				if($a){
					new Alert("success", "Data saved.");
				}else{
					new Alert("error", "Fail to edit data.");
				}
			}
			
		break;
		
		case "delete":
			$id = url::get(3);
			$t = tasks::getBy(["t_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$a = tasks::deleteBy(["t_id" => $t->t_id]);
				if($a){
					$_SESSION["SUCCESS"] = "Task information has been deleted.";
					?>
					<script>
						window.location = "<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>";
					</script>

					<?php
				}else{
					new Alert("error", "Fail to delete data.");
				}
			}
			
		break;
	}
?>