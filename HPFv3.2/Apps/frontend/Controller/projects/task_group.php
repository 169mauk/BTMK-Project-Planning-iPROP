<?php

switch(Input::post("action")){
	case "add":
		if(!empty(Input::post("name"))){
			task_group::insertInto([
				"tg_project"	=> url::get(3),
				"tg_name"		=> Input::post("name"),
				"tg_note"		=> input::post("note"),
				"tg_user"		=> $_SESSION["user_id"],
				"tg_date"		=> F::GetDate(),
				"tg_time"		=> F::GetTime()
			]);
			
			$_SESSION["SUCCESS"] = "Schedule has been added.";
		?>
		<script>
			window.location = PORTAL + "projects/all/edit/<?= url::get(3) ?>/Schedule";
		</script>
		<?php
		}else{
			new Alert("error", "Task title cannot be empty.");
		}
	break;
	
	case "edit":
	
	break;
	
	case "delete":
		$tg = task_group::getBy(["tg_id" => url::get(6), "tg_project" => url::get(3)]);
		
		if(count($tg)){
			$tg = $tg[0];
			
			if($tg->tg_user == $_SESSION["user_id"] || $_SESSION["role"] > 0){
				tasks::deleteBy(["t_group" => $tg->tg_id]);
				task_group::deleteBy(["tg_id" => $tg->tg_id]);
								
				$_SESSION["SUCCESS"] = "Schedule and it's tasks has been deleted permanently.";
		?>
		<script>
			window.location = PORTAL + "projects/all/edit/<?= url::get(3) ?>/Schedule";
		</script>
		<?php
			}else{
				new Alert("error", "You are not allowed to delete this Task Group. Only owner & admin can perform this action.");
			}
		}else{
			new Alert("error", "Task group not found.");
		}
	break;
}