<?php
	switch(Input::post("action")){
		case "add":
			$data = [
				"r_role"		=> Input::post("role")
			];
			
			$a = roles::insertInto($data);
			if($a){
				new Alert("success","User added.");
			}else{
				new Alert("error", "Fail to add user.");
			}
		break;
		
		case "edit":
			$id = url::get(3);
			$t = roles::getBy(["r_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$data = [
					"r_role"	=> Input::post("role")
				];
				
				$a = roles::updateBy(["r_id" => $id], $data);
				if($a){
					new Alert("success", "Data saved.");
				}else{
					new Alert("error", "Fail to edit data.");
				}
			}
			
		break;
		
		case "delete":
			$id = url::get(3);
			$t = roles::getBy(["r_id" => $id]);
			if(count($t) > 0){
				$t = $t[0];
				
				$a = roles::deleteBy(["r_id" => $t->r_id]);
				if($a){
					new Alert("success", "Role has been deleted.");
					
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