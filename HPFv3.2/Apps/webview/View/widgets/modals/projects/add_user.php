<form action="" method="POST">
	<p>
		Please select a user to added to this project.
	</p>
	
	<select class="form-control selectpicker" name="user">
	<?php
		$d_id = "";
		
		foreach($_SESSION["department_id"] as $d){
			if(empty($d_id)){
				$d_id .= "'". $d ."'";
			}else{
				$d_id .= ",'". $d ."'";
			}
		}
		
		$users = DB::conn()->q("SELECT * FROM users WHERE user_id IN (SELECT ud_user FROM user_department WHERE ud_department IN ($d_id))")->results();
		
		foreach($users as $user){
			$pu = project_user::getBy(["pu_project" => url::get(3), "pu_user" => $user->user_id]);
			
			if(count($pu) > 0){
				$selected = "selected";
			}else{
				$selected = "";
			?>
			<option value="<?= $user->user_id ?>"><?= $user->user_name ?></option>
			<?php
			}
		
		}
	?>
	</select><br /><br />
	
	<?php
		Controller::form("projects/user", [
			"action" => "add"
		]);
	?>
	
	<button class="btn btn-primary btn-sm">
		<span class="icon-plus2"></span> Add User to Project
	</button>
</form>