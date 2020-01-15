<?php
	switch(Input::post("action")){
		case "add":
			$data = [
				"p_name"		=> Input::post("name", true, ["uppercase" => true])
			];
			
			$a = positions::insertInto($data);
			if($a){
				new Alert("success","User added.");
			}else{
				new Alert("error", "Fail to add user.");
			}
		break;
		
		case "edit":
			$id = url::get(3);
			$t = positions::getBy(["p_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$data = [
					"p_name"	=> Input::post("name", true, ["uppercase" => true])
				];
				
				$a = positions::updateBy(["p_id" => $id], $data);
				if($a){
					new Alert("success", "Data saved.");
				}else{
					new Alert("error", "Fail to edit data.");
				}
			}
			
		break;
		
		case "delete":
			$id = url::get(3);
			$t = positions::getBy(["p_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$a = positions::deleteBy(["p_id" => $t->p_id]);
				if($a){
				$_SESSION["SUCCESS"] = "Position information has been deleted.";
					?>
					<script>
						window.location = PORTAL + "<?= url::get(0) ?>/<?= url::get(1) ?>";
					</script>
					<?php
				}else{
					new Alert("error", "Fail to delete data.");
				}
			}
		break;
	}
?>