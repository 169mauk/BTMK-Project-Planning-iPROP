<?php
$m = menus::getBy(["m_url" => url::get(0), "m_disabled" => 0, "m_main" => 0]);

if(count($m)){
	$m = $m[0];
	
	if(url::get(1) == ""){
		$cm = "404";
	}else{
		$cm = url::get(1);
	}

	if(!$_SESSION["admin"]){
		$x = menus::list(["where" => "FIND_IN_SET(". $_SESSION["user_position"] .", m_role) > 0 AND m_disabled = 0 AND m_main = ". $m->m_id ." AND m_url = '" . $cm . "'"]);
	}else{
		$x = menus::list(["where" => "m_disabled = 0 AND m_main = ". $m->m_id ." AND m_url = '" . $cm . "'"]);
	}

	if(count($x)){
		$pagex = $x[0]->m_url;
	}else{
		$pagex = "404";
	}
}else{
	$pagex = "404";
}

switch($pagex){
	case "my-profile":
		Page::Load("users/my-profile");
	break;
	
	case "all-users":
		Page::Load("users/all-users");
	break;
	
	case "roles":
		Page::Load("users/roles");
	break;
	
	case "positions":
		Page::Load("users/potisions");
	break;
	
	default:
		Page::Load("404");
	break;
}