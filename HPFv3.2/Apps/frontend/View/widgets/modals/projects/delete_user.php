<form action="" method="POST">
	<p>
		By clicking below button will remove user "<strong id="delete_user_name"></strong>" permanently from current selected project.
	</p>
	
	<p>
		Please select what happen to tasks that had been assign to this user.
	</p>
	
	<select class="form-control selectpicker" name="migrate">
		<option value="0">Delete Permanently</option>
	<?php
		
		$users = DB::conn()->query("SELECT * FROM users WHERE user_department = ?", [$_SESSION["department"]])->results();
		
		foreach($users as $user){			
		?>
		<option value="<?= $user->user_id ?>" >Migrate to <?= $user->user_name ?></option>
		<?php
		}
	?>
	</select><br /><br />
	
	<?php
		Controller::form("projects/user",[
			"action"	=> "delete",
			"duser_id"		=> ""
		]);
	?>
	
	<button class="btn btn-danger btn-sm">
		<span class="icon-trash"></span> Delete User
	</button>
</form>