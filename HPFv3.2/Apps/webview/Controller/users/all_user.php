<?php
	switch(Input::post("action")){
		case "add":
			if($_SESSION["admin"]){
				$dep = Input::post("depart");
			}else{
				$dep = $_SESSION["department"];
			}
			
			$role =  Input::post("role");
			
			$key = F::Uniqkey("USER_");
			$data = [
				"user_name"				=> Input::post("name"),
				"user_login" 			=> Input::post("username"),
				"user_password" 		=> F::Encrypt(Input::post("password")),
				"user_phone"			=> Input::post("phone"),
				"user_email" 			=> Input::post("email"),
				"user_key"				=> $key,
				"user_department"		=> $dep,
				"user_role"				=> Input::post("role")
			];
			
			users::insertInto($data);
			
			$a = users::getBy(["user_key" => $key]);
			
			if(count($a) > 0){
				$a = $a[0];
				
				new Alert("success","User added.");
			}else{
				new Alert("error", "Fail to add user.");
			}
		break;
		
		case "edit":
			$id = url::get(3);
			
			if($_SESSION["admin"]){
				$t = users::getBy(["user_id" => $id]);
				$dep = Input::post("department");
			}else{
				$t = users::getBy(["user_id" => $id, "user_department" => $_SESSION["department"]]);
				$dep = $_SESSION["department"];
			}
			
			if(count($t) > 0){
				$t = $t[0];
				
				if(empty(Input::post("password"))){
					$data = [
						"user_name"			=> Input::post("name"),
						"user_email" 		=> Input::post("email"),
						"user_login" 		=> Input::post("username"),
						"user_phone"		=> Input::post("phone"),
						"user_department"	=> $dep,
						"user_role"			=> Input::post("role")
					];
				}else{
					$data = [
						"user_name"			=> Input::post("name"),
						"user_email" 		=> Input::post("email"),
						"user_login" 		=> Input::post("username"),
						"user_password" 	=> F::Encrypt(Input::post("password")),
						"user_phone"		=> Input::post("phone"),
						"user_department"	=> $dep,
						"user_role"			=> Input::post("role")
					];
				}
				
				$a = users::updateBy(["user_id" => $id], $data);
				
				if($_SESSION["user_id"] == $id){
					$_SESSION["department"] = Input::post("department");
				}
				
				new Alert("success","User added.");
			}else{
				new Alert("error", "User not found");
			}
		break;
		
		case "delete":
			$id = url::get(3);
			
			if($_SESSION["admin"]){
				$t = users::getBy(["user_id" => $id]);
			}else{
				$t = users::getBy(["user_id" => $id, "user_department" => $_SESSION["department"]]);
			}
			
			if(count($t) > 0){
				$t = $t[0];
				
				$a = users::deleteBy(["user_id" => $t->user_id]);
				if($a){
					new Alert("success", "User has been deleted.");
					
					?>
					<script>
						window.location = "<?= PORTAL ?><?= url::get(0) ?>/<?= url::get(1) ?>";
					</script>

					<?php
				}else{
					new Alert("error", "Fail to delete user.");
				}
			}
			
		break;
	}
?>