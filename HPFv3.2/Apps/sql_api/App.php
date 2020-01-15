<?php
//A journey start with a step
header("Content-Type: application/json");
define("ACCESS_KEY", "855351a3a-80jj1e51nd3");

if(isset($_GET["access_key"])){
	if(Input::get("access_key") == ACCESS_KEY){
		$bool = true;
	}else{
		echo json_encode([
			"status"	=> "error",
			"message"	=> "UNAUTHORIZED_ACCESS_KEY"
		]);
		die();
	}
}else{
	echo json_encode([
		"status"	=> "error",
		"message"	=> "ACCESS_KEY_NOT_FOUND"
	]);
	die();
}

$o = fopen("php://input", "rb");
$json = stream_get_contents($o);
fclose($o);
$data = json_decode($json, true);

switch(url::get(0)){
	case "project_list":
		$t = [];
		
		switch($data["role"]){
			case "0":
			case 0:
				$q = projects::list(["where" => "p_id IN (SELECT pu_project FROM project_user WHERE pu_user = ". $data["user"] .")"]);
			break;
			
			case "1":
			case 1:
				$q = projects::list(["where" => "p_id IN (SELECT pd_project FROM project_department WHERE pd_department = ". $data["department"] .")"]);
			break;
			
			case "2":
			case 2:
				$q = projects::list();
			break;
		}
		
		foreach($q as $p){
			$tg = task_group::getBy(["tg_project" => $p->p_id], ["order" => "tg_id DESC", "limit" => 1]);
			$percent = 0;
			if(count($tg)){
				$tg = $tg[0];
				
				$tx = tasks::getBy(["t_group" => $tg->tg_id]);
				
				if(count($tx)){
					$done = DB::conn()->query("SELECT SUM(t_percent) as percent FROM tasks WHERE t_group = " . $tg->tg_id)->results();
					
					if(count($done)){
						$per = $done[0]->percent;
						
						if(!empty($per)){
							$percent = ($per / (count($tx) * 100)) * 100;
						}
					}
				}
			}
			
			$p->percent = $percent;
			$p->start = date("d-M-Y", $p->p_time);
			$p->end = date("d-M-Y", $p->p_end);
			
			$t[] = $p;
		}
	break;
	
	case "job_list":
		$t = [];
		
		foreach(jobs::getBy(["j_user" => $data["user"]], ["order" => "j_status ASC"]) as $j){
			$from = users::getBy(["user_id" => $j->j_by]);
			
			if(count($from)){
				$j->from = $from[0]->user_name;
			}else{
				$j->from = "Unknow User";
			}
			
			$project = projects::getBy(["p_id" => $j->j_project]);
			
			if(count($project)){
				$j->project = $project[0];
			}else{
				$j->project = null;
			}
			
			$t[] = $j;
		}
	break;
	
	case "add_report":
		if(!empty($data["r_title"])){
			$key = F::UniqKey();
			
			reports::insertInto([
				"r_title"		=> $data["r_title"],
				"r_claim"		=> $data["r_claim"],
				"r_date"		=> date("d-M-Y", strtotime($data["r_date"])),
				"r_description"	=> $data["r_description"],
				"r_project"		=> $data["r_project"],
				"r_user"		=> $data["r_user"],
				"r_department"	=> $data["r_department"],
				"r_key"			=> $key
			]);
			
			$r = reports::getBy(["r_key" => $key]);
			
			if(count($r)){
				$r = $r[0];
				
				echo json_encode([
					"status"	=> "success",
					"code"		=> "REPORT_SAVED",
					"message"	=> "Report has been added",
					"data"		=> $r
				]);
			}else{
				echo json_encode([
					"status"	=> "error",
					"code"		=> "REPORT_FAIL",
					"message"	=> "Fail saving report information. Please try again."
				]);
			}
		}else{
			echo json_encode([
				"status"	=> "error",
				"code"		=> "REPORT_TITLE_EMPTY",
				"message"	=> "Report title cannot be empty"
			]);
		}
		
		die();
	break;
	
	case "report_doc":
		$r = reports::getBy(["r_key" => url::Get(2)]);
			
		if(count($r)){
			$r = $r[0];
			$fname = F::UniqKey() . "-" . F::Decode64(url::get(1));
			
			$o = fopen(Turbo::app("frontend")->Asset() . "images/reports/" . $fname, "w+");
			$i = fopen("php://input", "rb");
			
			while(!feof($i)){
				fwrite($o, fread($i, 1024));
				flush();
			}
			
			fclose($o);
			fclose($i);
			
			report_images::insertInto([
				"ri_report"	=> $r->r_id,
				"ri_image"	=> $fname
			]);
		}
	break;
	
	case "task_list":
		$t = [];
		
		$t = tasks::list(["where" => "t_group = (SELECT tg_id FROM task_group WHERE tg_project = ". $data["project"] ." ORDER BY tg_id DESC LIMIT 1)"]);
		
		
	break;
	
	case "sql":
		$t = DB::conn()->query($data["sql"], (isset($data["data"]) ? $data["data"] : []))->results();
	break;
	
	default:
		$data = json_decode($json, true);
		switch(url::get(1)){
			case "insertInto":
			case "deleteBy":
			case "list":
			case "getBy":
				$c = url::get(0);
				$t = $c::{url::get(1)}($data);
			break;
			
			case "updateBy":
				$where = [];
				$wh = explode(",", url::get(2));
				foreach($wh as $w){
					$wx = explode("=", $w);
					$where[$wx[0]] = $wx[1];
				}
				
				$c = url::get(0);
				$t = $c::{url::get(1)}($where, $data);
			break;
			
			default:
				$t = null;
			break;
		}
	break;
}

echo json_encode($t);