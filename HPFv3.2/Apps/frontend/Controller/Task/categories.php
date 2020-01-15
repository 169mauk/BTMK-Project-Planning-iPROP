<?php
	switch(Input::post("action")){
		case "add":
			$data = [
				"t_title" => Input::post("title", true, ["uppercase" => true]),
				"t_content" => Input::post("content"),
				"t_date" => F::GetDate(),
				"t_time" => F::GetTime(),
				"t_user" => $_SESSION['user_id']
			];
			
			$a = task_category::insertInto($data);
			if($a){
				new Alert("success","Data saved.");
			}else{
				new Alert("error", "Fail to add data.");
			}
		break;
		
		case "edit":
			$id = url::get(3);
			$t = task_category::getBy(["t_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$data = [
					"t_title" => Input::post("title", true, ["uppercase" => true]),
					"t_content" => Input::post("content"),
					"t_date" => F::GetDate(),
					"t_time" => F::GetTime(),
					"t_user" => $_SESSION['user_id']
				];
				
				$a = task_category::updateBy(["t_id" => $id], $data);
				if($a){
					new Alert("success", "Data saved.");
				}else{
					new Alert("error", "Fail to edit data.");
				}
			}
			
		break;
		
		case "delete":
			$id = url::get(3);
			$t = task_category::getBy(["t_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$a = task_category::deleteBy(["t_id" => $t->t_id]);
				if($a){
					new Alert("success", "Data has been deleted.");
					
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