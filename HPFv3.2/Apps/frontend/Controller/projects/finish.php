<?php


$pf = project_finishing::getBy(["pf_project" => url::get(3)]);



if(count($pf)){
	$pf = $pf[0];
	project_finishing::updateBy(["pf_id" => $pf->pf_id], [
		"pf_notes"		=> Input::post("note"),
		"pf_project"	=> url::get(3),
		"pf_date"		=> F::GetDate(),
		"pf_time"		=> F::GetTime(),
		"pf_user"		=> $_SESSION["user_id"]
	]);
}else{
	project_finishing::insertInto([
		"pf_notes"		=> Input::post("note"),
		"pf_project"	=> url::get(3),
		"pf_date"		=> F::GetDate(),
		"pf_time"		=> F::GetTime(),
		"pf_user"		=> $_SESSION["user_id"]
	]);
}

projects::updateBy(["p_id" => url::get(3)], ["p_status" => 3]);

new Alert("success", "Project Finishing information has been updated.");